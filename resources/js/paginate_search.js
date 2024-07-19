document.getElementById('searchInput').addEventListener('input', function () {
    const filter = this.value.toUpperCase();
    const table = document.getElementById('table');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let found = false;
        const cells = rows[i].getElementsByTagName('td', 'td');
        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            if (cell) {
                const textValue = cell.textContent || cell.innerText;
                if (textValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        if (found) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});
// paginate
const rowsPerPage = 30;
let currentPage = 1;

function displayTable(page) {
    const tableBody = document.getElementById("tableBody");
    const rows = tableBody.querySelectorAll("tr");
    const totalRows = rows.length;

    // ซ่อนทุกแถวก่อน
    rows.forEach(row => {
        row.style.display = "none";
    });

    // แสดงแถวของหน้าปัจจุบัน
    const start = (page - 1) * rowsPerPage;
    const end = page * rowsPerPage;
    for (let i = start; i < end && i < totalRows; i++) {
        rows[i].style.display = "";
    }
}

function setupPagination() {
    const prevButton = document.getElementById("prevPage");
    const nextButton = document.getElementById("nextPage");

    prevButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayTable(currentPage);
        }
    });

    nextButton.addEventListener("click", () => {
        const totalRows = document.getElementById("tableBody").querySelectorAll("tr").length;
        if (currentPage * rowsPerPage < totalRows) {
            currentPage++;
            displayTable(currentPage);
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    displayTable(currentPage);
    setupPagination();
});
