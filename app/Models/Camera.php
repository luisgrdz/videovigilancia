<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = [
        'name',
        'ip',
        'location',
        'status',
        'group',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}