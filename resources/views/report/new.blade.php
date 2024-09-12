<x-app-layout noNav="true">
    <div class="gap-8 p-8 h-screen flex flex-col">
        <div class="grid grid-cols-3 gap-8 grow">
            <div class="w-full rounded-lg bg-white shadow border">
                @include('report.partials.patient')
            </div>
            <div class="w-full rounded-lg bg-white shadow border"></div>
            <div class="w-full rounded-lg bg-white shadow border"></div>
        </div>
        <div class="col-span-3 bg-white rounded-lg shadow border h-20"> </div>
    </div>
</x-app-layout>
