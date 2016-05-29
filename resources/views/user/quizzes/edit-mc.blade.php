@extends('user.app')

@section('content')	
	<div class="container libraries">
		<div class="row">
			<div class="col-sm-4 col-md-2 hidden-xs">
				@include('user.global.sidebars._sidebar-left')
			</div>
			<div class="col-md-10">		
				<div class="profile-form panel panel-default">
					<header class="panel-heading">
						<h2 class="panel-title text-bold">{{ $page_title }}</h2>
					</header>
					<div class="panel-body">
						{!! Form::model($questions, ['route' => ['quizzes.mc.update', $quiz->id], 'method' => 'put', 'class' => 'multiple-choice-form']) !!}
							{{--  TODO: Form update --}}
							<div class="col-md-offset-1 form-submit"> 
								{!! Form::submit('Update', ['class'=>'btn btn-flat btn-success']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection