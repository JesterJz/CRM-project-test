<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'manager_id', 'creator_id', 'contact_id', 'opportunity_id'];

    public function manager(): belongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function creator(): belongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function contact(): belongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function opportunity(): belongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }
}
