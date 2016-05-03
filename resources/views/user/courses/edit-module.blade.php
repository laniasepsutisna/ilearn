@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">		
				<div class="profile-form panel panel-default">
					<header class="panel-heading clearfix">
						<h2 class="panel-title text-bold pull-left">Edit Modul</h2>
						<div class="pull-right"><a href="{{ route('courses.edit', $module->course->id) }}" class="btn-link btn-sm">Kembali ke {{ $module->course->name }} >></a></div>
					</header>
					<div class="panel-body">
						{!! Form::model($module, ['route' => ['modules.update', $module], 'method' =>'put', 'role' => 'form', 'files' => true]) !!}
							@include('user.courses._form-module', ['model' => $module])
							{!! Form::button('Edit', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection