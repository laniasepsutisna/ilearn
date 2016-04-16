<?php

function set_active($routes, $output = 'active')
{
	if( is_array($routes) ) {
		foreach ($routes as $u) {
			if (Route::currentRouteNamed($u)) {
				return $output;
			}
		}
	} else {
		if (Route::currentRouteNamed($routes)){
			return $output;
		}
	}
}