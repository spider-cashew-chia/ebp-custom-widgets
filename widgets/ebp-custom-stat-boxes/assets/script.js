/**
 * EBP Custom Stat Boxes - Number Animation Script
 * Animates numbers on scroll using GSAP ScrollTrigger
 */

(function () {
  'use strict';

  // Wait for DOM and GSAP to be ready
  document.addEventListener('DOMContentLoaded', function () {
    // Check if GSAP and ScrollTrigger are available
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
      console.warn('GSAP or ScrollTrigger not loaded');
      return;
    }

    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // Find all stat number elements
    const statNumbers = document.querySelectorAll(
      '.ebp-custom-stat-boxes--number'
    );

    // Animate each number
    statNumbers.forEach(function (statNumber) {
      // Get the target number from data attribute
      const targetNumber = parseFloat(statNumber.getAttribute('data-target'));

      // Skip if no valid target number
      if (isNaN(targetNumber) || targetNumber <= 0) {
        return;
      }

      // Determine if the number should have decimal places
      // If target is a whole number, animate as integer; otherwise animate as decimal
      const isDecimal = targetNumber % 1 !== 0;
      const decimals = isDecimal ? 2 : 0;

      // Create a counter object that GSAP can properly track
      const counter = { value: 0 };

      // Create animation using gsap.to() with the counter object
      const animation = gsap.to(counter, {
        value: targetNumber,
        duration: 2, // Animation duration in seconds
        ease: 'power2.out', // Easing function for smooth animation
        onUpdate: function () {
          // Update the displayed number as animation progresses
          const currentValue = counter.value;

          // Format the number based on whether it's decimal or integer
          if (isDecimal) {
            statNumber.textContent = currentValue.toFixed(decimals);
          } else {
            // Format large numbers with commas (e.g., 5000 -> 5,000)
            statNumber.textContent =
              Math.floor(currentValue).toLocaleString('en-US');
          }
        },
        onComplete: function () {
          // Ensure final value is exactly the target
          if (isDecimal) {
            statNumber.textContent = targetNumber.toFixed(decimals);
          } else {
            statNumber.textContent =
              Math.floor(targetNumber).toLocaleString('en-US');
          }
        },
      });

      // Create ScrollTrigger for this animation
      ScrollTrigger.create({
        trigger: statNumber.closest('.ebp-custom-stat-boxes--item'),
        start: 'top 80%', // Start animation when element is 80% from top of viewport
        animation: animation,
        once: true, // Only animate once
        markers: false, // Set to true for debugging
      });
    });
  });
})();
