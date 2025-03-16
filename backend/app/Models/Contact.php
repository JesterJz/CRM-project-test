<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'manager_id', 'creator_id'];

    public function manager(): belongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function creator(): belongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class, 'contact_tag');
    }
}
