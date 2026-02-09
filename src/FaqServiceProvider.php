<?php

declare(strict_types=1);

namespace Misaf\VendraFaq;

use Filament\Panel;
use Illuminate\Foundation\Console\AboutCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class FaqServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vendra-faq')
            ->hasTranslations()
            ->hasMigrations([
                'create_faqs_table'
            ])
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command->askToStarRepoOnGitHub('misaf/vendra-faq');
            });
    }

    public function packageRegistered(): void
    {
        Panel::configureUsing(function (Panel $panel): void {
            if ('admin' !== $panel->getId()) {
                return;
            }

            $panel->plugin(FaqPlugin::make());
        });
    }

    public function packageBooted(): void
    {
        AboutCommand::add('Vendra Faq', fn() => ['Version' => 'dev-master']);
    }
}
