<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'shortcontent',
        'longcontent',
        'faq_category_id',
        'visiblefrontpage',
    ];


    public function category() {
        return $this->belongsTo(FaqCategory::class);
    }

    public function faqimages() {
        return $this->hasMany(FaqImage::class);
    }
}
