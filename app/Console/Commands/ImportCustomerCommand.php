<?php

namespace App\Console\Commands;

use App\Services\ImportService;
use Exception;
use Illuminate\Console\Command;

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
    
            $customers = $this->importService->generateCustomersFromDataProvider();
    
            $this->importService->importCustomers($customers);
    
            $this->info("Done");
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }
}
