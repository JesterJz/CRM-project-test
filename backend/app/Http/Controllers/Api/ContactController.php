<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $contacts = Contact::search($query);
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(null, 204);
    }

    public function bulkUpdate(Request $request)
    {
        $ids = $request->input('ids');
        $data = $request->except('ids');
        Contact::whereIn('id', $ids)->update($data);
        return response()->json(['message' => 'Contacts updated successfully']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        Contact::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Contacts deleted successfully']);
    }
}
