// Get elements
const modal = document.getElementById("taskModal");
const addTaskBtn = document.getElementById("addTaskBtn");
const closeModalBtn = document.querySelector(".close");
5;
// Function to open modal
addTaskBtn.addEventListener("click", () => {
  modal.style.display = "block";
});

// Function to close modal
closeModalBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// Close modal if user clicks outside the modal content
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});
