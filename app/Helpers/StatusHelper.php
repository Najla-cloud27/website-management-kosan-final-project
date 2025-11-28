<?php

if (!function_exists('format_status')) {
    /**
     * Format status string to readable format
     * belum_dibayar -> Belum Dibayar
     * sudah_dipesan -> Sudah Dipesan
     * 
     * @param string $status
     * @return string
     */
    function format_status($status)
    {
        if (empty($status)) {
            return '';
        }
        
        // Replace underscore with space
        $formatted = str_replace('_', ' ', $status);
        
        // Capitalize each word
        return ucwords($formatted);
    }
}

if (!function_exists('status_badge_class')) {
    /**
     * Get Bootstrap badge class based on status
     * 
     * @param string $status
     * @return string
     */
    function status_badge_class($status)
    {
        $classes = [
            // Room status
            'tersedia' => 'badge-soft-success',
            'terisi' => 'badge-soft-danger',
            'sudah_dipesan' => 'badge-soft-info',
            'pemeliharaan' => 'badge-soft-warning',
            
            // Billing status
            'belum_dibayar' => 'badge-soft-danger',
            'menunggu_verifikasi' => 'badge-soft-warning',
            'verifikasi_tertunda' => 'badge-soft-warning',
            'sudah_dibayar' => 'badge-soft-success',
            'dibayar' => 'badge-soft-success',
            'ditolak' => 'badge-soft-dark',
            'terlambat' => 'badge-soft-dark',
            
            // Payment Proof status
            'tertunda' => 'badge-soft-warning',
            'terverifikasi' => 'badge-soft-success',
            'rejected' => 'badge-soft-danger',
            
            // Complaint status
            'pending' => 'badge-soft-warning',
            'dikirim' => 'badge-soft-info',
            'diproses' => 'badge-soft-info',
            'ditolak' => 'badge-soft-danger',
            'selesai' => 'badge-soft-success',
            
            // Booking status
            'pending' => 'badge-soft-warning',
            'dikonfirmasi' => 'badge-soft-success',
            'dibatalkan' => 'badge-soft-danger',
            'selesai' => 'badge-soft-secondary',
        ];
        
        return $classes[$status] ?? 'badge-soft-secondary';
    }
}
