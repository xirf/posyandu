<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Exception;
use Illuminate\Support\Facades\Log;

trait Encryptable {
    public function getAttribute($key) {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable) && !empty($value)) {
            $value = decrypt($value);
        }

        return $value;
    }

    public function setAttribute($key, $value) {
        if (in_array($key, $this->encryptable)) {
            $value = encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function attributesToArray() {
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = decrypt($attributes[$key]);
            }
        }

        return $attributes;
    }
}
