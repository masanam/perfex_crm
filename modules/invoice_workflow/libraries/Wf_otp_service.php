<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library Wf_otp_service
 * Layanan autentikasi OTP email untuk Login Vendor (FR-01).
 */
class Wf_otp_service
{
    private $CI;
    private $table;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->table = db_prefix() . 'wf_vendor_otp';
    }

    /**
     * Generate & send OTP to vendor contact email.
     *
     * @param int $contact_id
     * @param string $email
     * @return array ['success' => bool, 'message' => string]
     */
    public function generate_and_send_otp($contact_id, $email)
    {
        $email = trim(strtolower($email));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Format email tidak valid.'];
        }

        // Invalidate active OTPs for this email
        $this->CI->db->where('email', $email);
        $this->CI->db->where('is_used', 0);
        $this->CI->db->update($this->table, ['is_used' => 1]);

        $otpCode = sprintf('%06d', mt_rand(100000, 999999));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        $this->CI->db->insert($this->table, [
            'contact_id' => (int)$contact_id,
            'email'      => $email,
            'otp_code'   => $otpCode,
            'expires_at' => $expiresAt,
            'attempts'   => 0,
            'is_used'    => 0,
            'ip_address' => $this->CI->input->ip_address(),
        ]);

        // Send OTP email
        $subject = 'Kode OTP Login Vendor — Sistem Manajemen Invoice NEC';
        $body = '<div style="font-family: Arial, sans-serif; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">';
        $body .= '<h3 style="color: #1e293b; margin-top: 0;">Kode OTP Login Vendor</h3>';
        $body .= '<p>Gunakan kode OTP berikut untuk melakukan otentikasi login ke Sistem Manajemen Invoice NEC Indonesia:</p>';
        $body .= '<div style="font-size: 28px; font-weight: bold; letter-spacing: 5px; color: #0284c7; margin: 15px 0; background: #ffffff; padding: 12px 20px; display: inline-block; border-radius: 6px; border: 1px dashed #0284c7;">' . $otpCode . '</div>';
        $body .= '<p style="color: #64748b; font-size: 13px;">Kode OTP ini berlaku selama <strong>10 menit</strong>. Jangan berikan kode ini kepada siapapun.</p>';
        $body .= '</div>';

        $sent = $this->CI->app_mail->send_simple_email($email, $subject, $body);

        if ($sent) {
            return ['success' => true, 'message' => 'Kode OTP berhasil dikirimkan ke email ' . html_escape($email) . '.'];
        } else {
            return ['success' => false, 'message' => 'Gagal mengirimkan email OTP. Silakan coba lagi.'];
        }
    }

    /**
     * Verify OTP code provided by user.
     *
     * @param string $email
     * @param string $otp_code
     * @return array ['success' => bool, 'message' => string, 'contact_id' => int|null]
     */
    public function verify_otp($email, $otp_code)
    {
        $email = trim(strtolower($email));
        $otp_code = trim($otp_code);

        $this->CI->db->where('email', $email);
        $this->CI->db->where('is_used', 0);
        $this->CI->db->order_by('id', 'DESC');
        $otpRecord = $this->CI->db->get($this->table)->row();

        if (!$otpRecord) {
            return ['success' => false, 'message' => 'Kode OTP tidak ditemukan atau sudah kadaluarsa.'];
        }

        if (strtotime($otpRecord->expires_at) < time()) {
            $this->CI->db->where('id', $otpRecord->id)->update($this->table, ['is_used' => 1]);
            return ['success' => false, 'message' => 'Kode OTP telah kadaluarsa. Silakan minta kode baru.'];
        }

        if ($otpRecord->attempts >= 3) {
            $this->CI->db->where('id', $otpRecord->id)->update($this->table, ['is_used' => 1]);
            return ['success' => false, 'message' => 'Batas percobaan memasukkan OTP tercapai (3x). Silakan minta OTP baru.'];
        }

        if ($otpRecord->otp_code !== $otp_code) {
            $this->CI->db->where('id', $otpRecord->id)->set('attempts', 'attempts+1', false)->update($this->table);
            return ['success' => false, 'message' => 'Kode OTP yang Anda masukkan salah.'];
        }

        // Mark OTP as used
        $this->CI->db->where('id', $otpRecord->id)->update($this->table, ['is_used' => 1]);

        return [
            'success'    => true,
            'message'    => 'Otentikasi OTP berhasil.',
            'contact_id' => (int)$otpRecord->contact_id,
        ];
    }
}
