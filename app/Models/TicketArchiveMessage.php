<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TicketArchiveMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'message',
        'images',
        'ticket_id',
        'updated_at'
    ];

    public function ticketArchive() {
        return $this->belongsTo(TicketArchive::class);
    }

    public function deleteImages($ticketid) {
        $images = $this->select('images')->where('ticket_id', $ticketid)->whereNot('images', '')->get();

        foreach($images as $image) {
            $deletePath = explode('|', $images->images);
            foreach($deletePath as $deleteImage){
                Storage::delete(public_path($deleteImage));
            }
        }
    }
}
