<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-red-600 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    คุณแน่ใจหรือไม่ว่าต้องการลบ Terminal ID <span id="modal-term-id"></span> นี้</h3>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button data-modal-hide="popup-modal" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        ใช่ ฉันแน่ใจ
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        ไม่, ยกเลิก</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    // เมื่อเอกสารโหลดเสร็จแล้ว
    document.addEventListener('DOMContentLoaded', function() {
        // เลือกปุ่มที่มี attribute data-modal-target="popup-modal"
        const modalButtons = document.querySelectorAll('button[data-modal-target="popup-modal"]');

        // วนลูปเพื่อให้ทุกปุ่มสามารถทำงานได้
        modalButtons.forEach(button => {
            button.addEventListener('click', function() {
                // ดึงค่า data-id จากปุ่มที่ถูกคลิก
                const termId = this.dataset.id;

                // อ้างอิงไปยัง element ที่จะแสดงค่า termId
                const modalTermId = document.getElementById('modal-term-id');

                // แสดงค่า termId ในโมดัล
                modalTermId.textContent = termId;

                // อัปเดต action attribute ของ form ด้วย route ที่มีค่า term_id เป็น parameter
                const deleteForm = document.getElementById('delete-form');
                deleteForm.action =
                    `{{ route('terminal.destroy', ['terminal' => ':term_id']) }}`.replace(
                        ':term_id', termId);

                // เปิดโมดัล
                const modalElement = document.getElementById('popup-modal');
                modalElement.classList.remove('hidden');
            });
        });

        // ปิดโมดัลเมื่อคลิกปุ่มปิด
        const closeModalButtons = document.querySelectorAll('[data-modal-hide="popup-modal"]');
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalElement = document.getElementById('popup-modal');
                modalElement.classList.add('hidden');
            });
        });
    });
</script>
