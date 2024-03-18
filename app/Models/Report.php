<?php

namespace App\Models;

use App\Traits\UUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'resident_id',
        'code',
        'title',
        'description',
        'image',
        'latitude',
        'longitude',
        'address',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function statuses()
    {
        return $this->hasMany(ReportStatus::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getLimitDescriptionAttribute()
    {
        return substr($this->description, 0, 50) . '...';
    }

    public function latestStatus()
    {
        return $this->hasOne(ReportStatus::class)->latest();
    }
}
