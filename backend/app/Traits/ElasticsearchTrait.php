<?php

namespace App\Traits;

trait ElasticsearchTrait
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootElasticsearchTrait(): void
    {
        static::created(function ($model) {
            $model->addToIndex();
        });

        static::updated(function ($model) {
            $model->updateIndex();
        });

        static::deleted(function ($model) {
            $model->removeFromIndex();
        });
    }

    /**
     * Get the Elasticsearch index table name.
     *
     * @return string
     */
    public function getElasticsearchIndex(): string
    {
        return $this->getTable();
    }

    /**
     * Get the Elasticsearch type.
     *
     * @return string
     */
    public function getElasticsearchType(): string
    {
        return '_doc';
    }

    /**
     * Get the Elasticsearch ID.
     *
     * @return string
     */
    public function getElasticsearchId(): string
    {
        return $this->getKey();
    }

    /**
     * Get the Elasticsearch data.
     *
     * @return array
     */
    public function getElasticsearchData(): array
    {
        return $this->toArray();
    }

    /**
     * Add the model to the Elasticsearch index.
     *
     * @return void
     */
    public function addToIndex(): void
    {
        $client = app('elasticsearch');
        $client->index([
            'index' => $this->getElasticsearchIndex(),
            'type' => $this->getElasticsearchType(),
            'id' => $this->getElasticsearchId(),
            'body' => $this->getElasticsearchData(),
        ]);
    }

    /**
     * Update the model in the Elasticsearch index.
     *
     * @return void
     */
    public function updateIndex(): void
    {
        $client = app('elasticsearch');
        $client->update([
            'index' => $this->getElasticsearchIndex(),
            'type' => $this->getElasticsearchType(),
            'id' => $this->getElasticsearchId(),
            'body' => [
                'doc' => $this->getElasticsearchData(),
            ],
        ]);
    }

    /**
     * Remove the model from the Elasticsearch index.
     *
     * @return void
     */
    public function removeFromIndex(): void
    {
        $client = app('elasticsearch');
        $client->delete([
            'index' => $this->getElasticsearchIndex(),
            'type' => $this->getElasticsearchType(),
            'id' => $this->getElasticsearchId(),
        ]);
    }
}
