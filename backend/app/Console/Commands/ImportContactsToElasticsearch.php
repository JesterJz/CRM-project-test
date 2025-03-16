<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Elasticsearch\Common\Exceptions\NoNodesAvailableException;

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
        $contacts = Contact::all();

        $this->info('Importing contacts...');
        $contacts->each(function ($contact) {
            $contact->addToIndex();
            $this->info('Imported contact: ' . $contact->id);
        });

        $this->info('All contacts have been imported.');
    }
}
