<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">User Terbaru</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @forelse ($users as $u)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('lms-admin.users.edit', $u) }}" class="product-title">
                            {{ $u->fullname }}
                        </a>
                        <span class="product-description">
                            {!! $u->email !!}
                        </span>
                    </div>
                </li>
            @empty
                <li class="item">                            
                    <div class="product-info">
                        Tidak ada ditemukan user baru.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="box-footer text-center">
        <a href="{{ route('lms-admin.users.index', ['type' => Request::get('type')]) }}" class="uppercase">Lihat Semua Pengumuman</a>
    </div>
</div>