<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Wf_po_details_model
 * Handling data klasifikasi PO vs Non-PO, Faktur Pajak, WHT & Vendor Invoice Number.
 */
class Wf_po_details_model extends App_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = db_prefix() . 'wf_invoice_po_details';
    }

    /**
     * Get PO details for specific invoice.
     *
     * @param int $invoice_id
     * @return object|null
     */
    public function get_by_invoice_id($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Save or update PO details.
     *
     * @param int $invoice_id
     * @param array $data
     * @return bool
     */
    public function save_po_details($invoice_id, $data)
    {
        $existing = $this->get_by_invoice_id($invoice_id);

        $payload = [
            'invoice_id'            => $invoice_id,
            'invoice_type'          => isset($data['invoice_type']) && in_array($data['invoice_type'], ['po', 'non_po']) ? $data['invoice_type'] : 'non_po',
            'po_number'             => !empty($data['po_number']) ? trim($data['po_number']) : null,
            'gr_number'             => !empty($data['gr_number']) ? trim($data['gr_number']) : null,
            'vendor_invoice_number' => !empty($data['vendor_invoice_number']) ? trim($data['vendor_invoice_number']) : null,
            'faktur_pajak_number'  => !empty($data['faktur_pajak_number']) ? trim($data['faktur_pajak_number']) : null,
            'faktur_pajak_date'    => !empty($data['faktur_pajak_date']) ? to_sql_date($data['faktur_pajak_date']) : null,
            'wht_type'              => !empty($data['wht_type']) ? trim($data['wht_type']) : null,
            'wht_rate'              => isset($data['wht_rate']) ? (float)$data['wht_rate'] : 0.00,
            'wht_amount'            => isset($data['wht_amount']) ? (float)$data['wht_amount'] : 0.00,
            'non_po_reason'         => !empty($data['non_po_reason']) ? trim($data['non_po_reason']) : null,
        ];

        // Also update tblwf_invoice_states.invoice_type
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update(db_prefix() . 'wf_invoice_states', [
            'invoice_type' => $payload['invoice_type'],
        ]);

        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update($this->table, $payload);
        } else {
            return $this->db->insert($this->table, $payload);
        }
    }

    /**
     * Check duplicate vendor invoice number for the same client/vendor.
     * (FR-05: Deteksi duplikasi invoice vendor).
     *
     * @param string $vendor_invoice_number
     * @param int $client_id
     * @param int|null $exclude_invoice_id
     * @return bool True if duplicate found, false if safe.
     */
    public function check_duplicate_vendor_invoice($vendor_invoice_number, $client_id, $exclude_invoice_id = null)
    {
        if (empty($vendor_invoice_number) || empty($client_id)) {
            return false;
        }

        $this->db->select('pod.id, pod.invoice_id, inv.number, inv.prefix');
        $this->db->from($this->table . ' pod');
        $this->db->join(db_prefix() . 'invoices inv', 'inv.id = pod.invoice_id', 'inner');
        $this->db->where('pod.vendor_invoice_number', trim($vendor_invoice_number));
        $this->db->where('inv.clientid', (int)$client_id);
        $this->db->where('inv.status !=', 5); // Exclude cancelled invoices (STATUS_CANCELLED = 5)

        if ($exclude_invoice_id) {
            $this->db->where('pod.invoice_id !=', (int)$exclude_invoice_id);
        }

        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    /**
     * Validate PO details rules before saving.
     *
     * @param array $data
     * @param int $client_id
     * @param int|null $exclude_invoice_id
     * @return array List of error messages (empty array if valid)
     */
    public function validate_po_details($data, $client_id = 0, $exclude_invoice_id = null)
    {
        $errors = [];
        $type = isset($data['invoice_type']) ? $data['invoice_type'] : 'non_po';

        if ($type === 'po') {
            if (empty($data['po_number'])) {
                $errors[] = 'Nomor PO (Purchase Order) wajib diisi untuk Invoice jenis PO.';
            }
            if (empty($data['gr_number'])) {
                $errors[] = 'Nomor GR / Berita Acara Penerimaan (Goods Receipt) wajib diisi untuk Invoice jenis PO.';
            }
        } elseif ($type === 'non_po') {
            if (empty($data['non_po_reason'])) {
                $errors[] = 'Justifikasi / Alasan pengajuan Non-PO wajib diisi.';
            }
        }

        if (!empty($data['vendor_invoice_number']) && $client_id > 0) {
            if ($this->check_duplicate_vendor_invoice($data['vendor_invoice_number'], $client_id, $exclude_invoice_id)) {
                $errors[] = 'Nomor Invoice Vendor "' . html_escape($data['vendor_invoice_number']) . '" sudah pernah diajukan untuk vendor ini (duplikasi terdeteksi).';
            }
        }

        if (!empty($data['faktur_pajak_number'])) {
            $cleanedFaktur = preg_replace('/[^0-9]/', '', $data['faktur_pajak_number']);
            if (strlen($cleanedFaktur) !== 16) {
                $errors[] = 'Nomor Seri Faktur Pajak harus terdiri dari 16 digit angka.';
            }
        }

        return $errors;
    }
}
