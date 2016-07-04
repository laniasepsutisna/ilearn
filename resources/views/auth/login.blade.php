@extends('front')

@section('content')
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="loginModalLabel">Masuk ke E-Learning</h4>
				</div>
				<div class="modal-body">
                    {!! Form::open(['url' => route('auth.login'), 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Username', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('username', null, ['class' => 'form-control', 'autofocus' => 'autofocus'] ) !!}
                                {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Ingatkan saya
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                {!! Form::button('<i class="fa fa-btn fa-sign-in"></i> Login', ['class' => 'btn btn-primary', 'id' => 'loginButton', 'type' => 'submit']) !!}
                                <button class="btn btn-link btn-sm" data-toggle="modal" data-dismiss="modal"  data-target="#resetModal">Lupa Password?</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="AnnouncementModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">Pengumuman</h4>
                </div>
                <div class="modal-body">
                    @forelse($announcements as $announcement)
                        <div class="announcement">
                            <div><strong>{{ $announcement->title }}</strong></div>
                            <div>{!! $announcement->content !!}</div>
                        </div>
                    @empty
                        <h3>Tidak ada pengumuman.</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection