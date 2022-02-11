<?php

namespace Pmilinvest\Monetico\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallMoneticoPackage extends Command
{
    protected $signature = 'monetico:install';

    protected $description = 'Install the Monetico Package';

    public function handle()
    {
        $this->info('Installing Monetico Package...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('monetico.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed Monetico Package');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "namespace Pmilinvest\Monetico\MoneticoServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
