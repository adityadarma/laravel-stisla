<?php

namespace AdityaDarma\LaravelStisla\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LaravelStislaInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stisla:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will publish aset file of template stisla';

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
     * @return void
     */
    public function handle(): void
    {
        // assets
        if (File::exists(public_path('assets'))) {
            $confirm = $this->confirm("assets file already exist. Do you want to overwrite?");
            if ($confirm) {
                $this->publishAssets();
                $this->info("assets overwrite finished");
            } else {
                $this->info("skipped assets publish");
            }
        } else {
            $this->publishAssets();
            $this->info("assets published");
        }

        // views
        if (File::exists(resource_path('views/layouts'))) {
            $confirm = $this->confirm("views file already exist. Do you want to overwrite?");
            if ($confirm) {
                $this->publishViewss();
                $this->info("views overwrite finished");
            } else {
                $this->info("skipped views publish");
            }
        } else {
            $this->publishViewss();
            $this->info("views published");
        }
    }

    private function publishAssets(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "AdityaDarma\LaravelStisla\LaravelStislaServiceProvider",
            '--tag'      => 'assets',
            '--force'    => true
        ]);
    }

    private function publishViewss(): void
    {
        $this->call('vendor:publish', [
            '--provider' => "AdityaDarma\LaravelStisla\LaravelStislaServiceProvider",
            '--tag'      => 'views',
            '--force'    => true
        ]);
    }
}
