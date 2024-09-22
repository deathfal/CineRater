document.addEventListener("DOMContentLoaded", function () {
  // Carousel controls

  if(document.querySelector(".carousel")) {
    const carousel = document.querySelector(".carousel");
    const prevButton = document.querySelector(".carousel-prev");
    const nextButton = document.querySelector(".carousel-next");
    const items = carousel.querySelectorAll(".carousel-item");
    let currentIndex = 0;
    const totalItems = items.length;

    // Handle carousel transitions
    function showNextItem() {
      const currentItem = items[currentIndex];
      currentItem.classList.add("outgoing-next");

      currentIndex = (currentIndex + 1) % totalItems;
      const nextItem = items[currentIndex];
      nextItem.classList.add("active");

      setTimeout(() => {
        currentItem.classList.remove("outgoing-next", "active");
      }, 800);
    }

    function showPrevItem() {
      const currentItem = items[currentIndex];
      currentItem.classList.add("outgoing-prev");

      currentIndex = (currentIndex - 1 + totalItems) % totalItems;
      const prevItem = items[currentIndex];
      prevItem.classList.add("active", "incoming-prev");

      setTimeout(() => {
        currentItem.classList.remove("outgoing-prev", "active");
        prevItem.classList.remove("incoming-prev");
      }, 800);
    }

    items[currentIndex].classList.add("active");

    const autoSlide = setInterval(showNextItem, 5000);

    nextButton.addEventListener("click", function () {
      clearInterval(autoSlide);
      showNextItem();
    });

    prevButton.addEventListener("click", function () {
      clearInterval(autoSlide);
      showPrevItem();
    });
  }

  // Search bar with result prediction
  const searchInput = document.querySelector(".search-bar-input");
  const resultBox = document.querySelector(".search-results");

  searchInput.addEventListener("input", function () {
    const query = this.value.trim();
    if (query.length > 2) {
      fetch(`/search?query=${encodeURIComponent(query)}`)
        .then((response) => response.json())
        .then((data) => {
          resultBox.innerHTML = ""; // Clear previous results
          if (data.length > 0) {
            resultBox.style.display = "block"; // Show results box
            data.forEach((movie) => {
              const resultItem = document.createElement("div");
              resultItem.classList.add("search-result-item");
              resultItem.innerHTML = `
                <a href="/movie/${movie.id}">
                  <img src="${movie.image}" alt="${movie.title}">
                  <span>${movie.title}</span>
                </a>
              `;
              resultBox.appendChild(resultItem);
            });
          } else {
            resultBox.innerHTML = `<p>No results found</p>`;
          }
        })
        .catch((error) => {
          console.error("Error fetching search results:", error);
        });
    } else {
      resultBox.style.display = "none"; // Hide results box
      resultBox.innerHTML = ""; // Clear results when input is too short
    }
  });

  // Hide the results when clicking outside the search box and results
  document.addEventListener("click", function (e) {
    if (!searchInput.contains(e.target) && !resultBox.contains(e.target)) {
      resultBox.style.display = "none"; // Hide the results box
    }
  });

  // Add user modal functionality
  const openModalButton = document.getElementById("openModal");
  const closeModalButton = document.getElementById("closeModal");
  const modalOverlay = document.getElementById("modalOverlay");
  const modal = document.getElementById("addUserModal");
  const form = document.getElementById("addUserForm");

  openModalButton.addEventListener("click", function (e) {
    e.preventDefault();
    modalOverlay.classList.add("modal-show");
  });

  closeModalButton.addEventListener("click", function () {
    modalOverlay.classList.remove("modal-show");
  });

  modal.addEventListener("click", function (event) {
    event.stopPropagation();
  });

  modalOverlay.addEventListener("click", function (event) {
    if (event.target === modalOverlay) {
      modalOverlay.classList.remove("modal-show");
    }
  });

  // Submit the add user form via AJAX
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(form);

    fetch("/admin/create-user", {
      method: "POST",
      headers: { "X-Requested-With": "XMLHttpRequest" },
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          alert("User added successfully!");
          form.reset();
          modalOverlay.classList.remove("modal-show");
          location.reload(); // Reload the page to see the new user
        } else {
          alert("Error adding user");
        }
      })
      .catch((error) => console.error("Error adding user:", error));
  });

  // Edit user modal functionality
  const editButtons = document.querySelectorAll(".edit-btn");
  const editUserModal = document.getElementById("editUserModal");
  const editUserModalOverlay = document.getElementById("editUserModalOverlay");
  const closeEditModalButton = document.getElementById("closeEditModal");
  const editUserForm = document.getElementById("editUserForm");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const userId = this.getAttribute("data-id");
      const userEmail = this.getAttribute("data-email");
      const userRole = this.getAttribute("data-role");

      document.getElementById("editUserId").value = userId;
      document.getElementById("editEmail").value = userEmail;
      document.getElementById("editRole").value = userRole;

      editUserModalOverlay.style.display = "flex";
      editUserModal.classList.add("modal-show");
    });
  });

  closeEditModalButton.addEventListener("click", function () {
    editUserModalOverlay.style.display = "none";
    editUserModal.classList.remove("modal-show");
  });

  // Handle clicking outside the modal to close it
  window.addEventListener("click", function (event) {
    if (event.target === editUserModalOverlay) {
      editUserModalOverlay.style.display = "none";
      editUserModal.classList.remove("modal-show");
    }
  });

  // Submit the edit user form via AJAX
  editUserForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(editUserForm);

    fetch("/admin/edit-user", {
      method: "POST",
      headers: { "X-Requested-With": "XMLHttpRequest" },
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          alert("User updated successfully!");
          editUserModalOverlay.style.display = "none";
          location.reload(); // Reload the page to reflect the updated user
        } else {
          alert("Error updating user.");
        }
      })
      .catch((error) => console.error("Error updating user:", error));
  });

  // Delete user functionality
  const deleteButtons = document.querySelectorAll(".delete-btn");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      const userId = this.getAttribute("data-id");
      const confirmDelete = confirm(
        "Are you sure you want to delete this user?"
      );

      if (confirmDelete) {
        fetch("/admin/delete-user", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "X-Requested-With": "XMLHttpRequest",
          },
          body: `id=${encodeURIComponent(userId)}`,
        })
          .then((response) => {
            if (response.ok) {
              location.reload(); // Reload the page after deletion
            } else {
              alert("Error deleting user.");
            }
          })
          .catch((error) => console.error("Error deleting user:", error));
      }
    });
  });
});
