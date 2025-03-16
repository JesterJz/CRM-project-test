<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function contacts(): belongsToMany
    {
        return $this->belongsToMany(Contact::class, 'contact_tag');
    }

    public function opportunities(): belongsToMany
    {
        return $this->belongsToMany(Opportunity::class, 'opportunity_tag');
    }
}
