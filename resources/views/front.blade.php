<!DOCTYPE html>
<!--                                     ____
                                         |  |
       _____  _  ___  ________  ______   |  |__     __   __
     /  ___/ | ' __/ |  ___  | /  _____\ |   _  \  |  | |  |
    |  |__   |  |    | |___| | \_____  \ |  |_)  | |  |_|  |
     \_____\ |__|    |_______| /_______/ |_'____/  _\___,  |
      https://github.com/alfredcrosby/ilearn      |_______/
 -->
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-learning SMK Wira Harapan</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="{{ asset('assets/css/client/login.min.css') }}" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body class="login-page">
  <div class="site">
    <div class="login-navigation">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="logo">
              <a href="{{ route('login') }}"><img src="{{ asset( '/uploads/smkwiratransparentlogo.png' ) }}"></a>
            </div>
            <nav class="login-menu">
              <ul>
                <li class="visible-xs-inline-block"><button class="btn btn-primary" data-toggle="modal" data-target="#announcementModal" title="Pengumuman"><i class="fa fa-bell"></i></button></li>
                <li class="hidden-xs"><button class="btn btn-primary" data-toggle="modal" data-target="#announcementModal" title="Pengumuman">Pengumuman</button></li>
                <li><button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="welcome-text">
      <h1 class="heading text-uppercase">E-learning <br /> SMK Wira Harapan</h1>
      <p>
        Sistem pembelajaran online milik SMK Wira Harapan. <br />
        Jika anda mendapatkan masalah ketika login silakan hubungi bagian tata usaha.
      </p>
    </div>

    <div class="copyright">&copy; SMK Wira Harapan 2016.</div>
  </div>

  @yield('content')
  
  <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reset Password</h4>
        </div>
        <div class="modal-body clearfix">
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
          {!! Form::open(['url' => route('email.store'), 'role' => 'form', 'class' => 'form-horizontal']) !!}                        
            <div class="col-sm-12">
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email...']) !!}
                  {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group">
                  {!! Form::button('<i class="fa fa-btn fa-send"></i> Kirim Link Reset', ['class' => 'btn btn-primary']) !!}
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script type="text/javascript">
    (function($){
      $('#loginModal').modal({ show: true });
    })(jQuery);
  </script>
</body>
</html>
