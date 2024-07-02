document.addEventListener("DOMContentLoaded", () => {
  // Initialize datepicker
  $(".datepicker").datepicker({
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true,
  });

  // Logout button confirmation
  const logoutButton = document.querySelector("#logout-link .logout-button");
  const logoutLink = document.querySelector("#logout-link");
  const modal = document.getElementById("myModal");
  const confirmButton = modal.querySelector(".confirm");
  const cancelButton = modal.querySelector(".cancel");

  if (logoutButton && logoutLink) {
    logoutButton.addEventListener("click", (e) => {
      e.preventDefault();
      modal.style.display = "block"; // Show the modal
    });

    confirmButton.addEventListener("click", () => {
      window.location.href = logoutLink.href;
    });

    cancelButton.addEventListener("click", () => {
      modal.style.display = "none"; // Hide the modal
    });
  }

  // Sidebar navigation
  const links = document.querySelectorAll(".sidebar nav ul li a");
  const sections = document.querySelectorAll(".section");
  const header = document.querySelector("header");
  let lastScrollTop = 0;

  links.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href").substring(1);

      sections.forEach((section) => {
        section.classList.remove("active");
      });

      document.getElementById(targetId).classList.add("active");
    });
  });

  // Activate the first section by default
  if (sections.length > 0) {
    sections[0].classList.add("active");
  }

  // Scroll event to hide/reveal header
  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
      header.classList.add("hide");
    } else {
      header.classList.remove("hide");
    }
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });

  // Show the feedback modal if a message is set
  const feedbackModal = document.getElementById("feedbackModal");
  const feedbackClose = document.querySelector("#feedbackModal .close");
  const feedbackMessage = document
    .getElementById("modal-message")
    .textContent.trim();

  if (feedbackMessage) {
    feedbackModal.style.display = "block";
  }

  feedbackClose.addEventListener("click", () => {
    feedbackModal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target == feedbackModal) {
      feedbackModal.style.display = "none";
    }
  });
});
