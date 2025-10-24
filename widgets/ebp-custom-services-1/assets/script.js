// Gallery Popup Functionality
document.addEventListener('DOMContentLoaded', function () {
  // Initialize all gallery popups
  initGalleryPopups();

  // Initialize read more/less functionality
  initReadMoreButtons();
});

function initGalleryPopups() {
  // Find all gallery icon overlays
  const galleryIcons = document.querySelectorAll('.gallery-icon-overlay');

  galleryIcons.forEach((icon) => {
    icon.addEventListener('click', function () {
      const galleryId = this.getAttribute('data-gallery-id');
      openGallery(galleryId);
    });
  });

  // Close gallery when clicking overlay or close button
  document.addEventListener('click', function (e) {
    if (
      e.target.classList.contains('gallery-popup-overlay') ||
      e.target.classList.contains('gallery-close')
    ) {
      closeGallery();
    }
  });

  // Handle navigation buttons
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('gallery-prev')) {
      navigateGallery('prev');
    } else if (e.target.classList.contains('gallery-next')) {
      navigateGallery('next');
    }
  });

  // Close gallery with Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeGallery();
    }
  });
}

function openGallery(galleryId) {
  const popup = document.getElementById(galleryId);
  if (popup) {
    popup.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling

    // Initialize slider for this gallery
    initGallerySlider(galleryId);
  }
}

function closeGallery() {
  const openPopup = document.querySelector('.gallery-popup[style*="block"]');
  if (openPopup) {
    openPopup.style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
  }
}

function initGallerySlider(galleryId) {
  const popup = document.getElementById(galleryId);
  const slider = popup.querySelector('.gallery-slider');
  const slides = slider.querySelectorAll('.gallery-slide');
  const prevBtn = popup.querySelector('.gallery-prev');
  const nextBtn = popup.querySelector('.gallery-next');

  let currentSlide = 0;

  // Show first slide
  showSlide(currentSlide);

  // Navigation functions
  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.display = i === index ? 'block' : 'none';
    });
  }

  function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }

  function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
  }

  // Store navigation functions on the popup for global access
  popup.navigateGallery = function (direction) {
    if (direction === 'next') {
      nextSlide();
    } else if (direction === 'prev') {
      prevSlide();
    }
  };
}

function navigateGallery(direction) {
  const openPopup = document.querySelector('.gallery-popup[style*="block"]');
  if (openPopup && openPopup.navigateGallery) {
    openPopup.navigateGallery(direction);
  }
}

// Read More/Less Functionality
function initReadMoreButtons() {
  // Find all read more buttons
  const readMoreButtons = document.querySelectorAll('.read-more-btn');

  readMoreButtons.forEach((button) => {
    button.addEventListener('click', function () {
      toggleReadMore(this);
    });
  });
}

function toggleReadMore(button) {
  // Get the item ID to find the corresponding expanded content
  const itemId = button.getAttribute('data-item-id');
  const readMoreText = button.getAttribute('data-read-more');
  const readLessText = button.getAttribute('data-read-less');

  // Find the expanded content for this specific item
  const expandedContent = button
    .closest('.text-content')
    .querySelector('.expanded-content');

  if (!expandedContent) {
    return; // No expanded content found
  }

  // Check if content is currently hidden
  const isHidden =
    expandedContent.style.display === 'none' ||
    expandedContent.style.display === '';

  if (isHidden) {
    // Show expanded content
    expandedContent.style.display = 'block';
    button.textContent = readLessText;
    button.setAttribute('aria-expanded', 'true');
  } else {
    // Hide expanded content
    expandedContent.style.display = 'none';
    button.textContent = readMoreText;
    button.setAttribute('aria-expanded', 'false');
  }
}
