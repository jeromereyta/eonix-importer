<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\ImportService;



/**
 * Class ImportCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class ImportCustomerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "import:customers";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import Customers";

    protected $importService;

    public function __construct(ImportService $importService)
    {
        parent::__construct();
        $this->importService = $importService;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->importService->importCustomers();
            $this->info("Done");
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }
}