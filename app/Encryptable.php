<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

trait Encryptable {
    
    /**
     * Override the getAttribute method to decrypt attributes when accessing them.
     */
    public function getAttribute($key) {
        $value = parent::getAttribute($key);
        // Decrypt only if the attribute is marked as encryptable and it is not empty
        if (in_array($key, $this->encryptable) && !empty($value)) {
            try {
                $value = Crypt::decryptString($value);
            } catch (\Exception $e) {
                Log::error('Failed to decrypt attribute: ' . $key);
            }
        }

        return $value;
    }

    /**
     * Override the setAttribute method to encrypt attributes when setting them.
     */
    public function setAttribute($key, $value) {
        // Encrypt the attribute if it's marked as encryptable
        if (in_array($key, $this->encryptable)) {
            if (!empty($value)) {
                $value = Crypt::encryptString($value);
            }
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Decrypt attributes when converting model to array (e.g., for API response).
     */
    public function attributesToArray() {
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key]) && !empty($attributes[$key])) {
                try {
                    $attributes[$key] = Crypt::decryptString($attributes[$key]);
                } catch (\Exception $e) {
                    Log::error('Failed to decrypt attribute: ' . $key);
                }
            }
        }

        return $attributes;
    }
}
