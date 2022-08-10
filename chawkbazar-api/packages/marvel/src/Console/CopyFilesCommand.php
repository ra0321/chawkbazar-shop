<?php

namespace Marvel\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Marvel\Database\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Marvel\Enums\Permission as UserPermission;
use Illuminate\Support\Facades\Validator;




class CopyFilesCommand extends Command
{
    protected $signature = 'marvel:copy-files';

    protected $description = 'Copy necessary files';
    public function handle()
    {
        try {
            (new Filesystem)->ensureDirectoryExists(resource_path('views/emails'));

            $this->info('Copying resources files...');

            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/emails', resource_path('views/emails'));

            $this->info('Installation Complete');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
