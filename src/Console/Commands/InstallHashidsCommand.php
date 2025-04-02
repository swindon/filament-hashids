<?php

namespace Swindon\FilamentHashids\Console\Commands;

use Illuminate\Console\Command;

class InstallHashidsCommand extends Command
{
    protected $signature = 'install:hashids';
    protected $description = 'Install the Filament Hashids package';

    public function handle()
    {
        $this->info('Publishing configuration...');
        $this->call('vendor:publish', [
            '--tag' => 'config',
            '--provider' => 'Swindon\\FilamentHashids\\FilamentHashidsServiceProvider'
        ]);

        $this->info('Filament Hashids package installed successfully.');
    }
}
