<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Posyandu Record') }}
            </h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('dashboard.report.new') }}">
                    <x-secondary-button>{{ __('Back') }}</x-secondary-button>
                </a>
                <x-primary-button id="submitBtn">{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </x-slot>
    <div class="p-4 my-8 max-w-7xl m-auto bg-white rounded-lg shadow">
        <form class="grid grid-cols-3 grow" id="addNewDataForm">
            @include('report.partials.patient')
            @include('report.partials.measurement')
            @include('report.partials.medical-notes')
        </form>
    </div>

    @pushOnce('script')
        <script>
            const form = document.getElementById("addNewDataForm");
            const submitBtn = document.getElementById("submitBtn");
            const endpoint = '';
            let isLoading = false;

            submitBtn.addEventListener('click', ()=>{
                saveMedicalRecord()
            })

            function saveMedicalRecord() {
                const formData = new FormData(form);
                console.log(formData);
                // fetch(endpoint, {
                //         method: 'POST',
                //         body: formData
                //     })
                //     .then(response => response.json())
                //     .then(data => {
                //         console.log(data);
                //         if (data.success) {
                //             alert('Data saved successfully');
                //             form.reset();
                //         } else {
                //             alert('Failed to save data');
                //         }
                //     })
                //     .catch(error => {
                //         console.error('Error:', error);
                //         alert('Failed to save data');
                //     }).finally(() => {
                //         isLoading = false;
                //         submitBtn.disabled = false;
                //         form.reset()
                    });
            }
        </script>
    @endPushOnce

</x-app-layout>
