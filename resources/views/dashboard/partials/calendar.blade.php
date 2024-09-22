<div class="flex items-center justify-center">
    <div class="max-w-sm w-full shadow">
        <div class="md:p-8 p-5 dark:bg-gray-800 bg-white rounded-t-xl">
            <div class="px-2 flex items-center justify-between">
                <span id="currentMonth" tabindex="0" class="focus:outline-none text-xl font-bold  text-gray-800"></span>
                <div class="flex items-center">
                    <x-heroicon-o-plus class="w-5 h-5 text-gray-800 cursor-pointer" />
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
                                        <p class="w-10 h-10 flex items-center justify-center font-bold border-b {{ $day == 'Min' ? 'text-red-500' : 'text-gray-800' }}">
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
        <div class="md:py-8 py-5 md:px-16 px-5 dark:bg-gray-700 bg-gray-50 rounded-b border-t">
            <div class="px-4">
                <div class="border-b pb-4 border-gray-400 border-dashed">
                    <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">9:00 AM</p>
                    <a tabindex="0"
                        class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">Zoom
                        call with design team</a>
                    <p class="text-sm pt-2 leading-4 text-gray-600 dark:text-gray-300">Discussion on UX
                        sprint and Wireframe review</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentMonthElement = document.getElementById('currentMonth');
        const calendarDaysElement = document.getElementById('calendarDays');

        let currentDate = new Date();

        function renderCalendar(date) {
            const month = date.getMonth();
            const year = date.getFullYear();

            // Set the current month and year
            currentMonthElement.textContent = date.toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });

            // Get the first day of the month (adjusted to start from Sunday)
            const firstDay = (new Date(year, month, 1).getDay() + 7) % 7;
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Clear previous calendar days
            calendarDaysElement.innerHTML = '';

            // Generate calendar days
            let day = 1;
            for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');
                    const cellDiv = document.createElement('div');
                    cellDiv.className = 'w-full flex justify-center w-10 h-10 flex items-center justify-center';


                    if (day == new Date().getDate()) {
                        cellDiv.className =
                            'w-full flex justify-center w-10 h-10 flex items-center justify-center bg-cyan-500/25 text-white! rounded-full';
                    }

                    if (i === 0 && j < firstDay) {
                        cellDiv.innerHTML =
                            '<p class="text-base text-center text-gray-400 dark:text-gray-600"></p>';
                    } else if (day > daysInMonth) {
                        break;
                    } else {
                        // if same day
                        if (day == new Date().getDate()) {
                            cellDiv.innerHTML =
                                `<p class="text-base text-center text-cyan-700">${day}</p>`;
                        } else
                        if (j === 0) {
                            cellDiv.innerHTML =
                                `<p class="text-base text-center text-red-500">${day}</p>`;
                        } else {
                            cellDiv.innerHTML =
                                `<p class="text-base text-center text-gray-800">${day}</p>`;
                        }
                        day++;
                    }

                    cell.appendChild(cellDiv);
                    row.appendChild(cell);
                }

                calendarDaysElement.appendChild(row);
            }
        }

        // Initial render
        renderCalendar(currentDate);
    });
</script>
