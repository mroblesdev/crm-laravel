<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeFollowUp extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'color',
    ];

    public function followUps()
    {
        return $this->hasMany(FollowUps::class);
    }
}
