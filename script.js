const accordion = document.getElementsByClassName("accordion");

for (let i = 0; i < accordion.length; i++) {
  accordion[i].addEventListener("click", () => {

    accordion[i].classList.toggle("active");

    const panel = accordion[i].nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


// Get the modal
const modal = document.querySelector(".modal");
const span = document.getElementsByClassName("close")[0];
const modalButton = document.getElementsByClassName("edit-item");

for (let i = 0; i < modalButton.length; i++) {
  modalButton[i].addEventListener("click", () => {
    modal.style.display = "block";
  });
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}