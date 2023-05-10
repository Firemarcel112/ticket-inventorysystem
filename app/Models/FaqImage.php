<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagepath',
        'imagedescription',
        'faq_id'
    ];

    public function faq() {
        return $this->belongsTo(Faq::class);
    }
}
