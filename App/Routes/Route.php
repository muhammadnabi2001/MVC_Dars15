<?php

namespace App\Routes;

class Route
{
    public $request;
    public static array $routes = [];
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public static function get($url, $action)
    {
        self::$routes['get'][$url] = $action;
    }
    public static function post($url, $action)
    {
        self::$request['post'][$url] = $action;
    }
    public function action()
    {
        $path = $this->request->url();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;
        if ($action == false) {
            echo "404 not found" . $path;
        }
        if (is_array($action)) {
            $controller = new $action[0]();
            $controller->{$action[1]}();
        }
    }
}
