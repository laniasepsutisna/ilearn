@extends('home')
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/announcements') }}">
    {!! csrf_field() !!}
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
    <div class="form-group">
        <label class="col-md-3 control-label">Title</label>

        <div class="col-md-8">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus="autofocus">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Content</label>

        <div class="col-md-8">
        	<textarea name="content" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-3">
            <button id="loginButton" class="btn btn-primary" type="submit">                                
                <span class="login-loader hide"><i class="fa fa-spin fa-circle-o-notch"></i></span>
                <span class="sign-in"><i class="fa fa-btn fa-sign-in"></i></span>
                Login
            </button>
        </div>
    </div>
</form>
@endsection