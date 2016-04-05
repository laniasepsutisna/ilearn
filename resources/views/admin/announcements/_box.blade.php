<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pengumuman Terbaru</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @forelse ($announcements as $a)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('lms-admin.announcements.edit', $a) }}" class="product-title">
                            {{ $a->title }}
                            <span class="label label-{{ $a->status == 'info' ? 'info' : 'danger' }} pull-right">{{ $a->urgensi }}</span>
                        </a>
                        <span class="product-description">
                            {!! $a->content !!}
                        </span>
                    </div>
                </li>
            @empty
                <li class="item">                            
                    <div class="product-info">
                        Tidak ada ditemukan pengumuman baru.
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="box-footer text-center">
        <a href="{{ route('lms-admin.announcements.index') }}" class="uppercase">Lihat Semua Pengumuman</a>
    </div>
</div>