<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class StartProjectCommand extends Command
{
    protected $signature = 'project:start';

    protected $description = 'Start the project by running key:generate, migrate, seed, and serve';

    public function handle()
    {
        // Generate key
        $this->info('Key generating...');
        Artisan::call('key:generate');
        $this->line(Artisan::output());

        // Run migrations
        $this->info('Running migrations...');
        Artisan::call('migrate');
        $this->line(Artisan::output());

        // Run seeder
        $this->info('Running database seeder...');
        Artisan::call('db:seed');
        $this->line(Artisan::output());

        // Start the server
        $this->info('Starting the server...');
        Artisan::call('serve --host=0.0.0.0 --port=8000');
        $this->line(Artisan::output());

        return 0;
    }
}
