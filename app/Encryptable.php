<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

trait Encryptable {

    // Decrypt values when retrieving from the database
    public function getAttribute($key) {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            try {
                return Crypt::decrypt($value);
            } catch (Exception $e) {
                Log::error("Failed to decrypt $key: " . $e->getMessage());
                return null;
            }
        }

        return $value;
    }

    // Encrypt values when saving to the database
    public function setAttribute($key, $value) {
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                $value = Crypt::encrypt($value);
            } catch (Exception $e) {
                Log::error("Failed to encrypt $key: " . $e->getMessage());
            }
        }

        return parent::setAttribute($key, $value);
    }
}
