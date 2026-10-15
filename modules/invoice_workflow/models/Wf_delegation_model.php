<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Wf_delegation_model
 *
 * Manajemen delegasi persetujuan sementara.
 *
 * @package invoice_workflow
 */
class Wf_delegation_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua delegasi, join dengan nama staff.
     */
    public function getAll(bool $activeOnly = false): array
    {
        $this->db->select(
            db_prefix() . 'wf_delegations.*, ' .
            'CONCAT(d.firstname, " ", d.lastname) as delegator_name, ' .
            'CONCAT(e.firstname, " ", e.lastname) as delegatee_name'
        );
        $this->db->from(db_prefix() . 'wf_delegations');
        $this->db->join(db_prefix() . 'staff d', 'd.staffid = ' . db_prefix() . 'wf_delegations.delegator_id', 'left');
        $this->db->join(db_prefix() . 'staff e', 'e.staffid = ' . db_prefix() . 'wf_delegations.delegatee_id', 'left');

        if ($activeOnly) {
            $now = date('Y-m-d H:i:s');
            $this->db->where(db_prefix() . 'wf_delegations.is_active', 1);
            $this->db->where(db_prefix() . 'wf_delegations.valid_from <=', $now);
            $this->db->where(db_prefix() . 'wf_delegations.valid_until >=', $now);
        }

        $this->db->order_by(db_prefix() . 'wf_delegations.created_at', 'DESC');

        return $this->db->get()->result();
    }

    /**
     * Ambil role yang didelegasikan ke staff tertentu (yang masih aktif & belum expired).
     *
     * @return string[]  Array of role slugs
     */
    public function getActiveDelegatedRoles(int $delegateeId): array
    {
        $now = date('Y-m-d H:i:s');

        $this->db->select('role_slug');
        $this->db->where('delegatee_id', $delegateeId);
        $this->db->where('is_active', 1);
        $this->db->where('valid_from <=', $now);
        $this->db->where('valid_until >=', $now);
        $rows = $this->db->get(db_prefix() . 'wf_delegations')->result();

        return array_column($rows, 'role_slug');
    }

    /**
     * Buat delegasi baru dari aksi 'delegate' dalam workflow.
     */
    public function createDelegationFromAction(int $invoiceId, int $delegatorId, int $delegateeId, int $logId): int
    {
        // Ambil role delegator
        $this->load->model(IWF_MODULE_NAME . '/Wf_approvers_model', 'iwf_approvers');
        $roles = $this->iwf_approvers->getRolesByStaff($delegatorId);
        $roleSlug = !empty($roles) ? $roles[0] : 'senior_manager';

        // Default delegasi berlaku 7 hari
        $this->db->insert(db_prefix() . 'wf_delegations', [
            'delegator_id' => $delegatorId,
            'delegatee_id' => $delegateeId,
            'role_slug'    => $roleSlug,
            'valid_from'   => date('Y-m-d H:i:s'),
            'valid_until'  => date('Y-m-d H:i:s', strtotime('+7 days')),
            'reason'       => 'Delegasi dari aksi workflow Invoice #' . $invoiceId . ' (log_id=' . $logId . ')',
            'is_active'    => 1,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        return (int) $this->db->insert_id();
    }

    /**
     * Simpan delegasi baru (dari form admin).
     */
    public function save(array $data, ?int $id = null): int|bool
    {
        $data['valid_from']  = date('Y-m-d H:i:s', strtotime($data['valid_from']));
        $data['valid_until'] = date('Y-m-d H:i:s', strtotime($data['valid_until']));

        if ($id) {
            $this->db->where('id', $id);
            $this->db->update(db_prefix() . 'wf_delegations', $data);
            return $this->db->affected_rows() > 0;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert(db_prefix() . 'wf_delegations', $data);
        return (int) $this->db->insert_id();
    }

    /**
     * Cabut (revoke) delegasi.
     */
    public function revoke(int $id): bool
    {
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'wf_delegations', [
            'is_active'  => 0,
            'revoked_at' => date('Y-m-d H:i:s'),
            'revoked_by' => get_staff_user_id(),
        ]);

        return $this->db->affected_rows() > 0;
    }
}
