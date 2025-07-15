<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Exception;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $apiKey = config('services.cloudinary.api_key');
        $apiSecret = config('services.cloudinary.api_secret');

        // Validate configuration
        if (!$cloudName || !$apiKey || !$apiSecret) {
            Log::error('Cloudinary configuration missing', [
                'cloud_name' => $cloudName,
                'api_key' => $apiKey,
                'api_secret' => $apiSecret ? '****' : null,
            ]);

            throw new \RuntimeException('Cloudinary configuration not set. Check your .env file.');
        }

        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloudName,
                'api_key'    => $apiKey,
                'api_secret' => $apiSecret,
            ]
        ]);
    }

    public function uploadFile($filePath, $folder = 'trustnetx/deposit-proof')
    {
        try {
            $response = $this->cloudinary->uploadApi()->upload($filePath, [
                'folder' => $folder,
            ]);

            return $response['secure_url'] ?? null;
        } catch (Exception $e) {
            Log::error('Cloudinary upload failed', [
                'error' => $e->getMessage(),
                'file_path' => $filePath,
            ]);
            return null;
        }
    }
}
