<?php

namespace App\Models;

use App\Rules\NotEmptyContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use nadar\quill\Lexer;

class SiteInfo extends Model {
    use HasFactory;

    protected $table = 'site_info';

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
    ];

    public function render(): string {
        $validator = new NotEmptyContent();
        if($validator->validate($this->description, null, function(){})) {
            return '';
        }
        $lexer = new Lexer($this->description);
        return $lexer->render();
    }
}
