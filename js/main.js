let nav = document.querySelector("nav");
const openHam = (e) => {
  let iham = document.querySelector(".iham");
  let iclose = document.querySelector(".iclose");
  if (nav) {
    nav.classList.toggle("hidden");
    iham.classList.toggle("hidden");
    iclose.classList.toggle("hidden");
  }
};

document.getElementById("openHam").addEventListener("click", (e) => {
  document.getElementById("openHam").classList.toggle("ring-2");
  openHam();
});

const tablinks = document.querySelectorAll(".tablink");

const blockUnsafeCharacters = () => {
  // Get all input elements and text areas on the page
  const inputs = document.querySelectorAll('input, textarea');
  
  inputs.forEach(input => {
    input.addEventListener('input', (event) => {
      // Replace unwanted characters by ignoring them
      input.value = input.value.replace(/[<>'"/\\]/g, '');
    });
  });
}

window.onload = () => {
  const loading_section = document.querySelectorAll(".load-animation");
  loading_section.forEach((element) => {
    element.classList.remove("load-animation");
  });
};
document.addEventListener("DOMContentLoaded", (e) => {
  if (tablinks.length > 0) {
    tablinks.forEach((d) => {
      d.addEventListener("click", (e) => {
        let activeBu = e.target.nextElementSibling;
        if (window.innerWidth < 1024) {
          e.target.classList.toggle("tact");
          activeBu.classList.toggle("hidden");
        } else {
          e.target.classList.add("tact");
          activeBu.classList.remove("hidden");
        }
        let tabcontent = e.target.parentNode.parentNode.querySelectorAll(
          ".tablink+.tabcontent"
        );
        tabcontent.forEach((d) => {
          if (d != activeBu) {
            d.previousElementSibling.classList.remove("tact");
            d.classList.add("hidden");
          }
        });
      });
    });
    if (window.innerWidth > 1024) {
      if (window.location.hash.substring(1) == "services")
        tablinks[localStorage.getItem("services") ?? 0].click();
      else tablinks[0].click();
      if (localStorage.getItem("services") > tablinks.length - 1)
        localStorage.setItem("services", 0);
    }
  }
});

const openServices = (number) => {
  localStorage.setItem("services", number);
  tablinks[localStorage.getItem("services") ?? 0].click();
};

let lastScrollTop = 0;
// let header = document.querySelector("header");
// let upperHeader = document.querySelector("header");
window.addEventListener("scroll", () => {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  // if (scrollTop > 50) {
  //   header.classList.add("scrollheader");
  //   header.classList.add("removeUp");
  // } else {
  //   header.classList.remove("scrollheader");
  //   header.classList.remove("removeUp");
  // }

  // Animation on scroll for the services text
  if (startScroll) {
    let scrollAmount = window.scrollY + 7400;
    scrollingText.style.transform = `translateX(-${scrollAmount / 10}px)`;
  }
});

function changeTab(index) {
  let tabs = document.querySelectorAll(".tab");
  let panes = document.querySelectorAll(".tab-pane");

  tabs.forEach((tab, i) => {
    if (i === index) {
      tab.classList.add("tab-active", "bg-blue-500", "text-white");
      tab.classList.remove("bg-gray-200", "text-black");
      panes[i].classList.add("tab-pane-active");
    } else {
      tab.classList.remove("tab-active", "bg-blue-500", "text-white");
      tab.classList.add("bg-gray-200", "text-black");
      panes[i].classList.remove("tab-pane-active");
    }
  });
}

// JavaScript
const scrollingText = document.getElementById("scrollingText");
let startScroll = false;

let observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      startScroll = true;
    } else {
      startScroll = false;
    }
  });
});

// if (scrollingText) observer.observe(scrollingText);

// window.addEventListener("scroll", () => {});

const jobapply = () => {
  alert("Please contact directly with us for any job offering for now.");
};

