@php
    $services = [
        [
            'Pantau Tumbuh Kembang',
            'Memantau pertumbuhan dan perkembangan balita secara berkala melalui pengukuran tinggi, berat badan, dan perkembangan motorik.',
            '/images/lup.svg'
        ],
        [
            'Imunisasi',
            'Pemberian vaksin dasar untuk mencegah penyakit seperti polio, campak, dan difteri sesuai jadwal imunisasi nasional.',
            '/images/drug.svg'
        ],
        [
            'Konsultasi',
            'Layanan konsultasi kesehatan untuk ibu hamil, balita, dan lansia mengenai gizi, kesehatan, dan pola asuh anak.',
            '/images/posyandu.svg'
        ],
        [
            'Skrinning Kesehatan',
            'Pemeriksaan awal untuk mendeteksi potensi gangguan kesehatan seperti anemia, kurang gizi, atau penyakit menular.',
            '/images/medical-report.svg'
        ],
        [
            'Penyuluhan',
            'Kegiatan edukasi mengenai kesehatan ibu dan anak, kebersihan lingkungan, gizi seimbang, serta pencegahan penyakit.',
            '/images/kit.svg'
        ],
        [
            'PMT',
            'Program Pemberian Makanan Tambahan untuk meningkatkan status gizi anak balita dan ibu hamil yang kekurangan gizi.',
            '/images/pmt.svg'
        ],
    ];
@endphp

<div class="relative h-fit p-8">
    <div class="max-w-7xl w-full text-center mx-auto flex flex-col items-center gap-8">
        <h1 class="text-4xl font-black">Daftar Layanan</h1>
        <div class="w-20 h-1 bg-black rounded-full"></div>
        <p class="text-gray-400 max-w-5xl leading-relaxed text-lg">Kami menyediakan berbagai layanan yang akan memastikan
            kesehatan optimal bagi seluruh keluarga, Dengan pendekatan yang holistik, kami berkomitmen untuk menjaga
            kesejahteraan masyarakat</p>
    </div>
    <div class="w-full relative mt-20">
        <div class="max-w-7xl w-full mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
            <div class="absolute -top-20 -left-52 h-full w-auto">
                <img src="/images/blob2.svg" alt="" class="h-full w-auto scale-[1.7]">
            </div>
            <div class="absolute -bottom-32 -right-24 h-full w-auto">
                <img src="/images/grids.svg" alt="" class="h-full w-auto">
            </div>
            @foreach ($services as $item)
                <div class="bg-white shadow-cyan-200 rounded-lg p-8 grid gap-4 border border-gray-100 relative z-10" 
                style="box-shadow: 10px 40px 50px 0 #e5f6f56b"
                >
                    <div class="w-20 h-24 flex items-center justify-center">
                        <img src="{{$item[2]}}" alt="">
                    </div>
                    <h2 class="text-2xl font-bold leading-relaxed">{{$item[0]}}</h2>
                    <p class="leading-normal text-gray-400">{{$item[1]}}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
