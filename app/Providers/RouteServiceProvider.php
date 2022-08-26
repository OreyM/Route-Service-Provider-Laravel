<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Root directory
     * @var string
     */
    private string $root = 'routes';

    /**
     * Route settings
     * config dir routes.php file
     * @var array|\string[][][]
     */
    private array $config;

//    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';
    public const BACKEND = '/admin';
    public const USER_LOGIN = '/user/login';
    public const ADMIN_LOGIN = '/admin/login';

    public function __construct($app)
    {
        parent::__construct($app);

        $this->config = config('routes');
        $this->collectRouteFiles();
    }

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapRoutes('web', 'web');
        $this->mapRoutes('api', 'api');
    }

    /**
     * Get all route files according to configuration
     * @return void
     */
    private function collectRouteFiles(): void
    {
        foreach ($this->config as $type => $setting) {
            foreach ($setting as $key => $params) {
                $this->config[$type][$key]['files'] = array_diff(
                    scandir(sprintf('%s/%s/%s', base_path(), $this->root, $params['path'])),
                    ['.', '..']
                );
            }
        }
    }

    /**
     * Generating all application routes
     * @param string $type // by config routes.php, e.c. api, web etc.
     * @param string $middleware
     * @return void
     */
    private function mapRoutes(string $type, string $middleware): void
    {
        foreach ($this->config as $setting) {
            foreach ($setting[$type]['files'] as $file) {
                Route::middleware($middleware)
                    ->prefix($setting[$type]['prefix'])
                    ->as($setting[$type]['as'])
                    ->group(
                        base_path(
                            sprintf('%s/%s/%s', $this->root, $setting[$type]['path'], $file)
                        )
                    );
            }
        }
    }
}
