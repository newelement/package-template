<?php
namespace Newelement\PackageName;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Newelement\PackageName\Facades\PackageName as PackageNameFacade;

class PackageNameServiceProvider extends ServiceProvider
{

    public function register()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('PackageName', PackageNameFacade::class);
        $this->app->singleton('packagename', function () {
            return new PackageName();
        });

        $this->loadHelpers();
        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }
    }

    public function boot(Router $router, Dispatcher $event)
    {

        $viewsDirectory = __DIR__.'/../resources/views';
        $publishAssetsDirectory = __DIR__.'/../publishable/assets';

        $this->loadViewsFrom($viewsDirectory, 'packagename');

        $this->publishes([$viewsDirectory => base_path('resources/views/vendor/packagename')], 'views');
        $this->publishes([ $publishAssetsDirectory => public_path('vendor/newelement/packagename') ], 'public');
        $this->loadMigrationsFrom(realpath(__DIR__.'/../migrations'));

        // Register routes
        // PUBLIC
        $router->group([
            'namespace' => 'Newelement\PackageName\Http\Controllers',
            'as' => 'packagename.',
            'middleware' => ['web']
        ], function ($router) {
            require __DIR__.'/../routes/web.php';
        });

        // ADMIN
        $router->group([
            'namespace' => 'Newelement\PackageName\Http\Controllers\Admin',
            'prefix' => 'admin',
            'as' => 'packagename.',
            'middleware' => ['web', 'admin.user']
        ], function ($router) {
            require __DIR__.'/../routes/admin.php';
        });

        // Register Neutrino Bonds
        $this->registerNeutrinoItems();

    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $publishablePath = dirname(__DIR__).'/publishable';

        $publishable = [
            'config' => [
                "{$publishablePath}/config/packagename.php" => config_path('packagename.php'),
            ],
            'seeds' => [
                "{$publishablePath}/database/seeds/" => database_path('seeds'),
            ],
        ];
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/packagename.php', 'packagename'
        );
    }

    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }

    private function registerNeutrinoItems()
    {
        $bond = app('NeutrinoBond');

        /*
        *
        * SAMPLE MENU ITEMS
        */

        /*
        $menuItems = [
            [
            'slot' => 4,
            'url' => '/admin/locations',
            'parent_title' => 'Locations',
            'named_route' => 'neutrino.locations',
            'fa-icon' => 'fa-map-marked',
            'children' => [
                [ 'url' => '/admin/locations', 'title' => 'All Locations' ],
                [ 'url' => '/admin/location', 'title' => 'Create Location' ],
            ]
            ]
        ];*/

        //$bond->registerMenuItems($menuItems);



        /*
        *
        * SAMPLE ENQUEUE SCRIPT AND STYLES. PUBLIC AND ADMIN.
        */

        /*
        $scripts = [
            '/vendor/newelement/packagename/js/app.js',
        ];

        $styles = [
            '/vendor/newelement/packagename/css/app.css',
        ];
        */

        //$bond->enqueueScripts($scripts);
        //$bond->enqueueStyles($styles);

        //$bond->enqueueAdminScripts($scripts);
        //$bond->enqueueAdminStyles($styles);

    }

}
