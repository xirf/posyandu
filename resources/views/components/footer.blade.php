<div class="relative bg-primary text-white w-full mt-20">
    <div class="grid p-8 md:grid-cols-2 lg:grid-cols-3 max-w-7xl w-full mx-auto py-12 relative gap-y-10">
        <div class="flex flex-col gap-4">
            <h1 class="text-3xl font-black"> {{ $siteInfo->name ?? config('app.name', 'Posyandu Bareng') }} </h1>
            <p>
                {{ $siteInfo->address ?? ' Desa Bareng, Kecamatan Pudak, Kabupaten Ponorogo, Jawa Timur, 63418 ' }}
            </p>
            <p class="text-xs">Didukung oleh: KKN Tematika UMPO 2024</p>
        </div>

        <div class="hidden lg:block">

        </div>

        <div class="grid gap-4 h-fit">
            <h1 class="text-3xl font-black"> Hubungi Kami </h1>

            <div class="flex flex-col gap-1">
                @if ($siteInfo->phone)
                    <a href="tel:{{ preg_replace('/\D/', '', $siteInfo->phone) }}">
                        <p> {{ $siteInfo->phone }} </p>
                    </a>
                @endif

                @if ($siteInfo->email)
                    <a href="mailto:{{ $siteInfo->email }}">
                        <p> {{ $siteInfo->email }} </p>
                    </a>
                @endif
            </div>
            <br />
            <h1 class="text-3xl font-black">Tenaga Kesehatan</h1>
            <a href="{{ route('login') }}">
                <x-secondary-button>
                    {{ __('Login') }}
                </x-secondary-button>
            </a>
        </div>
        <img src="/images/grids.svg" alt="" class="absolute -top-16 -right-24 h-32 w-32">
    </div>
</div>
