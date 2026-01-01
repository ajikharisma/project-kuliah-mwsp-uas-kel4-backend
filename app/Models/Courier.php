<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = ['name', 'avatar', 'is_online'];

    protected $appends = ['avatar_url'];

    protected $hidden = ['created_at', 'updated_at'];

    public function getAvatarUrlAttribute()
    {
        if (!$this->avatar) {
            return null;
        }

        return asset('storage/' . $this->avatar);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}

