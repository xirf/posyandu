<div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
        <div x-cloak @click="modelOpen = false" x-show="modelOpen"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

        <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-800 ">{{ __('Detail') }}</h1>
            </div>

            <p class="mt-2 text-sm text-gray-500 ">
                {{ __('This is information about related patient.') }}
            </p>

            <div class="mt-5 w-full">
                <table class="table">
                    <tr class="hover"> <td>{{ __('Patient') }}</td> <td> <div class="flex gap-2 flex-wrap"> <div :class="{ 'text-blue-500': selectedPatient?.patient .gender === 'male', 'text-pink-500': selectedPatient?.patient .gender === 'female', }" class="font-bold w-32 truncate text-sm" x-text="selectedPatient?.patient.name"> </div> </div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Birth Place and Date') }}</td> <td> <div x-text="`${selectedPatient?.patient.place_of_birth} ${selectedPatient?.patient.birthdate}`"> </div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Address') }}</td> <td> <div class="flex flex-wrap gap-2"> <div x-text="selectedPatient?.patient.dukuh"></div> <div x-text="`RT ${selectedPatient?.patient.rt}`"></div> <div x-text="`RW ${selectedPatient?.patient.rw}`"></div> </div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Age Group') }}</td> <td x-text="ages[selectedPatient?.patient.age_group]"></td> </tr>
                    <tr class="hover"> <td>{{ __('Height') }}</td> <td x-text="selectedPatient?.vital_statistics.height"></td> </tr>
                    <tr class="hover"> <td>{{ __('Weight') }}</td> <td x-text="selectedPatient?.vital_statistics.weight"></td> </tr>
                    <tr class="hover"> <td>{{ __('Head Circumference') }}</td> <td x-text="selectedPatient?.vital_statistics.head_circumference"></td> </tr>
                    <tr class="hover"> <td>{{ __('Upper Arm Circumference') }}</td> <td x-text="selectedPatient?.vital_statistics.arm_circumference"></td> </tr>
                    <tr class="hover"> <td>{{ __('Abdominal Circumference') }}</td> <td x-text="selectedPatient?.vital_statistics.abdominal_circumference"></td> </tr>
                    <tr class="hover"> <td>{{ __('Cholesterol') }}</td> <td x-text="selectedPatient?.lab_results?.cholesterol"></td> </tr>
                    <tr class="hover"> <td>{{ __('Hemoglobin') }}</td> <td x-text="selectedPatient?.lab_results?.hemoglobin"></td> </tr>
                    <tr class="hover"> <td>{{ __('Glucose Level') }}</td> <td x-text="selectedPatient?.lab_results?.gda"></td> </tr>
                    <tr class="hover"> <td>{{ __('Urine Test') }}</td> <td x-text="selectedPatient?.lab_results?.ua"></td> </tr>
                    <tr class="hover"> <td>{{ __('Family Planning') }}</td> <td> <div x-text="selectedPatient?.family_planning == 0 ? '{{ __('No') }}' : '{{ __('Yes') }}'" :class="{ 'badge-success': selectedPatient?.family_planning == 1, 'badge-neutral': selectedPatient?.family_planning == 0 }" class="badge badge-outline"></div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Complaints') }}</td> <td> <div x-text="selectedPatient?.complaints" class="line-clamp-4"></div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Diagnosic') }}</td> <td> <div x-text="selectedPatient?.diagnosis" class="line-clamp-4"></div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Disease') }}</td> <td> <div x-text="selectedPatient?.diseases" class="line-clamp-4"></div> </td> </tr>
                    <tr class="hover"> <td>{{ __('Medication') }}</td> <td> <div x-text="selectedPatient?.medication" class="line-clamp-4"></div> </td> </tr>
                </table>

                <div class="flex justify-between mt-6 gap-4 items-end">
                <div>
                    <x-danger-button x-on:click="$dispatch('open-modal', 'confirm-deletion'); "
                     type="button">{{ __('Delete') }}</x-danger-button>
                </div>
                    <div class="flex justify-end mt-6 gap-4">
                        <x-primary-button x-on:click="modelOpen=false" type="button">{{ __('Edit') }}</x-primary-button>
                        <x-secondary-button x-on:click="modelOpen=false" type="button">{{ __('Close') }}</x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-deletion" :show="$errors->deleteSchedule->isNotEmpty()" focusable>
        <form method="post" x-bind:action="`{{ route('dashboard.posyandu.delete', '') }}/${selectedPatient?.id}`" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this record?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('This action is not reversible') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" type="button">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" type="submit">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
