<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = [
        'likeable_id', 'likeable_type'
    ];

    public function likeable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
