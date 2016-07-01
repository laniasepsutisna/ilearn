@extends('user.app')

@section('content')	
  <div class="container" id="luar" style="padding-top: 100px;">
    <div class="row">
      <div class="col-sm-12 text-center">
      	<h1 class="no-content">Maaf, quiz sudah selesai :)</h1>
      	<p>Silakan <a href="{{ route('classrooms.show', $classroom->id) }}">kembali.</a></p>
      </div>
   </div>
 </div>
@endsection