document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.querySelector(".carousel");
  const prevButton = document.querySelector(".carousel-prev");
  const nextButton = document.querySelector(".carousel-next");
  const items = carousel.querySelectorAll(".carousel-item");
  let currentIndex = 0;
  const totalItems = items.length;

  // Function to handle the transition to the next item
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
});


// Create user modal
document.addEventListener("DOMContentLoaded", function () {
  const openModalButton = document.getElementById("openModal");
  const closeModalButton = document.getElementById("closeModal");
  const modalOverlay = document.getElementById("modalOverlay");
  const modal = document.getElementById("addUserModal");
  const form = document.getElementById("addUserForm");

  // Show modal when the 'Add New User' button is clicked
  openModalButton.addEventListener("click", function (e) {
    e.preventDefault();
    modalOverlay.classList.add("modal-show");
  });

  // Hide modal when the close button is clicked
  closeModalButton.addEventListener("click", function () {
    modalOverlay.classList.remove("modal-show");
  });

  // Prevent clicks inside the modal from closing the modal
  modal.addEventListener("click", function (event) {
    event.stopPropagation();
  });

  modalOverlay.addEventListener("click", function (event) {
    if (event.target === modalOverlay) {
      modalOverlay.classList.remove("modal-show");
    }
  });

  // Form submission via AJAX
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/create-user", true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.onload = function () {
      if (xhr.status === 200) {
        alert("User added successfully!");
        form.reset();
        modalOverlay.classList.remove("modal-show");
        location.reload();
      } else {
        alert("Error adding user");
      }
    };

    xhr.send(formData);
  });
});


// Update user modal
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");
    const editUserModal = document.getElementById("editUserModal");
    const editUserModalOverlay = document.getElementById("editUserModalOverlay");
    const closeEditModalButton = document.getElementById("closeEditModal");
    const editUserForm = document.getElementById("editUserForm");

    editButtons.forEach(button => {
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

    window.addEventListener("click", function (event) {
        if (event.target === editUserModalOverlay) {
            editUserModalOverlay.style.display = "none";
            editUserModal.classList.remove("modal-show");
        }
    });

    // AJAX form submission for editing a user
    editUserForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(editUserForm);
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/admin/edit-user", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert("User updated successfully!");
                editUserModalOverlay.style.display = "none";
                location.reload();
            } else {
                alert("Error updating user.");
            }
        };

        xhr.send(formData);
    });
});

// delete user 
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");




    
    deleteButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const userId = this.getAttribute("data-id");
            const confirmDelete = confirm('Are you sure you want to delete this user?');

            if (confirmDelete) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/admin/delete-user", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        location.reload();
                    } else {
                        alert("Error deleting user.");
                    }
                };

                xhr.send(`id=${userId}`);
            }
        });
    });

});



