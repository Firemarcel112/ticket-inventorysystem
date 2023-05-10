<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'ticket_id',
        'content',
        'username',
        'category',
        'assigned_to',
        'archived_at'
    ];

    public function messages() {
        return $this->hasMany(TicketArchiveMessage::class, 'ticket_id', 'ticket_id');
    }
}
