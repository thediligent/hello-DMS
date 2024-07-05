// // Import only the Bootstrap components we need
// import { Popover } from 'bootstrap';

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
  