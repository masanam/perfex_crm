<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Controller Vendor_otp
 * Endpoint pengiriman & verifikasi OTP login vendor (FR-01).
 */
class Vendor_otp extends ClientsController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(IWF_MODULE_NAME . '/Wf_otp_service', null, 'wf_otp');
    }

    /**
     * POST invoice_workflow/vendor_otp/request_otp
     */
    public function request_otp()
    {
        if (!$this->input->is_ajax_request() || !$this->input->post()) {
            show_404();
        }

        $email = $this->input->post('email', true);
        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email wajib diisi.']);
            return;
        }

        // Check if email belongs to a active vendor contact in tblcontacts
        $contact = $this->db->get_where(db_prefix() . 'contacts', [
            'email'  => trim($email),
            'active' => 1,
        ])->row();

        if (!$contact) {
            echo json_encode(['success' => false, 'message' => 'Email kontak vendor tidak terdaftar dalam sistem.']);
            return;
        }

        $res = $this->wf_otp->generate_and_send_otp($contact->id, $email);
        echo json_encode($res);
    }

    /**
     * POST invoice_workflow/vendor_otp/verify_otp
     */
    public function verify_otp()
    {
        if (!$this->input->is_ajax_request() || !$this->input->post()) {
            show_404();
        }

        $email   = $this->input->post('email', true);
        $otpCode = $this->input->post('otp_code', true);

        if (empty($email) || empty($otpCode)) {
            echo json_encode(['success' => false, 'message' => 'Email dan Kode OTP wajib diisi.']);
            return;
        }

        $res = $this->wf_otp->verify_otp($email, $otpCode);
        if ($res['success']) {
            // Set session for vendor contact
            $contactId = $res['contact_id'];
            $contact = $this->db->get_where(db_prefix() . 'contacts', ['id' => $contactId])->row();

            if ($contact) {
                $this->session->set_userdata([
                    'client_user_id'   => $contact->userid,
                    'contact_user_id'  => $contact->id,
                    'client_logged_in' => true,
                    'iwf_otp_verified' => true,
                ]);
            }
        }

        echo json_encode($res);
    }
}
