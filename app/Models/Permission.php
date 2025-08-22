<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    /**
     * Los usuarios que tienen este permiso.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
