// To be updated, jQuery remove
(function ($) {
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="modal"]').modal();
    function detectViewport() {
      var width = window.innerWidth;
      var viewport = "";
      if (width <= 576) {
        viewport = "xs";
      } else if (width >= 576 && width <= 768) {
        viewport = "sm";
      } else if (width >= 768 && width <= 992) {
        viewport = "md";
      } else if (width >= 992 && width <= 1200) {
        viewport = "lg";
      } else if (width >= 1200) {
        viewport = "xl";
      }
      $("body").attr("data-viewport", viewport);
    }
    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function checkCookie(cname) {
      var user = getCookie("username");
      if (user != "") {
        alert("Welcome again " + user);
      } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
          setCookie("username", user, 365);
        }
      }
    }
    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(";");
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
  });
})(jQuery);
