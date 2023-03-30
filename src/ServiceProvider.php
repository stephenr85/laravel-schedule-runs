<?php

namespace Rushing\Scheduleruns;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('schedule-runs')
            ->hasMigrations([
                'create_schedule_runs_table',
            ])
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('stephenr85/laravel-schedule-runs');
            });
    }
}
