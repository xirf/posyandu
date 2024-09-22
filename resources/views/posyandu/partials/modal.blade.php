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
                    <tr>
                        <td data-tip="{{ __('Patient') }}">{{ __('Patient') }}</td>
                        <td>
                            <div class="flex gap-2 flex-wrap">
                                <div :class="{ 'text-blue-500': selectedPatient.patient.gender === 'male', 'text-pink-500': selectedPatient.patient.gender === 'female', }" class="font-bold w-32 truncate text-sm" x-text="selectedPatient.patient.name"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('Birth Place and Date')}}</td>
                        <td><div x-text="`${selectedPatient.patient.place_of_birth} ${selectedPatient.patient.birthdate}`"></div></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Address') }}">{{ __('Address') }}</td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                <div x-text="selectedPatient.patient.dukuh"></div>
                                <div x-text="`RT ${selectedPatient.patient.rt}`"></div>
                                <div x-text="`RW ${selectedPatient.patient.rw}`"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Age Group') }}">{{ __('Age Group') }}</td>
                        <td x-text="ages[selectedPatient.patient.age_group]"></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Height') }}">{{ __('TB') }}</td>
                        <td x-text="selectedPatient.vital_statistics.height"></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Weight') }}">{{ __('BB') }}</td>
                        <td x-text="selectedPatient.vital_statistics.weight"></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Head Circumference') }}">{{ __('LK') }}</td>
                        <td x-text="selectedPatient.vital_statistics.head_circumference"></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Upper Arm Circumference') }}">{{ __('LILA') }}</td>
                        <td x-text="selectedPatient.vital_statistics.arm_circumference"></td>
                    </tr>
                    <tr>
                        <td data-tip="{{ __('Abdominal Circumference') }}">{{ __('LP') }}</td>
                        <td x-text="selectedPatient.vital_statistics.abdominal_circumference"></td>
                    </tr>
                    <tr x-show="openedIndex > 2 || openedIndex == 0">
                        <td data-tip="{{ __('Cholesterol') }}">{{ __('Cholesterol') }}</td>
                        <td x-text="selectedPatient.lab_results?.cholesterol"></td>
                    </tr>
                    <tr x-show="openedIndex > 2 || openedIndex == 0">
                        <td data-tip="{{ __('Hemoglobin') }}">{{ __('HB') }}</td>
                        <td x-text="selectedPatient.lab_results?.hemoglobin"></td>
                    </tr>
                    <tr x-show="openedIndex > 2 || openedIndex == 0">
                        <td data-tip="{{ __('Glucose Level') }}">{{ __('GDA') }}</td>
                        <td x-text="selectedPatient.lab_results?.gda"></td>
                    </tr>
                    <tr x-show="openedIndex > 2 || openedIndex == 0">
                        <td data-tip="{{ __('Urine Test') }}">{{ __('UA') }}</td>
                        <td x-text="selectedPatient.lab_results?.ua"></td>
                    </tr>
                    <tr x-show="openedIndex > 3 || openedIndex == 0">
                        <td data-tip="{{ __('Family Planning') }}">{{ __('KB') }}</td>
                        <td>
                            <div x-text="selectedPatient.family_planning == 0 ? '{{ __('No') }}' : '{{ __('Yes') }}'" :class="{ 'badge-success': selectedPatient.family_planning == 1, 'badge-neutral': selectedPatient.family_planning == 0 }" class="badge badge-outline"></div>
                        </td>
                    </tr>
                    <tr x-show="openedIndex > 3 || openedIndex == 0">
                        <td data-tip="{{ __('Complaints') }}">{{ __('Complaints') }}</td>
                        <td>
                            <div x-text="selectedPatient.complaints" class="line-clamp-4"></div>
                        </td>
                    </tr>
                    <tr x-show="openedIndex > 3 || openedIndex == 0">
                        <td data-tip="{{ __('Diagnosic') }}">{{ __('Diagnosic') }}</td>
                        <td>
                            <div x-text="selectedPatient.diagnosis" class="line-clamp-4"></div>
                        </td>
                    </tr>
                    <tr x-show="openedIndex > 3 || openedIndex == 0">
                        <td data-tip="{{ __('Disease') }}">{{ __('Disease') }}</td>
                        <td>
                            <div x-text="selectedPatient.diseases" class="line-clamp-4"></div>
                        </td>
                    </tr>
                    <tr x-show="openedIndex > 3 || openedIndex == 0">
                        <td data-tip="{{ __('Medication') }}">{{ __('Medication') }}</td>
                        <td>
                            <div x-text="selectedPatient.medication" class="line-clamp-4"></div>
                        </td>
                    </tr>
                </table>

                <div class="flex justify-end mt-6 gap-4">
                    <x-primary-button x-on:click="modelOpen=false"
                        type="button">{{ __('Cancel') }}</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>
