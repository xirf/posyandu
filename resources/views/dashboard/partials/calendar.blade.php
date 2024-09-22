<div class="flex items-center justify-center" x-data="{
    openAddModal() {
            $dispatch('open-modal', 'add-schedule')
        },
        closeModal() {
            $dispatch('close-modal', 'add-schedule')
        }
}">
    <div class="max-w-sm w-full shadow">
        <div class="md:p-8 p-5 dark:bg-gray-800 bg-white rounded-t-xl">
            <div class="px-2 flex items-center justify-between">
                <span id="currentMonth" tabindex="0" class="focus:outline-none text-xl font-bold  text-gray-800"></span>
                <div class="flex items-center">
                    <x-heroicon-o-plus class="w-5 h-5 text-gray-800 cursor-pointer" @click="openAddModal()" />
                </div>
            </div>
            <div class="flex items-center justify-between pt-4 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            @php
                                $days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                            @endphp

                            @foreach ($days as $day)
                                <th>
                                    <div class="w-full flex justify-center">
                                        <p
                                            class="w-10 h-10 flex items-center justify-center font-bold border-b {{ $day == 'Min' ? 'text-red-500' : 'text-gray-800' }}">
                                            {{ $day }}
                                        </p>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="calendarDays">
                        <!-- Calendar days will be generated here -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="md:py-8 py-5 md:px-8 px-5 grid gap-4 bg-gray-50 rounded-b border-t" id="scheduleTarget">

        </div>
    </div>

    <x-modal name="add-schedule" :show="$errors->addSchedule->isNotEmpty()" focusable>
        <form method="post" action="{{ route('dashboard.schedule.add') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add New Schedules') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Please inser when and where next posyandu') }}
            </p>

            <div class="mt-6">
                <x-input-label for="date" value="{{ __('Date') }}" />
                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                    placeholder="{{ __('Select Date') }}" />
                <x-input-error :messages="$errors->addSchedule->get('date')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="time" value="{{ __('Time') }}" />
                <x-text-input id="time" name="time" type="time" class="mt-1 block w-full"
                    placeholder="{{ __('Select Time') }}" />
                <x-input-error :messages="$errors->addSchedule->get('time')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="location" value="{{ __('Location') }}" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                    placeholder="{{ __('Insert Location') }}" />
                <x-input-error :messages="$errors->addSchedule->get('location')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>


    <x-modal name="confirm-deletion" :show="$errors->deleteSchedule->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete this schedule?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('This action is not reversible') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>

<template id="scheduleTemplate">
    <div class="flex gap-4 items-center">
        <div>
            <div class="p-2 bg-red-500/25 rounded-md text-red-500 cursor-pointer" id="deleteButton">
                <x-heroicon-o-trash class="w-4 h-4" />
            </div>
        </div>
        <div class="border-b pb-4 border-gray-400 border-dashed">
            <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300" id="datetime"></p>
            <p tabindex="0" id="location"
                class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2"></p>
        </div>
    </div>
</template>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentMonthElement = document.getElementById('currentMonth');
        const calendarDaysElement = document.getElementById('calendarDays');
        const scheduleTemplate = document.getElementById('scheduleTemplate');
        const scheduleTarget = document.getElementById('scheduleTarget');

        const options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
        };

        let currentDate = new Date();

        function renderCalendar(date, schedules) {
            try {
                const month = date.getMonth();
                const year = date.getFullYear();

                currentMonthElement.textContent = date.toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });

                const firstDay = (new Date(year, month, 1).getDay() + 7) % 7;
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                calendarDaysElement.innerHTML = '';
                scheduleTarget.innerHTML = '';

                const scheduleMap = new Map();
                schedules.forEach(schedule => {
                    const scheduleDate = new Date(schedule.date).toISOString().split('T')[0];
                    scheduleMap.set(scheduleDate, schedule);
                });

                const today = new Date().getDate();
                const todayString = new Date(year, month, today + 1).toISOString().split('T')[0];

                const fragment = document.createDocumentFragment();
                let day = 1;

                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');
                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
                        const cellDiv = document.createElement('div');
                        cellDiv.className =
                            'w-full flex justify-center w-10 h-10 flex items-center justify-center';

                        if (i === 0 && j < firstDay) {
                            cellDiv.innerHTML =
                                '<p class="text-base text-center text-gray-400 dark:text-gray-600"></p>';
                        } else if (day > daysInMonth) {
                            break;
                        } else {
                            const currentDate = new Date(year, month, day + 1).toISOString().split('T')[0];
                            const schedule = scheduleMap.get(currentDate);

                            if (schedule) {
                                const tmplt = scheduleTemplate.content.cloneNode(true);
                                tmplt.querySelector('#datetime').innerText = new Date(schedule.date)
                                    .toLocaleString('id-ID', options) + ' - ' + schedule.time.slice(0, 5);
                                tmplt.querySelector('#location').innerText = schedule.location;
                                tmplt.querySelector('#deleteButton').setAttribute("onClick",
                                    `deleteSchedule(${schedule.id})`)
                                scheduleTarget.appendChild(tmplt);
                            }

                            let dayContent = `<p class="text-base text-center text-gray-800">${day}</p>`;
                            if (schedule) {
                                dayContent =
                                    `<p class="text-base text-center border-b-2 border-cyan-500">${day}</p>`;
                            } else if (day === today) {
                                cellDiv.className += " bg-cyan-500/25 rounded-xl"
                                dayContent = `<p class="text-base text-center text-cyan-700">${day}</p>`;
                            } else if (j === 0) {
                                dayContent = `<p class="text-base text-center text-red-500">${day}</p>`;
                            }
                            cellDiv.innerHTML = dayContent;
                            day++;
                        }

                        cell.appendChild(cellDiv);
                        row.appendChild(cell);
                    }
                    fragment.appendChild(row);
                }

                calendarDaysElement.appendChild(fragment);

            } catch (error) {
                console.error(error);
            }
        }

        // Initial render
        axios.get('{{ route('api.schedule') }}')
            .then(res => {
                requestAnimationFrame(() => {
                    renderCalendar(currentDate, res.data);
                });
            })
            .catch(e => {
                notyf.error("Tidak dapat mengambil jadwal");
            });

        function deleteSchedule(id) {
            element.dispatchEvent(new CustomEvent('open-modal', 'delete-schedule'))
        }
    })
</script>
