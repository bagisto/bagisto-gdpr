<?php

namespace Webkul\GDPR\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Webkul\GDPR\Console\Commands\Install;

class GDPRServiceProvider extends ServiceProvider
    {
        /**
        * Bootstrap services.
        *
        * @return void
        */
        public function boot(Router $router)
        {
            include __DIR__ . '/../Http/admin-routes.php';

            include __DIR__ . '/../Http/front-routes.php';

            $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'gdpr');

            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'gdpr');

            $this->loadMigrationsFrom(__DIR__ .'/../Database/Migrations');

            $this->loadPublishableAssets();

            $this->app->register(RepositoryServiceProvider::class);

            $this->app->register(EventServiceProvider::class);

            if ($this->app->runningInConsole()) {
                $this->commands([
                    Install::class,
                ]);
            }
        }

        /**
         * This method will load all publishables.
         *
         * @return boolean
         */
        public function loadPublishableAssets()
        {
            $this->publishes([
                __DIR__ . '/../../publishable/assets/' => public_path('vendor/webkul/gdpr/assets'),
            ], 'public');

            
            $this->publishes([
                
                __DIR__ . '/../Resources/views/shop/default/customers/account/partials/sidemenu.blade.php'
                => resource_path('themes/default/views/customers/account/partials/sidemenu.blade.php'),
    
                __DIR__ . '/../Resources/views/shop/default/customers/signup/index.blade.php'
                => resource_path('themes/default/views/customers/signup/index.blade.php'),

                __DIR__ . '/../Resources/views/shop/default/layouts/master.blade.php'
                => resource_path('themes/default/views/layouts/master.blade.php'),
               
                __DIR__ . '/../Resources/views/shop/velocity/customers/account/partials/sidemenu.blade.php'
                => resource_path('themes/velocity/views/customers/account/partials/sidemenu.blade.php'),

                __DIR__ . '/../Resources/views/shop/velocity/customers/signup/index.blade.php'
                => resource_path('themes/velocity/views/customers/signup/index.blade.php'),
    
                __DIR__ . '/../Resources/views/shop/velocity/layouts/master.blade.php'
                => resource_path('themes/velocity/views/layouts/master.blade.php'),
    
            ]);
        }

        /**
        * Register services.
        *
        * @return void
        */
        public function register()
        {
            $this->registerConfig();
        }

        /**
         * Register package config.
         *
         * @return void
         */
        protected function registerConfig()
        {   
            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
            );

            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
            );
        }
    }
