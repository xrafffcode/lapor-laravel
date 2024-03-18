<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ReportStatus extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'report_id',
        'status',
        'description',
        'image',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return null;
    }

    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value->store('assets/report-statuses', 'public');
        }
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
