<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RemoveLawCrmModules extends Command
{
    protected $signature = 'crm:remove-law-modules';

    protected $description = 'Drop Intake/Workflow/Case Files/Municipality/Bulk Update/Historical Data menu entries and tables';

    public function handle(): int
    {
        $this->warn('Removing law CRM leftovers (menu + tables)...');

        $exit = Artisan::call('migrate', [
            '--path' => 'database/migrations/2026_09_26_160000_remove_law_crm_modules.php',
            '--force' => true,
        ]);

        $this->line(Artisan::output());

        if ($exit === 0) {
            $this->info('Done. Refresh admin sidebar.');
        } else {
            $this->error('Migration failed. You can run database/sql/drop_law_crm_modules.sql manually.');
        }

        return $exit;
    }
}
