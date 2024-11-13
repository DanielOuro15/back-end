<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function perfil()
    {
        return $this->belongsTo(Profile::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
