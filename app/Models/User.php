<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];


    protected $hidden = [
        'password'
    ];

    public function setpasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function groups() {
        //TODO Ersetzen mit GroupDetail::class
        return $this->hasMany(GroupDetailModel::class, 'userid');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function ticketmessages() {
        return $this->hasMany(TicketMessage::class);
    }

    public function assetRentals() {
        return $this->hasMany(AssetRental::class, 'user_id');
    }

}
