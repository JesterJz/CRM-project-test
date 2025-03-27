<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;

class ImportContactsToElasticsearch extends Command
{
    protected $signature = 'import:contacts';
    protected $description = 'Import all contacts into Elasticsearch';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Importing contacts...');
        $contacts = Contact::with(['manager', 'creator', 'tags', 'lists'])->get();
        $contacts->each(function ($contact) {
            $contact->addToIndex([
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'manager' => $contact->manager->name,
                'creator' => $contact->creator->name,
                'tags' => $contact->tags ? $contact->tags->pluck('id')->toArray() : [],
                'lists' => $contact->lists ? $contact->lists->pluck('id')->toArray() : [],
                'created_at' => $contact->created_at,
            ]);
            $this->info('Imported contact: ' . $contact->id);
        });

        $this->info('All contacts have been imported.');
    }
}
