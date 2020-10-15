<?php

namespace App\Jobs;

class ImportCustomersJob extends Job
{

    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('import:customers');
    }
}
