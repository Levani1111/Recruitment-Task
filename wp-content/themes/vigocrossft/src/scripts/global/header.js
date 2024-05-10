// Click on the menu icon to toggle between showing and hiding the navigation menu links when the user clicks on the icon
document.addEventListener("DOMContentLoaded", function () {
  var menuToggle = document.getElementById("menu-toggle");
  var navMenu = document.querySelector(".nav-menu");

  menuToggle.addEventListener("change", function () {
    if (this.checked) {
      navMenu.style.display = "block";
    } else {
      navMenu.style.display = "none";
    }
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 992) {
      navMenu.style.display = "flex";
    } else {
      navMenu.style.display = "none";
    }
  });

  var subMenuItems = document.querySelectorAll(
    ".nav-menu li.menu-item-has-children > a"
  );

  subMenuItems.forEach(function (item) {
    item.addEventListener("click", function (e) {
      e.preventDefault();
      var subMenu = this.nextElementSibling;
      subMenu.classList.toggle("show");
    });
  });
});



