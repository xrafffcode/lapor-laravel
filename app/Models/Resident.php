<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'user_id',
        'avatar',
        'full_name',
        'username',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('img/avatar.png');
    }

    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = $value->store('assets/residents', 'public');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
