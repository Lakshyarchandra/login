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

  $("#userinfoTable").DataTable({
    ajax: {
      url: "fetchinfo.php",
      dataSrc: "",
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error fetching data: ", textStatus, errorThrown);
      },
    },
    columns: [
      { data: "name" },
      { data: "email" },
      { data: "dob" },
      { data: "college" },
      { data: "contact" },
      { data: "filename" },
    ],
    dom: "Bfrtip",
    buttons: [
      {
        extend: "csvHtml5",
        text: "Export CSV",
        className: "submit-button",
      },
      {
        extend: "pdfHtml5",
        text: "Export PDF",
        className: "submit-button",
      },
    ],
    pagingType: "simple_numbers",
    responsive: true,
  });
});
