<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'title',
        'abstract',
        'field',
        'year',
        'document',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
