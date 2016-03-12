<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Kelas</h3>
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
                        <a href="{{ route('subjects.edit', $c) }}" class="product-title">
                            {{ $c->name }}
                        </a>
                        <span class="product-description">
                            {!! $c->grade !!}
                        </span>
                    </div>
                </li>
            @empty
                <li class="item">                            
                    <div class="product-info">
                        Tidak ada ditemukan kelas baru.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="box-footer text-center">
        <a href="{{ route('subjects.index') }}" class="uppercase">Lihat Semua Kelas</a>
    </div>
</div>