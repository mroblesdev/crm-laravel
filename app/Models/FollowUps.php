<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUps extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'user_id', 'subject', 'description', 'follow_up_date', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
