// Read More/Less Functionality for Text Block 3
document.addEventListener('DOMContentLoaded', function () {
  // Initialize read more/less functionality
  initReadMoreButtons();
});

// Also try to initialize when the page is fully loaded as a fallback
window.addEventListener('load', function () {
  initReadMoreButtons();
});

function initReadMoreButtons() {
  // Find all read more buttons within this widget
  const readMoreButtons = document.querySelectorAll(
    '.ebp-custom-text-block-3 .read-more-btn'
  );

  readMoreButtons.forEach((button) => {
    // Remove any existing event listeners to prevent duplicates
    button.removeEventListener('click', handleReadMoreClick);

    // Add the event listener
    button.addEventListener('click', handleReadMoreClick);
  });
}

function handleReadMoreClick(e) {
  e.preventDefault();
  toggleReadMore(this);
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
