<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = [
        'watched' => 'bool'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    protected function watched(): Attribute
    {
        return new Attribute(
            fn($watched) => (bool) $watched,
            fn($watched) => (bool) $watched,
        );
    }
}

