<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;

class EncryptionService
{
    /**
     * Encrypt any data type safely.
     */
    public function encrypt(mixed $value): ?string
    {
        try {
            return Crypt::encrypt($value);
        } catch (\Exception $e) {
            Log::error('Encryption failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Decrypt data back to its original data type safely.
     */
    public function decrypt(?string $payload): mixed
    {
        if (empty($payload)) {
            return null;
        }

        try {
            return Crypt::decrypt($payload);
        } catch (DecryptException $e) {
            Log::warning('Decryption failed. Tampered or invalid payload: ' . $e->getMessage());
            return null;
        }
    }
}
