// // Import only the Bootstrap components we need
// import { Popover } from 'bootstrap';

import { Offcanvas } from 'bootstrap';
const offcanvasElementList = document.querySelectorAll('.offcanvas')
const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl))

// // Create an example popover
// document.querySelectorAll('[data-bs-toggle="popover"]')
//   .forEach(popover => {
//     new Popover(popover)
//   })

  function initializeThemeToggle() {
    // Check if the checkbox exists
    const checkbox = document.getElementById('toggleTheme');
    
    if (checkbox) {
      // Function to handle theme toggle
      function toggleTheme() {
        const htmlTag = document.documentElement;
        
        if (checkbox.checked) {
          htmlTag.setAttribute('data-bs-theme', 'dark');
          console.log('dark');
        } else {
          htmlTag.removeAttribute('data-bs-theme');
          console.log('light');
        }
      }
  
      // Add event listener to the checkbox
      checkbox.addEventListener('change', toggleTheme);
  
      // Initial call to set the correct theme based on checkbox state
      toggleTheme();
    }
  }
  
  // Run the initialization function when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', initializeThemeToggle);
  

  function replaceSVGImagesWithInlineSVG() {
    // Function to fetch SVG content
    function fetchSVG(url) {
      return fetch(url)
        .then(response => response.text())
        .then(svgContent => {
          const parser = new DOMParser();
          const svgDOM = parser.parseFromString(svgContent, 'image/svg+xml');
          return svgDOM.querySelector('svg');
        });
    }
  
    // Get all images within elements with class 'logo'
    const logoImages = document.querySelectorAll('.custom-logo-link img');
  
    logoImages.forEach(img => {
      const src = img.src;
      if (src.match(/.*\.svg$/)) {
        fetchSVG(src)
          .then(svg => {
            // Remove xmlns and xmlns:xlink attributes
            svg.removeAttribute('xmlns');
            svg.removeAttribute('xmlns:xlink');
  
            // Replace the image with the SVG
            img.parentNode.replaceChild(svg, img);
          })
          .catch(error => console.error('Error fetching SVG:', error));
      }
    });
  }
  
  // Run the function when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', replaceSVGImagesWithInlineSVG);
  
  document.querySelectorAll(".menu-item-has-children").forEach((it) => {
    const subMenu = it.querySelector(".sub-menu");
    it.addEventListener("click", (ev) => {
      // ev.preventDefault();
      subMenu.classList.toggle("show");
      it.classList.toggle("open");
    });
  });
  
  document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");
    forms.forEach(function (form) {
      form.reset();
    });
  });
  

  
  // Get all the card elements
  const cards = document.querySelectorAll(".overlayCards .card");
  
  // Add event listeners to each card
  cards.forEach((card) => {
    // const cardTitle = card.querySelector('.card-title'); // Get the h4 element within the card
  
    card.addEventListener("mouseenter", () => {
      // Remove the 'show' class from all cards
      cards.forEach((c) => {
        c.classList.remove("show");
        // c.querySelector('.card-title').classList.remove('lp-underline'); // Remove 'lp-underline' class from all h4 elements
      });
  
      // Add the 'show' class to the hovered card
      card.classList.add("show");
      // cardTitle.classList.add('lp-underline'); // Add 'lp-underline' class to the h4 element of the hovered card
    });
  
    card.addEventListener("mouseleave", () => {
      // Remove the 'show' class from the card
      card.classList.remove("show");
      // cardTitle.classList.remove('lp-underline'); // Remove 'lp-underline' class from the h4 element
    });
  });

    // Sort Press Releases Ascending or Descending
    if (document.getElementById("sort-btn") !== null) {
      const sortBtn = document.getElementById("sort-btn");
      const currentUrl = new URL(window.location.href);
      let sortOrder = currentUrl.searchParams.get("order");
  
      if (sortOrder === "asc") {
      } else {
        sortOrder = "desc";
      }
  
      sortBtn.addEventListener("click", () => {
        const currentUrl = new URL(window.location.href);
        const sortOrder = currentUrl.searchParams.get("order");
        if (sortOrder === "asc") {
          currentUrl.searchParams.set("order", "desc");
        } else {
          currentUrl.searchParams.set("order", "asc");
        }
        window.location.href = currentUrl.href;
      });
  
      // Sets the Card holder to grid for lists
      //
      const gridBtn = document.getElementById("grid-btn");
      const listBtn = document.getElementById("list-btn");
  
      let cardStyle = currentUrl.searchParams.get("style");
      if (cardStyle === "grid") {
      } else {
        cardStyle = "list";
      }
  
      gridBtn.addEventListener("click", () => {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set("style", "grid");
        window.location.href = currentUrl.href;
        var cardHolders = document.querySelectorAll(".card-holder");
        cardHolders.forEach(function (cardHolder) {
          cardHolder.classList.remove("card-list");
          cardHolder.classList.add("col-md-6");
          cardHolder.classList.add("col-lg-4");
          cardHolder.classList.add("card-grid");
        });
        var swapCardImages = document.querySelectorAll(".swap-card-image");
        swapCardImages.forEach(function (swapCardImage) {
          swapCardImage.classList.remove("col-md-4");
        });
        var swapCardBodies = document.querySelectorAll(".swap-card-body");
        swapCardBodies.forEach(function (swapCardBody) {
          swapCardBody.classList.remove("col-md-8");
        });
      });
      // Sets the Card holder to lists for grids
      listBtn.addEventListener("click", () => {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set("style", "list");
        window.location.href = currentUrl.href;
        var cardHolders = document.querySelectorAll(".card-holder");
        cardHolders.forEach(function (cardHolder) {
          cardHolder.classList.remove("col-md-6");
          cardHolder.classList.remove("col-lg-4");
          cardHolder.classList.remove("card-grid");
          cardHolder.classList.add("card-list");
        });
        var swapCardImages = document.querySelectorAll(".swap-card-image");
        swapCardImages.forEach(function (swapCardImage) {
          swapCardImage.classList.add("col-md-4");
        });
        var swapCardBodies = document.querySelectorAll(".swap-card-body");
        swapCardBodies.forEach(function (swapCardBody) {
          swapCardBody.classList.add("col-md-8");
        });
      });
    }
  
    // // Sticky Navbar
    // const navBar = document.getElementById("site-header");
    // const offset = 90;
    // window.addEventListener("scroll", () => {
    //   if (window.scrollY <= offset) {
    //     navBar.classList.remove("sticky-top");
    //   } else {
    //     navBar.classList.add("sticky-top");
    //   }
    // });
    // search bar empty or not a good search
    const searchForms = document.querySelectorAll(".search-form");
  
    searchForms.forEach((form) => {
      form.addEventListener("submit", function (event) {
        const searchInput = form.querySelector('input[name="s"]');
        const inputValue = searchInput.value.trim();
        if (
          inputValue === "" ||
          inputValue === "." ||
          inputValue.match(/^[\s\.]+$/) ||
          inputValue.length < 3
        ) {
          event.preventDefault();
        }
      });
    });
  
  document.addEventListener("DOMContentLoaded", function () {
    const videoWrappers = document.getElementsByClassName("video-wrapper");
  
    Array.prototype.forEach.call(videoWrappers, function (videoWrapper) {
      const video = videoWrapper.getElementsByTagName("video")[0];
      if (video) {
        const videoMethods = {
          renderVideoPlayButton: function () {
            if (videoWrapper.contains(video)) {
              this.formatVideoPlayButton();
              video.classList.add("has-media-controls-hidden");
              const videoPlayButton = videoWrapper.getElementsByClassName(
                "video-overlay-play-button"
              )[0];
              videoPlayButton.addEventListener(
                "click",
                this.hideVideoPlayButton.bind(this)
              );
            }
          },
  
          formatVideoPlayButton: function () {
            videoWrapper.insertAdjacentHTML(
              "beforeend",
              '\
                            <svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">\
                                <circle cx="100" cy="100" r="90" fill="none" stroke-width="15" stroke="#fff"/>\
                                <polygon points="70, 55 70, 145 145, 100" fill="#fff"/>\
                            </svg>\
                        '
            );
          },
  
          hideVideoPlayButton: function () {
            video.play();
            const videoPlayButton = videoWrapper.getElementsByClassName(
              "video-overlay-play-button"
            )[0];
            videoPlayButton.classList.add("is-hidden");
            video.classList.remove("has-media-controls-hidden");
            video.setAttribute("controls", "controls");
          },
        };
  
        videoMethods.renderVideoPlayButton();
      }
    });
  });
  
  // calendar code for start
  // document.addEventListener("DOMContentLoaded", function () {
  //   const calendarElement = document.getElementById("calendar");
  //   if (calendarElement) {
  //     const eventCalendar = new tui.Calendar(calendarElement, {
  //       defaultView: "month",
  //       template: {
  //         time(event) {
  //           const { start, end, title } = event;
  
  //           return `<span style="color: white;">${formatTime(start)}~${formatTime(
  //             end
  //           )} ${title}</span>`;
  //         },
  //         allday(event) {
  //           return `<span style="color: gray;">${event.title}</span>`;
  //         },
  //       },
  //       calendars: [
  //         {
  //           id: "cal1",
  //           name: "Event",
  //           backgroundColor: "#ed1c24",
  //         },
  //         {
  //           id: "cal2",
  //           name: "Press Release",
  //           backgroundColor: "#00a9ff",
  //         },
  //       ],
  //     });
  //   }
  // });
  // document.addEventListener('DOMContentLoaded', function() {
  //   // Get all buttons with the class 'presentation-modal-btn a'
  //   const buttons = document.querySelectorAll('.presentation-modal-btn a');
  
  //   // Check if there are any buttons with the specified class
  //   if (buttons.length === 0) {
  //       console.log('No buttons with selector ".presentation-modal-btn a" found. Exiting function.');
  //       return; // Exit the function if no buttons are found
  //   }
  
  //   // Get the modal element
  //   const modal = document.getElementById('staticBackdrop');
  
  //   // Get the form element
  //   const form = modal.querySelector('form');
  
  //   // Add click event listener to all buttons
  //   buttons.forEach(button => {
  //       button.addEventListener('click', function(event) {
  //           event.preventDefault(); // Prevent default anchor behavior
  //           // Create a new bootstrap modal instance
  //           const modalInstance = new bootstrap.Modal(modal);
  //           // Show the modal
  //           modalInstance.show();
  //       });
  //   });
  
  //   // Add submit event listener to the form
  //   form.addEventListener('submit', function(event) {
  //       event.preventDefault(); // Prevent the default form submission
  
  //       // Get form data
  //       const formData = new FormData(form);
  
  //       // Send form data to the server (you may need to adjust this part based on your backend)
  //       fetch(form.action, {
  //           method: 'POST',
  //           body: formData
  //       })
  //       .then(response => {
  //           if (response.ok) {
  //               // If form submission is successful, trigger file download
  //               const currentDomain = window.location.origin;
  //               const downloadLink = `${currentDomain}/wp-content/uploads/2024/06/LP-InvestorPresentation-V5.pdf`;
  //               const link = document.createElement('a');
  //               link.href = downloadLink;
  //               link.download = 'LP-InvestorPresentation-V5.pdf';
  //               document.body.appendChild(link);
  //               link.click();
  //               document.body.removeChild(link);
  
  //               // Close the modal
  //               const modalInstance = bootstrap.Modal.getInstance(modal);
  //               modalInstance.hide();
  
  //               // Optional: Reset the form
  //               form.reset();
  //           } else {
  //               // Handle error if form submission fails
  //               console.error('Form submission failed');
  //           }
  //       })
  //       .catch(error => {
  //           console.error('Error:', error);
  //       });
  //   });
  // });
  
  document.addEventListener("DOMContentLoaded", function () {
    // Get all buttons with the class 'presentation-modal-btn a.elementor-icon'
    const buttons = document.querySelectorAll(".presentation-modal-btn a");
  
    // Check if there are any buttons with the specified class
    if (buttons.length === 0) {
      console.log("No presentation download found on this page.");
      return; // Exit the function if no buttons are found
    }
  
    // Get the modal element
    const modal = document.getElementById("staticBackdrop");
  
    // Get the form element
    const form = modal.querySelector("form");
  
    // Add click event listener to all buttons
    buttons.forEach((button) => {
      button.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        // Create a new bootstrap modal instance
        const modalInstance = new bootstrap.Modal(modal);
        // Show the modal
        modalInstance.show();
      });
    });
  
    // Add submit event listener to the form
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission
  
      // Get the input fields
      const nameInput = form.querySelector("#name");
      const emailInput = form.querySelector("#email");
  
      // Check if both fields are filled
      if (nameInput.value.trim() !== "" && emailInput.value.trim() !== "") {
        // Both fields are filled, proceed with form submission and file download
  
        // Trigger file download
        const currentDomain = window.location.origin;
        const downloadLink = `${currentDomain}/wp-content/uploads/2024/06/LP-InvestorPresentation-V5.pdf`;
        const link = document.createElement("a");
        link.href = downloadLink;
        link.download = "LP-InvestorPresentation-V5.pdf";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
  
        // Close the modal
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
  
        // Optional: Reset the form
        form.reset();
  
        // Submit the form data to the server (this will happen in the background)
        form.submit();
      } else {
        // Display an error message if fields are not filled
        alert("Please fill in both the name and email fields.");
      }
    });
  });
  