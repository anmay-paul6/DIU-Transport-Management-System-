<?php
class Router
{
    private static $routes = [
    ''                          => ['Home',    'index'],
    'home'                      => ['Home',    'index'],

    // Add specific signup routes for each user type
    'student/signup'            => ['Student', 'signup'],
    'driver/signup'             => ['Driver',  'signup'],
    'admin/signup'              => ['Admin',   'signup'],

    'admin/dashboard'           => ['Admin',   'dashboard'],
    'admin/users'               => ['Admin',   'users'],
    'admin/buses'               => ['Admin',   'buses'],
    'admin/buses/add'           => ['Admin',   'addBus'],
    'admin/buses/edit/(:num)'  => ['Admin',   'editBus'],
    'admin/buses/delete/(:num)' => ['Admin',   'deleteBus'],
    'admin/transports'          => ['Admin',   'transports'],
    'admin/transports/delete/(:num)' => ['Admin', 'deleteTransport'],

    'driver/index'              => ['Driver',  'index'],
    'driver/logout'             => ['Driver',  'logout'],

    'student/index'             => ['Student', 'index'],
    'student/logout'            => ['Student', 'logout'],
    'student/schedule'          => ['Student', 'schedule'],


    // ... other routes ...
    'admin/bus-seats/(:num)' => ['Admin', 'busSeats'],
    'admin/bus-seats/delete/(:num)/(:num)' => ['Admin', 'deleteSeat'],

    // Existing routes:
    'admin/dashboard' => ['Admin', 'dashboard'],
    'admin/buses' => ['Admin', 'buses'],

    // New routes for bus seat booking
    'student/bus-seats/(:num)'          => ['Student', 'viewBusSeats'],
    'student/bus-seats/(:num)/book'     => ['Student', 'bookSeat'], // optional if you want separate POST

    // ... other routes ...
];



    /**
     * Route the current request.
     */
    public static function route($url)
    {
        $path = implode('/', $url);

        // Try exact match
        if (isset(self::$routes[$path])) {
            $controller = ucfirst(self::$routes[$path][0]) . 'Controller';
            $method     = self::$routes[$path][1];
            $params     = array_slice($url, count(explode('/', $path)));
            self::dispatch($controller, $method, $params);
            return;
        }

        // Try parameterized routes: pattern with (:num) or (:any)
        foreach (self::$routes as $pattern => $route) {
            $regex = '#^' . preg_replace(['/:num/', '/:any/'], ['(\d+)', '([^/]+)'], $pattern) . '$#';
            if ($pattern !== '' && preg_match($regex, $path, $matches)) {
                $controller = ucfirst($route[0]) . 'Controller';
                $method     = $route[1];
                $params     = array_slice($matches, 1);
                self::dispatch($controller, $method, $params);
                return;
            }
        }

        // Default: /controller/method/param1/param2...
        $controller = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
        $method     = isset($url[1]) ? $url[1] : 'index';
        $params     = array_slice($url, 2);
        self::dispatch($controller, $method, $params);
    }

    private static function dispatch($controller, $method, $params)
    {
        $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controller)) {
                $controllerInstance = new $controller();
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $params);
                } else {
                    self::error("Method '$method' not found in controller '$controller'.");
                }
            } else {
                self::error("Controller class '$controller' does not exist.");
            }
        } else {
            self::error("Controller file '$controllerFile' not found.");
        }
    }

    private static function error($msg, $code = 404)
    {
        http_response_code($code);
        if (file_exists(__DIR__ . '/../app/views/errors/404.php')) {
            require __DIR__ . '/../app/views/errors/404.php';
        } else {
            echo "<h1>404 Not Found</h1><p>$msg</p>";
        }
        exit;
    }
}
