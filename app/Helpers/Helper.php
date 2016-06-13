<?php

use Carbon\Carbon;

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

function selected_classroom($id, $output = 'active')
{
	return Request::is('classrooms/' . $id . '*') ? $output : null;
}

function is_detailpage()
{
	$routes = [
		'classrooms.discussiondetail',
		'classrooms.assignmentdetail',
		'classrooms.coursedetail',
		'classrooms.moduledetail',
		'classrooms.quizdetail'
	];

	foreach ($routes as $route) {
		if (Route::currentRouteNamed($route)) {
			return true;
		}
	}
	
	return false;
}

function formatDate($date)
{
	return Carbon::parse($date)->format('d M Y');
}