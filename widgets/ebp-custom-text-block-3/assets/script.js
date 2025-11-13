// Read More/Less Functionality for Text Block 3
// Use event delegation to handle clicks on read more buttons
// This works even if buttons are added dynamically
document.addEventListener('click', function (e) {
  // Check if the clicked element is a read more button
  if (e.target.classList.contains('read-more-btn')) {
    const button = e.target;
    const readMoreText = button.getAttribute('data-read-more');
    const readLessText = button.getAttribute('data-read-less');

    // Find the expanded content in the same text-content container
    const textContent = button.closest('.text-content');
    if (!textContent) return;

    const expandedContent = textContent.querySelector('.expanded-content');
    if (!expandedContent) return;

    // Toggle visibility by checking current display style
    const currentDisplay = expandedContent.style.display;

    if (currentDisplay === 'none' || currentDisplay === '') {
      // Show the expanded content
      expandedContent.style.display = 'block';
      button.textContent = readLessText;
      button.setAttribute('aria-expanded', 'true');
    } else {
      // Hide the expanded content
      expandedContent.style.display = 'none';
      button.textContent = readMoreText;
      button.setAttribute('aria-expanded', 'false');
    }
  }
});
