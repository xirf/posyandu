<div class="p-4 bg-white shadow sm:rounded-lg space-y-4">
    <h2 class="block mb-1  text-lg font-semibold text-gray-700">{{ __('Content') }}</h2>
    <x-quill name="body" value="" placeholder="Content here..." :endpoint="'/uploads'" />

</div>
