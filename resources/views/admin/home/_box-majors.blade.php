<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Jurusan</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @forelse ($majors as $m)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('lms-admin.majors.edit', $m) }}" class="product-title">
                            {{ $m->name }}
                        </a>
                        <span class="product-description">
                            {!! $m->description !!}
                        </span>
                    </div>
                </li>
            @empty
                <li class="item">                            
                    <div class="product-info">
                        Tidak ada ditemukan jurusan baru.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="box-footer text-center">
        <a href="{{ route('lms-admin.majors.index') }}" class="uppercase">Lihat Semua Jurusan</a>
    </div>
</div>