<?php

namespace App;

trait ExcerptsQuill {
    public function getExcerptAttribute($quillDeltas, $length = 100): string {
        $quillDeltas = json_decode($quillDeltas);
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
        return substr($text, 0, $length);
    }
}
