function togglePass() {
  var x = document.getElementById("passInput");
  var y = document.getElementById("passIcon");

  if (x.type === "password") {
    y.src = "images/eye.png";
    x.type = "text";
  } else {
    x.type = "password";
    y.src = "images/hidden.png";
  }
}

function usermenuToggle() {
  var elements = document.getElementsByClassName("usermenu");

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].style.display == "block") {
      elements[i].style.display = "none";
    } else {
      elements[i].style.display = "block";
    }
  }
}

// For date and time
setInterval(() => {
  let d = new Date();
  let elements = document.getElementsByClassName("datime");
  let dateElements = document.getElementsByClassName("dadate");

  for (let i = 0; i < elements.length; i++) {
    elements[i].innerHTML = d.toLocaleTimeString();
  }

  for (let i = 0; i < dateElements.length; i++) {
    let options = {
      weekday: "long",
      day: "numeric",
      month: "long",
      year: "numeric",
    };
    dateElements[i].innerHTML = d.toLocaleDateString("en-US", options);
  }
});
