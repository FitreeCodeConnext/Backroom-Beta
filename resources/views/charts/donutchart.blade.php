<!-- Donut Chart -->
<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mb-6">
    <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
        <dl>
            <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">Donut Chart
            </dd>

        </dl>

    </div>
    <div class="mt-3">
        <div hidden>
                <label for="donut-date-input">เลือกวันที่:</label>
            <input type="date" id="donut-date-input"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">
            <button onclick="loadDonutData()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Load
                Data</button>
            <button onclick="resetDonutData()"
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Reset
                Data</button>
        </div>
        <div id="donut-chart" class="mx-auto"></div>
    </div>
</div>
