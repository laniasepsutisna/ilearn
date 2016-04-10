<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Kelas Terbaru</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @forelse ($classrooms as $c)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('lms-admin.classrooms.edit', $c) }}" class="product-title">
                            {{ $c->classname }}
                        </a>
                        <span class="product-description">
                            Jumlah Anggota : {{ $c->students()->count() }} orang.
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
        <a href="{{ route('lms-admin.classrooms.index') }}" class="uppercase">Lihat Semua Kelas</a>
    </div>
</div>