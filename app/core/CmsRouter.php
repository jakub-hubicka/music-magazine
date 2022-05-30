<?php

namespace App\Core;

class CmsRouter {

	private $routes = [];

	public function register($route, $action) {
		$this->routes[$route] = $action;
	}

	public function run() {
		$uri = parse_url($_SERVER['REQUEST_URI']);
		$path = $uri['path'];

		$pathFixed = str_replace("/root/cms", "", $path);

		foreach ($this->routes as $routePath => $routeAction) {
			if ($pathFixed === $routePath) {				
				return $routeAction;
			}
		}
	}
}