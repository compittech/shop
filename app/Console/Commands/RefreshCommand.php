<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(app()->isProduction()) {
            return self::FAILURE;
        }
        if(Storage::deleteDirectory('images/products')) {
            $this->line('Папка images/products удалена');
        }
        $this->call('migrate:fresh', [
            '--seed'=>true
        ]);
        return self::SUCCESS;
    }
}
