<div class="w-full h-full flex items-center justify-between">

</div>

<div class="w-full bg-white shadow-md rounded-lg p-6 ">
    <div class="overflow-x-auto h-[80vh]">
        <table class="table table-zebra table-xs table-pin-rows table-pin-cols" id="table">
            <thead>
                <tr>
                    <th></th>
                    <td>Identitas</td>
                    <td>Usia</td>
                    <td>BB</td>
                    <td>TB</td>
                    <td>LL</td>
                    <td>LK</td>
                    <td>LP</td>
                    <th>R. Penyakit</th>
                    <th>Keluhan</th>
                    <th>Terapi</th>
                </tr>
            </thead>
            <tbody id="target-body">

            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <td>Name</td>
                    <td>Job</td>
                    <td>company</td>
                    <td>location</td>
                    <td>Last Login</td>
                    <td>Favorite Color</td>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div class="paginate">

        </div>
    </div>
</div>

<template id="table-row">
    <tr>
        <td id="no"></td>
        <td>
            <div class="flex gap-1 flex-col w-64">
                <p class="font-bold text-base line-clamp-1" id="name">Hart Hagerty</p>
                <div class="grid">
                    <div class="text-xs opacity-50">
                        <span id="gender" class="rounded-full px-2 text-white">L</span> 
                        <span id="place-of-birth">Magetan</span> &middot; <span id="date-of-birth">12 Mei 2002</span>
                    </div>
                    <div class="text-xs opacity-50">
                        <span id="address">Plangkrongan, Poncol, Magetan</span>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div class="w-20" id="age-category">dewasa </div>
        </td>
        <td>
            <div class="w-20" id="weight">20 Cm </div>
        </td>
        <td>
            <div class="w-20" id="height">15 Cm </div>
        </td>
        <td>
            <div class="w-20" id="arm-circ">30 Cm </div>
        </td>
        <td>
            <div class="w-20" id="head-circ">32 Cm </div>
        </td>
        <td>
            <div class="w-20" id="abd-circ">32 Cm </div>
        </td>
        <td id="history">Kb, Hipertesi, Diabetes</td>
        <td>
            <p class="line-clamp-3" id="complaint">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed, minus
                non
                molestiae fugiat nesciunt fugit aliquam sit. Dignissimos sequi, iusto sint commodi
                voluptatibus minima distinctio, blanditiis libero nostrum deserunt quas!</p>
        </td>
        <td>
            <p class="line-clamp-3" id="therapy">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed, minus
                non
                molestiae fugiat nesciunt fugit aliquam sit. Dignissimos sequi, iusto sint commodi
                voluptatibus minima distinctio, blanditiis libero nostrum deserunt quas!</p>
        </td>
    </tr>
</template>

@pushOnce('script')
    <script>
        const i18n = {
            'no-data': '{{ __('No data available') }}',
            'loading': '{{ __('Loading...') }}',
            'no-results': '{{ __('No results found') }}',
            'page': '{{ __('Page') }}',
            'of': '{{ __('of') }}',
            'rows': '{{ __('rows') }}',
            'next': '{{ __('Next') }}',
            'prev': '{{ __('Previous') }}',
            'infant': '{{ __('Infant') }}',
            'child': '{{ __('Child') }}',
            'teenager': '{{ __('Teenager') }}',
            'adult': '{{ __('Adult') }}',
            'elderly': '{{ __('Elderly') }}',
            'male': '{{ __('Male') }}',
            'female': '{{ __('Female') }}',
        }

        const table = document.getElementById('table');
        const targetBody = document.getElementById('target-body');

        console.log("asd")

        window.onload = function() {
            axios.get('{{ route('api.medical.records') }}', {
                    headers: {
                        'content-type': 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    setTableData(response.data.data); // Assuming the data is paginated and in the 'data' key
                })
                .catch(console.error)
        }

        function setTableData(data) {
            data.forEach((item, index) => {
                const row = document.getElementById('table-row').content.cloneNode(true);
                const no = row.querySelector('#no');
                const name = row.querySelector('#name');
                const birthDate = row.querySelector('#date-of-birth');
                const height = row.querySelector('#height');
                const weight = row.querySelector('#weight');
                const armCircumference = row.querySelector('#arm-circ');
                const headCircumference = row.querySelector('#head-circ');
                const abdCircumference = row.querySelector('#abd-circ');
                // const familyPlanning = row.querySelector('#family-planning');
                // const hypertension = row.querySelector('#hypertension');
                // const diabetes = row.querySelector('#diabetes');
                const complaint = row.querySelector('#complaint');
                const therapy = row.querySelector('#therapy');
                const ageCategory = row.querySelector('#age-category');
                const gender = row.querySelector('#gender');

                gender.classList.add(item.patient.gender != 'male' ? 'bg-pink-500' : 'bg-blue-600');
                gender.textContent = i18n[item.patient.gender];
                no.textContent = index + 1;
                name.textContent = item.patient.name;
                birthDate.textContent = item.patient.birth_date;
                height.textContent = item.height;
                weight.textContent = item.weight;
                armCircumference.textContent = item.arm_circumference;
                headCircumference.textContent = item.head_circumference;
                abdCircumference.textContent = item.abd_circumference;
                // familyPlanning.textContent = item.family_planning ? 'Yes' : 'No';
                // hypertension.textContent = item.hypertension ? 'Yes' : 'No';
                // diabetes.textContent = item.diabetes ? 'Yes' : 'No';
                complaint.textContent = item.complaint;
                therapy.textContent = item.therapy;
                ageCategory.textContent = i18n[item.age_category];

                targetBody.appendChild(row);
            });
        }
    </script>
@endPushOnce
