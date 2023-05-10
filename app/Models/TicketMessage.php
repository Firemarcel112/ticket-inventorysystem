<?php

namespace App\Models;

use App\Http\Controllers\ConfigController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'images',
        'user_id',
        'ticket_id'
    ];

    public function moveImagesToArchive($ticketid, $folder = ConfigController::FOLDERPATHARCHIVE) {

    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
