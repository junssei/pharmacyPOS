document.addEventListener("DOMContentLoaded", function () {
  const dropdownBtns = document.querySelectorAll(".dropdown-btn");

  dropdownBtns.forEach(function (dropdownBtn) {
    dropdownBtn.addEventListener("click", function (e) {
      e.preventDefault();
      const dropdownContainer = this.nextElementSibling;

      if (dropdownContainer.style.display === "block") {
        dropdownContainer.style.display = "none";
      } else {
        dropdownContainer.style.display = "block";
      }
    });
  });
});

function whenActive() {
  var elements = document.getElementsByClassName("active-link");

  for (var i = 0; i < elements.length; i++) {
    var parentElement = elements[i].parentElement;
    parentElement.style.display = "block";
  }
}

function addMedicine() {
  var elements = document.getElementsByClassName("popupContainer");

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].style.display == "flex") {
      elements[i].style.display = "none";
    } else {
      elements[i].style.display = "flex";
    }
  }
}