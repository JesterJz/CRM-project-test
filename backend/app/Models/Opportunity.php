<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id', 'creator_id', 'pipeline_id'];

    public function manager(): belongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function creator(): belongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function pipeline(): belongsTo
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function tags(): belongsToMany
    {
        return $this->belongsToMany(Tag::class, 'opportunity_tag');
    }
}
