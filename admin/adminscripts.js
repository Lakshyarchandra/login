document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".sidebar nav ul li a");
  const sections = document.querySelectorAll(".section");

  links.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(link.getAttribute("href"));

      sections.forEach((section) => {
        section.classList.remove("active");
      });
      target.classList.add("active");
    });
  });

  // Modal for logout confirmation
  const modal = document.getElementById("myModal");
  const logoutLink = document.getElementById("logout-link");
  const confirmButton = document.querySelector(".confirm");
  const cancelButton = document.querySelector(".cancel");

  logoutLink.addEventListener("click", function (e) {
    e.preventDefault();
    modal.style.display = "block";
  });

  confirmButton.addEventListener("click", function () {
    window.location.href = "logout.php";
  });

  cancelButton.addEventListener("click", function () {
    modal.style.display = "none";
  });

  window.addEventListener("click", function (e) {
    if (e.target == modal) {
      modal.style.display = "none";
    }
  });

  // Fetch and populate User Info Table
  fetch("fetchinfo.php")
    .then((response) => response.text())
    .then((html) => {
      const userinfoTable = document.querySelector("#userinfoTable tbody");
      userinfoTable.innerHTML = html; // Populate table with fetched HTML rows
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });

  // Export Table Data as CSV
  document.querySelector(".export-csv").addEventListener("click", () => {
    exportTableToCSV("userinfoTable", "userinfo.csv");
  });

  // Export Table Data as Word
  document.querySelector(".export-word").addEventListener("click", () => {
    exportTableToWord("userinfoTable", "userinfo.docx");
  });
});

// Function to export table data to CSV
function exportTableToCSV(tableId, filename) {
  const table = document.getElementById(tableId);
  const rows = Array.from(table.rows);
  const csvContent = rows
    .map((row) => {
      const cells = Array.from(row.cells);
      return cells.map((cell) => cell.textContent).join(",");
    })
    .join("\n");

  const blob = new Blob([csvContent], { type: "text/csv" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// Function to export table data to Word
function exportTableToWord(tableId, filename) {
  const table = document.getElementById(tableId);
  const html = `
    <html xmlns:o='urn:schemas-microsoft-com:office:office'
    xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>
    <head><meta charset='utf-8'><title>Export HTML To Doc</title></head>
    <body>${table.outerHTML}</body>
    </html>`;
  const blob = htmlDocx.asBlob(html);
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = filename;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
