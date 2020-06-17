<?php

namespace System;

class Route {

    const defaultController = 'ticket';
    const defaultAction = 'index';

    public static function path() {
        $route = $_SERVER['REQUEST_URI'];
        if (($pos = strpos($route, '?')) !== false) {
            $route = substr($route, 0, $pos);
        }

        $route = explode('/', $route);
        array_shift($route);

        $controller = empty($route[0]) ? self::defaultController : $route[0];
        $action = empty($route[1]) ? self::defaultAction : $route[1];

        return [$controller, $action, $route];
    }

    public static function launch() {
        list($controller, $action, $path) = self::path();
        
        try {
            $class = new $controller();

            return $class->$action();
        } catch (Exception $ex) {
            
        }
    }

}
