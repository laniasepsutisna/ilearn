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
						{!! Form::model($question, ['route' => ['quizzes.mc.update', $quiz->id, $question->id], 'method' => 'put', 'class' => 'multiple-choice-form']) !!}
							@include('user.quizzes._form-edit-mc', ['model' => $question])
							<a class="btn btn-danger btn-flat" href="{{ route('quizzes.edit', $quiz->id) }}"><i class="fa fa-times"></i> Batal</a>
							{!! Form::button('<i class="fa fa-save"></i> Update', ['class'=>'btn btn-flat btn-success', 'type' => 'submit']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection