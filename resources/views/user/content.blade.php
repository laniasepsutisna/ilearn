@extends('user.app')

@section('content')
<div class="container content">
	<div class="row">
		<div class="col-sm-4 col-md-2 hidden-xs">

			@include('user.global.sidebars._sidebar-left')

		</div>

		<div class="col-sm-8 col-md-7">

			@yield('subcontent')

		</div>

		<div class="col-sm-8 custom-sm-offset-4 col-md-3 hidden-sm">

			@include( 'user.global.sidebars._sidebar-right' )

		</div>
	</div>
</div>
@endsection