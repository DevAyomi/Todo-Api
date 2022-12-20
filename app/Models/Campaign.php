<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'details' => 'array'
    ];

    //Relationship defined here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
