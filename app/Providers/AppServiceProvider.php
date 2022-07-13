<?php

namespace App\Providers;

use App\View\Components\Breadcrumb;
use App\View\Components\BreadcrumbItem;
use App\View\Components\ButtonLink;
use App\View\Components\PageHeader;
use App\View\Components\RowMenu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('pt_BR');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('package-breadcrumb', Breadcrumb::class);
        Blade::component('package-pageheader', PageHeader::class);
        Blade::component('package-button-link', ButtonLink::class);
        Blade::component('package-breadcrumb-item', BreadcrumbItem::class);
        Blade::component('package-row-menu', RowMenu::class);
    }
}
