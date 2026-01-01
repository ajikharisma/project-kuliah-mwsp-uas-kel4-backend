<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    protected $fillable = [
        'user_id',
        'courier_id',
    ];

    public function courier() {
        return $this->belongsTo(Courier::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function lastMessage() {
        return $this->hasOne(Message::class)->latestOfMany();
    }
}


