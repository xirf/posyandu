@php
    $formId = 'editsiteinfo';
@endphp

<div class="w-full flex flex-col gap-4">
    <div>
        <h1 class="text-xl font-bold">{{ __('About') }}</h1>
        <p>{{ __('Explain about your site here.') }}</p>
    </div>
    @if ($siteInfo && $siteInfo->description)
        <div class="hidden" id="quill-initial-data">
            {!! $siteInfo->description !!}
        </div>
    @endif
    <form action="{{ route('site-info.update') }}" method="post" id="{{ $formId }}">
        @csrf


        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full shrink-0"
                    :value="old('name', $siteInfo->name ?? '')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>

                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full shrink-0"
                    :value="old('address', $siteInfo->address ?? '')" required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full shrink-0"
                    :value="old('phone', $siteInfo->phone ?? '')" required autofocus autocomplete="phone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full shrink-0"
                    :value="old('email', $siteInfo->email ?? '')" required autofocus autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description (About Us)')" class="mb-1" />

            <div class="max-h-96 overflow-auto">
                <x-quill :formId="$formId" :name="'description'" :endpoint="`{{ route('upload') }}`" />
            </div>
        </div>
        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>
    </form>
</div>
