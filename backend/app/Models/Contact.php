<?php

namespace App\Models;

use App\Traits\ElasticsearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Contact extends Model
{
    use HasFactory, ElasticsearchTrait;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'manager_id', 'created_by', 'tag_id', 'list_id'
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

    public static function search($query): Collection
    {
        $client = app('Elasticsearch');
        $index = (new static)->getElasticsearchIndex();
        // Check if the index exists
        if (!$client->indices()->exists(['index' => $index])) {
            // Create the index if it does not exist
            $client->indices()->create(['index' => $index]);
        }

        $items = $client->search([
            'index' => $index,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => config('define.contact.fields'),
                    ],
                ],
            ],
        ]);

        return collect($items['hits']['hits'])->map(function ($hit) {
            return $hit['_source'];
        });
    }
}
