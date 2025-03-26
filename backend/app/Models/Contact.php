<?php

namespace App\Models;

use App\Traits\ElasticsearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Contact extends Model
{
    use HasFactory, ElasticsearchTrait, softDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'manager_id',
        'creator_id',
    ];

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

    public function lists(): belongsToMany
    {
        return $this->belongsToMany(ListContact::class, 'contact_list', 'contact_id', 'list_id');
    }

    public static function search($query)
    {
        $client = app('elasticsearch');
        $index = (new static)->getElasticsearchIndex();
        // Check if the index exists
        if (!$client->indices()->exists(['index' => $index])) {
            // Create the index if it does not exist
            $client->indices()->create(['index' => $index]);
        }

        return $client->search([
            'index' => $index,
            'body' => $query
        ]);
    }
}
