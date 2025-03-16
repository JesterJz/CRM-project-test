<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactBulkDeleteRequest;
use App\Http\Requests\ContactBulkUpdateRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactListResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $contacts = $this->contactService->getContacts($request);
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactStoreRequest $request
     * @return JsonResponse
     */
    public function store(ContactStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['creator_id'] = $request->user()->id;
        $contact = Contact::create($data);
        return response()->json($contact, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ContactUpdateRequest $request, int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Contacts removed successfully'], Response::HTTP_ACCEPTED);
    }

    /**
     * @param ContactBulkUpdateRequest $request
     * @return JsonResponse
     */
    public function bulkUpdate(ContactBulkUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $ids = array_column($data, 'id');
        $contacts = Contact::whereIn('id', $ids)->get();
        foreach ($contacts as $contact) {
            $contactData = collect($data)->firstWhere('id', $contact->id);
            $contact->update($contactData);
        }
        return response()->json(['message' => 'Contacts updated successfully']);
    }

    /**
     * @param ContactBulkDeleteRequest $request
     * @return JsonResponse
     */
    public function bulkDelete(ContactBulkDeleteRequest $request): JsonResponse
    {
        $ids = $request->input('ids');
        Contact::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Contacts deleted successfully']);
    }
}
