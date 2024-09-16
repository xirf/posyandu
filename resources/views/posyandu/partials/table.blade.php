@pushOnce('styles')
    <style>
        /* make cols sticky */
        thead>tr>th:first-child,
        tbody>tr>td:first-child {
            background-color: inherit;
            position: sticky;
            left: 0;
            z-index: 10;
        }

        thead {
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        tr:nth-child(even) {
            background-color: white;
        }

        tr:nth-child(odd) {
            background-color: #f1f1f1;
        }
    </style>
@endPushOnce

<table class="table">
    <thead class="bg-gray-50">
        <tr>
            <th @click="sortBy('patient.name')" class="w-30 cursor-pointer"><span>{{ __('Patient') }}</span></th>
            <th @click="sortBy('patient.dukuh')" class="w-30 cursor-pointer"><span>{{ __('Address') }}</span></th>
            <th @click="sortBy('vital_statistics.height')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Height') }}">{{ __('TB') }}</span> </th>
            <th @click="sortBy('vital_statistics.weight')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Weight') }}">{{ __('BB') }}</span> </th>
            <th @click="sortBy('vital_statistics.head_circumference')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Head Circumference') }}">{{ __('LK') }}</span> </th>
            <th @click="sortBy('vital_statistics.arm_circumference')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Upper Arm Circumference') }}">{{ __('LILA') }}</span></th>
            <th @click="sortBy('patient.name')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Abdominal Circumference') }}">{{ __('LP') }}</span></th>
            <th @click="sortBy('family_planning')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Family Planning') }}">{{ __('KB') }}</span></th>
            <th @click="sortBy('lab_results.cholesterol')" class="w-20 cursor-pointer"><span>{{ __('Cholesterol') }}</span></th>
            <th @click="sortBy('lab_results.hemoglobin')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Hemoglobin') }}">{{ __('HB') }}</span></th>
            <th @click="sortBy('lab_results.gda')" class="w-20 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Glucose Level') }}">{{ __('GDA') }}</span></th>
            <th @click="sortBy('lab_results.ua')" class="w-48 cursor-pointer"><span class="tooltip tooltip-bottom" data-tip="{{ __('Urine Test') }}">{{ __('UA') }}</span></th>
            <th @click="sortBy('complaints')" class="w-48 cursor-pointer"><span>{{ __('Complaints') }}</span></th>
            <th @click="sortBy('diagnosis')" class="w-48 cursor-pointer"><span>{{ __('Diagnosic') }}</span></th>
            <th @click="sortBy('diseases')" class="w-48 cursor-pointer"><span>{{ __('Disease') }}</span></th>
            <th @click="sortBy('medication')" class="w-48 cursor-pointer"><span>{{ __('Medication') }}</span></th>
    </thead>
    <tbody>
        <template x-for="data in activeData.data" :key="data.id">
            <tr class="hover:bg-cyan-50" x-show="!isLoading && !data.hiddenBySearch">
                <td>
                    <div class="grid">
                        <div :class="{
                            'text-blue-500': data.patient.gender === 'male',
                            'text-pink-500': data.patient.gender === 'female',
                        }"
                            class="font-bold w-32 truncate text-sm" x-text="data.patient.name"></div>
                    </div>
                    <div x-text="`${data.patient.place_of_birth} ${data.patient.birthdate}`"></div>
                    </div>
                </td>
                <td>
                    <div class="grid">
                        <div x-text="data.patient.dukuh"></div>
                        <div class="text-gray-400" x-text="`RT ${data.patient.rt}`"></div>
                        <div class="text-gray-400" x-text="`RW ${data.patient.rw}`"></div>
                    </div>
                </td>
                <td x-text="data.vital_statistics.height"></td>
                <td x-text="data.vital_statistics.weight"></td>
                <td x-text="data.vital_statistics.head_circumference"></td>
                <td x-text="data.vital_statistics.arm_circumference"></td>
                <td x-text="data.vital_statistics.abdominal_circumference"></td>
                <td x-text="data.family_planning"></td>
                <td x-text="data.lab_results.cholesterol"></td>
                <td x-text="data.lab_results.hemoglobin"></td>
                <td x-text="data.lab_results.gda"></td>
                <td x-text="data.lab_results.ua"></td>
                <td>
                    <div x-text="data.complaints" class="line-clamp-4"></div>
                </td>
                <td>
                    <div x-text="data.diagnosis" class="line-clamp-4"></div>
                </td>
                <td>
                    <div x-text="data.diseases" class="line-clamp-4"></div>
                </td>
                <td>
                    <div x-text="data.medication" class="line-clamp-4"></div>
                </td>
            </tr>
        </template>

        <tr x-show="isLoading">
            <td colspan="15" class="text-center">
                <div class="spinner spinner-primary"></div>
            </td>
        </tr>

        <tr x-show="!isLoading && activeData.length === 0">
            <td colspan="15" class="text-center">
                <x-empty :text="__('No data available')" :description="__('Try changing your filters to see the Patients')">
                    <x-slot name="button">
                        <x-primary-button @click="getTable()">
                            {{ __('Refresh') }}
                        </x-primary-button>
                    </x-slot>
                </x-empty>
            </td>
        </tr>
    </tbody>
</table>
