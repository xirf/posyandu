<x-app-layout>

    @if (session('status') === 'user-deleted')
        @push('scripts')
            <script>
                window.onload = () => {
                    notyf.success('{{ __('User deleted successfully.') }}');
                }
            </script>
        @endpush
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Site Info') }}
        </h2>
        <p>
            {{ __('Manage site details and users.') }}
        </p>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('site-info.partials.users')
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('site-info.partials.site-info')
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
