<?php
namespace Webkul\GDPR\Providers;

use Webkul\Core\Tree;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

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


        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/customers/account/index.blade.php'
            => resource_path('themes/velocity/views/customers/account/index.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/customers/account/partials/sidemenu.blade.php'
            => resource_path('themes/velocity/views/customers/account/partials/sidemenu.blade.php'),

            __DIR__ . '/../Resources/views/shop/default/customers/signup/index.blade.php'
            => base_path('packages/Webkul/Shop/src/Resources/views/customers/signup/index.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/customers/signup/index.blade.php'
            => resource_path('themes/velocity/views/customers/signup/index.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/layouts/master.blade.php'
            => resource_path('themes/velocity/views/layouts/master.blade.php'),

            __DIR__ . '/../Resources/views/shop/velocity/UI/header.blade.php'
            => resource_path('themes/velocity/views/UI/header.blade.php'),

            ]);

            $this->app->register(RepositoryServiceProvider::class);
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

        protected function registerConfig()
        {
            try{
                    $gdpr = DB::table('gdpr')->select('gdpr_status')->get(); 
                    if($gdpr['0']->gdpr_status == 1)
                    {
                        $this->mergeConfigFrom(
                            dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
                        );

                        $this->mergeConfigFrom(
                            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
                        );
                    }  
            }catch (\Exception $e){

                $this->mergeConfigFrom(
                    dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
                );
                
            }  
            
        }
    }
