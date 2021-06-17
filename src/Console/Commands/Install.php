<?php

namespace Webkul\GDPR\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gdpr:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will prepare the GDPR package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate', [], $this->getOutput());

        Artisan::call('db:seed', [
            '--class' => "Webkul\\GDPR\\Database\\Seeders\\GdprTableSeeder"
        ], $this->getOutput());

        Artisan::call('optimize', [], $this->getOutput());
        Artisan::call('vendor:publish', [
            '--provider' => "Webkul\GDPR\Providers\GDPRServiceProvider",
            '--force'    => true
        ], $this->getOutput());
    }
}
