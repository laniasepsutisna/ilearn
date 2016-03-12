<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Mata Pelajaran</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @forelse ($subjects as $s)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('subjects.edit', $s) }}" class="product-title">
                            {{ $s->name }}
                        </a>
                        <span class="product-description">
                            {!! $s->description !!}
                        </span>
                    </div>
                </li>
            @empty
                <li class="item">                            
                    <div class="product-info">
                        Tidak ada ditemukan mata pelajaran baru.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="box-footer text-center">
        <a href="{{ route('subjects.index') }}" class="uppercase">Lihat Semua Mata Pelajaran</a>
    </div>
</div>