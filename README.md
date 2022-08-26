# Route Service Provider [Laravel]

Custom Laravel RouteServiceProvider.

You no longer need to write all your routes in a single file (**web.php** or **api.php**) or create separate service providers for them. You can add your own separate route files with your structure. And you don't need to make changes to `App\Providers\RouteServiceProvider`!

### Requirements

* PHP >= 7.4
* Laravel >= 7

### Using

Route files are sorted by type, both for the backend and for the frontend.

```
- routes
  - backend
    - api
      ...api route files for backend
    - web
      ...web route files for backend
  - frontend
    - api
      ...api route files for frontend
    - web
      ...web route files for frontend
```

The settings are in the **config/routes.php** file.

### Custom folder for routes

You can add your own custom folder to the routes directory by specifying it in the settings file. Only in this case you will have to make changes to `App\Providers\RouteServiceProvider`, but it's only one line!

For example, let's add a new version of api (v2) for the backend. All you have to do is add the **v2** folder to the **routes/backend/api** directory and set it in the **config/routes.php** settings:

```php
 return [
     'backend' => [
         ...
         
         'api' => [
             ...
         ],
         'api2' => [
             'path' => 'backend/api/v2',
             'prefix' => 'backend/api/v2',
             'as' => 'backend.api.v2',
         ],
     ],
     
     ...
     
 ];
```

Now you have to specify in the `map()` method of the `App\Providers\RouteServiceProvider` class to track the new routes directory:

```php
public function map()
    {
        ...
        $this->mapRoutes('api2', 'api');
    }
```

There are only two commands left to run:

```bash
php artisan config:cache
php artisan route:cache
```

That's it, now you can add route files to your new **routes/backend/api/v2** directory.

### Custom root routes folder

You can store route files in a directory of your choice. For example, let's move the routes folder to the **app** directory, creating the **Routes** directory there. It remains to point our `App\Providers\RouteServiceProvider` to a new root directory of routes by specifying them in the `$root` property:

```php
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Root directory
     * @var string
     */
    private string $root = 'app/Routes';
```