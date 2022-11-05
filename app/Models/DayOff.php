<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOff extends Model
{
    use HasFactory;

    protected $fillable = [
        'shifts',
        'date',
        'reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
