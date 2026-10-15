<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Wf_payment_model
 * Handling data rincian pembayaran & Bank Voucher yang diinput oleh Treasury (FR-10).
 */
class Wf_payment_model extends App_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = db_prefix() . 'wf_payment_details';
    }

    /**
     * Get payment details by invoice_id.
     *
     * @param int $invoice_id
     * @return object|null
     */
    public function get_by_invoice_id($invoice_id)
    {
        $this->db->where('invoice_id', (int)$invoice_id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Save or update payment details for invoice.
     *
     * @param int $invoice_id
     * @param array $data
     * @param int $staff_id
     * @return bool
     */
    public function save_payment_details($invoice_id, $data, $staff_id = 0)
    {
        $existing = $this->get_by_invoice_id($invoice_id);

        $payload = [
            'invoice_id'          => (int)$invoice_id,
            'bank_voucher_number' => trim($data['bank_voucher_number'] ?? ''),
            'bank_name'           => !empty($data['bank_name']) ? trim($data['bank_name']) : null,
            'bank_account_number' => !empty($data['bank_account_number']) ? trim($data['bank_account_number']) : null,
            'payment_method'      => !empty($data['payment_method']) ? trim($data['payment_method']) : 'bank_transfer',
            'payment_amount'      => isset($data['payment_amount']) ? (float)$data['payment_amount'] : 0.00,
            'payment_date'        => !empty($data['payment_date']) ? to_sql_date($data['payment_date']) : date('Y-m-d'),
            'payment_notes'       => !empty($data['payment_notes']) ? trim($data['payment_notes']) : null,
            'created_by'          => (int)$staff_id,
        ];

        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update($this->table, $payload);
        } else {
            return $this->db->insert($this->table, $payload);
        }
    }
}
