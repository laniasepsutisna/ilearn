@extends('user.classrooms.classroom')

@section('classroom_content')
	@can('manage')
		<div class="panel panel-default">
			<header class="panel-heading clearfix">
				<h2 class="panel-title text-bold">Statistik</h2>
			</header>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<canvas id="viewed-module" width="400" height="300"></canvas>
					</div>
					<div class="col-xs-12 module-description"></div>
				</div>
			</div>
		</div>
	@endcan

	<div class="panel panel-default">
		<header class="panel-heading">
			<h2 class="panel-title text-bold">{{ $course->name }}</h2>
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-3 course-picture"><img src="{{ $course->picture_sm }}"></div> 
				<div class="col-xs-9">{!! $course->description !!}</div>
				<div class="col-xs-12 modules-in-classroom">
					<ul class="list-group">
						@forelse($course->modules as $no => $module)
							<li class="list-group-item">
								<a href="{{ route('classrooms.moduledetail', [$classroom->id, $module->id]) }}">									
									@if($module->media) 
										<i class="fa fa-play"></i> 
									@else
										<i class="fa fa-book"></i> 
									@endif
									{{ $no + 1 }}. {{ $module->name }}</a>
							</li>
						@empty
							<li class="list-group-item text-center">Tidak ada modul di dalam materi ini.</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript">						
		var viewedModule = jQuery('#viewed-module');
		var data = {
			labels: [{!! implode($modules, ', ') !!}],
			datasets: [
				{
					label: "Total View",
					backgroundColor: "rgba(35,82,124,0.2)",
					borderColor: "rgba(35,82,124,1)",
					borderWidth: 1,
					hoverBackgroundColor: "rgba(15,82,124,0.4)",
					hoverBorderColor: "rgba(15,82,124,1)",
					data: [{!! implode($viewcount, ', ') !!}],
				}
			]
		};
		
		var myBarChart = new Chart(viewedModule, {
			type: 'bar',
			data: data,
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
@endsection