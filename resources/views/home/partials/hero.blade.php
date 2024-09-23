<div class="">
    <div class="flex flex-col-reverse p-8 lg:grid lg:grid-cols-2 gap-10 lg:gap-32 mx-auto max-w-7xl my-20">
        <div class="grid gap-4 relative z-[2]">
            <h1 class="text-2xl md:text-4xl font-black leading-normal lg:leading-relaxed">Melayani Kesehatan Keluarga,
                Menumbuhkan Generasi Sehat</h1>
            <p class="leading-relaxed max-w-lg text-[#7D7987]">Mendukung kesehatan masyarakat di setiap fase kehidupan,
                mulai dari bayi, balita, remaja, dewasa hingga lansia. Dengan layanan kesehatan yang komprehensif dan
                berkelanjutan,</p>

            @if ($schedule)
                @php
                    $formattedDate = Carbon\Carbon::parse($schedule->date)->translatedFormat('d F Y');
                    $formattedTime = Carbon\Carbon::parse($schedule->time)->format('H:i');
                @endphp
                <div>
                    <p>Posyandu berikutnya dalam:</p>
                    <div class="grid">
                        <div class="flex gap-2 md:items-end flex-col md:flex-row ">
                            <p class="font-black text-3xl">
                                <span class="text-primary" id="day">00</span> Hari <span class="text-primary"
                                    id="hour">00</span> Jam
                            </p>
                            <div class="flex gap-1 items-center text-[#7D7987]">
                                <x-heroicon-o-map-pin class="w-4 h-4" /> <span>{{ $schedule->location }}</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400">{{ $formattedDate }} &middot; {{ $formattedTime }} WIB</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="w-full h-auto relative z-0">
            <img src="/images/hero-image.png" alt="" class="z-10 relative">
            <img src="/images/blob.svg" class="absolute w-[772px] h-[623px] -bottom-10 left-0 z-0 scale-125">
        </div>
    </div>
</div>

@pushIf($schedule, 'scripts');
<script>
    let date = '{{ $schedule->date }}';
    let hour = '{{ $schedule->time }}';

    const dayEl = document.getElementById('day');
    const hourEl = document.getElementById('hour');

    const countDown = () => {
        const now = new Date().getTime();
        const eventDate = new Date(date).getTime();
        const diff = eventDate - now;

        console.log(now, eventDate, diff);

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        dayEl.textContent = days < 10 ? `0${days}` : days;
        hourEl.textContent = hours < 10 ? `0${hours}` : hours;
    }

    countDown();
</script>
@endPushIf
