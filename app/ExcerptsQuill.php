<?php

namespace App;

trait ExcerptsQuill {
    public function getExcerptFromQuill($quillDeltas, $length = 100): string {
        dd($quillDeltas);
        $quillDeltas = json_decode($quillDeltas);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ''; // Return empty string if JSON decoding fails
        }



        $text = '';
        $currentLength = 0;

        foreach ($quillDeltas as $op) {
            if (is_string($op->insert)) {
                $text .= $op->insert;
                $currentLength += strlen($op->insert);
            }
            if ($currentLength >= $length) {
                break;
            }
        }

        // Unset variables to free up memory
        unset($quillDeltas, $currentLength);

        return substr($text, 0, $length);
    }
}