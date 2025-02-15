
// // Import only the Bootstrap components we need
// import { Popover } from 'bootstrap';

// import { Offcanvas } from 'bootstrap';
// const offcanvasElementList = document.querySelectorAll('.offcanvas')
// const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl))

// // Create an example popover
// document.querySelectorAll('[data-bs-toggle="popover"]')
//   .forEach(popover => {
//     new Popover(popover)
//   })

function initializeThemeToggle() {
  const checkbox = document.getElementById('toggleTheme');
  
  if (checkbox) {
      function toggleTheme() {
          const htmlTag = document.documentElement;
          const theme = checkbox.checked ? 'dark' : 'light';
          
          if (theme === 'dark') {
              htmlTag.setAttribute('data-bs-theme', 'dark');
          } else {
              htmlTag.removeAttribute('data-bs-theme');
          }
          
          // Set cookie
          document.cookie = `wp_theme_preference=${theme}; path=/; max-age=31536000`; // 1 year expiration
          
          console.log(theme);
      }

      checkbox.addEventListener('change', toggleTheme);

      // Check cookie on page load
      const themeCookie = document.cookie.split('; ').find(row => row.startsWith('wp_theme_preference='));
      if (themeCookie) {
          const savedTheme = themeCookie.split('=')[1];
          checkbox.checked = savedTheme === 'dark';
      }

      // Initial call to set the correct theme
      toggleTheme();
  }
}

// Call the function when the DOM is fully loaded
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
  
  document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header.position-fixed');
    const scrollThreshold = 50; // Adjust this value as needed

    function toggleScrolledClass() {
        if (window.scrollY > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    // Initial check on page load
    toggleScrolledClass();

    // Add event listener for scroll
    window.addEventListener('scroll', toggleScrolledClass);
});
document.addEventListener('DOMContentLoaded', function() {
  const dropdowns = document.querySelectorAll('.dropdown-toggle');
  dropdowns.forEach(dropdown => {
      dropdown.addEventListener('click', function(e) {
          e.preventDefault();
          this.parentNode.classList.toggle('active');
      });
  });
});
document.addEventListener('DOMContentLoaded', function() {
  const toggleButton = document.getElementById('lg-toggleSidebar');
  const sidebar = document.querySelector('.sidebar.d-none.d-lg-block');

  if (toggleButton && sidebar) {
      toggleButton.addEventListener('click', function() {
          sidebar.classList.toggle('show');
      });
  }
});