<?php

namespace App\Traits;

use Elastic\Elasticsearch\Client;

trait Searchable
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootSearchable()
    {
        static::created(function ($model) {
            $model->elasticsearchIndex();
        });

        static::updated(function ($model) {
            $model->elasticsearchUpdate();
        });

        static::deleted(function ($model) {
            $model->elasticsearchDelete();
        });
    }

    public function elasticsearchIndex()
    {
        if (!method_exists($this, 'toSearchArray')) {
            return;
        }

        $elasticsearch = app(Client::class);
        $elasticsearch->index([
            'index' => $this->getSearchIndex(),
            'id' => $this->getKey(),
            'body' => $this->toSearchArray(),
        ]);
    }

    public function elasticsearchUpdate()
    {
        if (!method_exists($this, 'toSearchArray')) {
            return;
        }

        $elasticsearch = app(Client::class);
        $elasticsearch->update([
            'index' => $this->getSearchIndex(),
            'id' => $this->getKey(),
            'body' => [
                'doc' => $this->toSearchArray(),
            ],
        ]);
    }

    public function elasticsearchDelete()
    {
        $elasticsearch = app(Client::class);
        $elasticsearch->delete([
            'index' => $this->getSearchIndex(),
            'id' => $this->getKey(),
        ]);
    }

    public function getSearchIndex()
    {
        return $this->getTable();
    }
}
