@extends('home')

@section('page_title')
    Pengumuman
@endsection

@section('page_description')
    Menambahkan pengumuman baru
@endsection

@section('header_scripts')
<link rel="stylesheet" href="{{ asset( '/css/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambahkan Pengumuman</h3>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/announcements') }}">
                <div class="box-body">
                    {!! csrf_field() !!}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Judul Pengumuman</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus="autofocus">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Urgensi</label>

                        <div class="col-md-6">
                            <select class="form-control" name="status">
                                <option value="info">Hanya Info</option>
                                <option value="warning">Sangat Penting</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Konten Pengumuman</label>

                        <div class="col-md-9">
                            <textarea name="content" placeholder="Deskripsi pengumuman..." class="form-control textarea"></textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-md-offset-3">
                            <button class="btn btn-flat btn-success" type="submit">                                
                                <span class="login-loader hide"><i class="fa fa-spin fa-circle-o-notch"></i></span>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Pengumuman Terkini</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    @foreach ($announcements as $announcement)
                    <li class="item">
                        <div class="product-img">
                            <img src="http://placehold.it/50x50" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <a href="javascript::;" class="product-title">
                                {{ $announcement->title }}
                                <span class="label label-{{ $announcement->status == 'info' ? 'info' : 'warning' }} pull-right">{{ $announcement->status }}</span>
                            </a>
                            <span class="product-description">
                                {!! $announcement->content !!}
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="box-footer text-center">
                <a href="{{ url('/announcements') }}" class="uppercase">Lihat Semua Pengumuman</a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_scripts')
<script src="{{ asset('/js/libs/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
    jQuery(function () {
        jQuery(".textarea").wysihtml5();
    });
</script>
@endsection