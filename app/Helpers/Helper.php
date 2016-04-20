<?php

function set_active($routes, $output = 'active')
{
	if( is_array($routes) ) {
		foreach ($routes as $route) {
			if (Route::currentRouteNamed($route)) {
				return $output;
			}
		}
	} else {
		if (Route::currentRouteNamed($routes)){
			return $output;
		}
	}
}