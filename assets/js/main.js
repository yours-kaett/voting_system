(function () {
  "use strict";

  const select = (el, all = false) => {
    el = el.trim();
    if (all) {
      return [...document.querySelectorAll(el)];
    } else {
      return document.querySelector(el);
    }
  };

  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach((e) => e.addEventListener(type, listener));
    } else {
      select(el, all).addEventListener(type, listener);
    }
  };


  const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener);
  };


  if (select(".toggle-sidebar-btn")) {
    on("click", ".toggle-sidebar-btn", function (e) {
      select("body").classList.toggle("toggle-sidebar");
    });
  }


  let navbarlinks = select("#navbar .scrollto", true);
  const navbarlinksActive = () => {
    let position = window.scrollY + 200;
    navbarlinks.forEach((navbarlink) => {
      if (!navbarlink.hash) return;
      let section = select(navbarlink.hash);
      if (!section) return;
      if (
        position >= section.offsetTop &&
        position <= section.offsetTop + section.offsetHeight
      ) {
        navbarlink.classList.add("active");
      } else {
        navbarlink.classList.remove("active");
      }
    });
  };
  window.addEventListener("load", navbarlinksActive);
  onscroll(document, navbarlinksActive);


  let selectHeader = select("#header");
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add("header-scrolled");
      } else {
        selectHeader.classList.remove("header-scrolled");
      }
    };
    window.addEventListener("load", headerScrolled);
    onscroll(document, headerScrolled);
  }


  let backtotop = select(".back-to-top");
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add("active");
      } else {
        backtotop.classList.remove("active");
      }
    };
    window.addEventListener("load", toggleBacktotop);
    onscroll(document, toggleBacktotop);
  }


  // const button = document.querySelector(".btn");
  // function startLoader() {
  //   document.getElementById('loaderButton').style.color = '#474747';
  //   document.getElementById('loaderButton').style.backgroundColor = '#474747';
  //   button.classList.add("loading");
  //   button.disabled = true;
  //   setTimeout(stopLoader, 3000);
  // }
  // function stopLoader() {
  //   button.classList.remove("loading");
  //   button.disabled = false;
  //   document.getElementById('loaderButton').style.color = '#fff';
  //   var needsValidation = document.querySelectorAll(".needs-validation");
  //   Array.prototype.slice.call(needsValidation).forEach(function (form) {
  //     form.classList.add("was-validated");
  //   });
  // }
  // var formElement = document.querySelector(".needs-validation");
  // button.addEventListener(
  //   "click",
  //   formElement.addEventListener(
  //     "submit",
  //     function (event) {
  //       if (!formElement.checkValidity()) {
  //         event.preventDefault();
  //         event.stopPropagation();
  //       }
  //       startLoader();
  //     },
  //     false
  //   )
  // );

})();
