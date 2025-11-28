<?php

if (!function_exists('room_image_url')) {
    /**
     * Get room image URL with fallback to placeholder
     *
     * @param string|null $imagePath
     * @param int $width
     * @param int $height
     * @param string|null $text
     * @return string
     */
    function room_image_url($imagePath = null, $width = 400, $height = 280, $text = null)
    {
        // Check if image exists
        if ($imagePath && file_exists(public_path('storage/' . $imagePath))) {
            return asset('storage/' . $imagePath);
        }
        
        // Use local SVG placeholder instead of via.placeholder.com
        // This avoids internet dependency and DNS issues
        return asset('travo/img/placeholder-blue.svg');
    }
}

if (!function_exists('get_placeholder_gallery')) {
    /**
     * Get array of placeholder images for gallery
     *
     * @param int $count
     * @param int $width
     * @param int $height
     * @return array
     */
    function get_placeholder_gallery($count = 3, $width = 800, $height = 450)
    {
        $placeholders = [];
        
        // Alternate between blue and dark blue placeholders
        for ($i = 0; $i < $count; $i++) {
            if ($i % 2 == 0) {
                $placeholders[] = asset('travo/img/placeholder-blue.svg');
            } else {
                $placeholders[] = asset('travo/img/placeholder-dark-blue.svg');
            }
        }
        
        return $placeholders;
    }
}

if (!function_exists('asset_image_url')) {
    /**
     * Get asset image URL with fallback to placeholder
     *
     * @param string $path Path relative to public/travo/img/
     * @param int $width
     * @param int $height
     * @param string|null $text
     * @return string
     */
    function asset_image_url($path, $width = 400, $height = 300, $text = null)
    {
        $fullPath = public_path('travo/img/' . $path);
        
        if (file_exists($fullPath)) {
            return asset('travo/img/' . $path);
        }
        
        // Return local SVG placeholder
        return asset('travo/img/placeholder-blue.svg');
    }
}

if (!function_exists('logo_url')) {
    /**
     * Get logo URL with fallback
     *
     * @param string $type 'main' or 'favicon'
     * @return string
     */
    function logo_url($type = 'main')
    {
        if ($type === 'favicon') {
            $path = public_path('travo/img/kosan-diriq-favicon.png');
            if (file_exists($path)) {
                return asset('travo/img/kosan-diriq-favicon.png');
            }
            return asset('travo/img/favicon.svg');
        }
        
        // Main logo
        $path = public_path('travo/img/kosan-diriq.png');
        if (file_exists($path)) {
            return asset('travo/img/kosan-diriq.png');
        }
        
        // Fallback to placeholder
        return "https://via.placeholder.com/200x50/2196F3/ffffff?text=KOSAN+DIRIQ";
    }
}

if (!function_exists('background_image_url')) {
    /**
     * Get background image URL with fallback
     *
     * @param string $path Path relative to public/travo/img/
     * @param string $fallbackColor Hex color without #
     * @return string
     */
    function background_image_url($path, $fallbackColor = '2196F3')
    {
        $fullPath = public_path('travo/img/' . $path);
        
        if (file_exists($fullPath)) {
            return asset('travo/img/' . $path);
        }
        
        // Return local SVG placeholder for backgrounds
        return asset('travo/img/placeholder-blue.svg');
    }
}
