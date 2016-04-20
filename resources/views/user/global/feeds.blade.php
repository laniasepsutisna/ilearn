@extends('user.content')

@section('subcontent')
@foreach($lms['announcements'] as $announcement)
	@if($announcement->status === 'danger')
		<div class="alert alert-warning alert-dismissible" role="alert">
			<strong>{{ $announcement->title }}</strong>
			<div>{{ $announcement->content }}</div>
		</div>
	@endif
@endforeach

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title text-bold">Timeline</h2>
	</div>
	
	<ul class="list-group">
		<li class="list-group-item">
			<article class="post">
				<p><strong><i class="fa fa-volume-up"></i> Lorem ipsum</strong></p>
				<div>Lorem ipsum dolor sit amet</div>
			</article>
		</li>
	</ul>
	
	<footer class="panel-footer text-right">
		<a href="" class="btn btn-link btn-sm">Lihat Semua</a>
	</footer>
</div>
@endsection