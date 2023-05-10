<?php

namespace App\Models;

use App\Http\Controllers\ConfigController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'content',
        'category_id',
        'status_id',
        'user_id',
        'assigner_id',
        'group_id'
    ];

    public function category() {
        return $this->belongsTo(TicketCategory::class);
    }

    public function status() {
        return $this->belongsTo(TicketStatus::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assigner() {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    public function group() {
        //TODO Ersetzen mit GroupRight::class
        return $this->belongsTo(GroupRightsModel::class);
    }

    public function messages() {
        return $this->hasMany(TicketMessage::class);
    }

}
