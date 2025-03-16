<?php

namespace App\Services;

use App\Models\Contact;
use \Illuminate\Http\JsonResponse;

class ContactService
{
    /**
     * Retrieves a paginated list of contacts with their associated tags.
     *
     * @param $request
     * @return array
     */
    public function getContacts($request): array
    {
        $query = ['bool' => ['must' => []]];

        if ($request->has('created_at')) {
            $query['bool']['must'][] = [
                'range' => ['created_at' => ['gte' => $request->created_at]]
            ];
        }

        if ($request->has('creator_id')) {
            $query['bool']['must'][] = [
                'term' => ['creator_id' => $request->creator_id]
            ];
        }

        if ($request->has('email')) {
            $query['bool']['must'][] = [
                'term' => ['email' => $request->email]
            ];
        }

        if ($request->has('manager')) {
            $query['bool']['must'][] = [
                'match' => ['manager' => $request->manager]
            ];
        }

        if ($request->has('tags')) {
            $query['bool']['must'][] = [
                'terms' => ['tags.id' => $request->tag]
            ];
        }


        if ($request->has('lists')) {
            $query['bool']['must'][] = [
                'term' => ['lists.id' => $request->list]
            ];
        }

        if ($request->has('search')) {
            $query['bool']['must'][] = [
                'multi_match' => [
                    'query' => $request->search,
                    'fields' => ['name', 'manager', 'phone', 'email']
                ]
            ];
        }

        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $offset = ($page - 1) * $limit;

        $results = Contact::search([
            'query' => $query,
            'size' => $limit,
            'from' => $offset
        ]);

        return [
            'success' => true,
            'data' => array_map(fn($hit) => $hit['_source'], $results['hits']['hits']),
            'total' => $results['hits']['total']['value'],
            'page' => (int)$page,
            'limit' => (int)$limit
        ];
    }
}
