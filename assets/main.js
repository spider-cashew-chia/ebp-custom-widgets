AOS.init();

// Loading Animation - GSAP clip-path reveal
// Because even loading screens need proper timing
document.addEventListener('DOMContentLoaded', function () {
  const loadingOverlay = document.getElementById('ebp-loading-overlay');

  if (loadingOverlay) {
    // Apply clip-path reveal after 1500ms
    gsap.to(loadingOverlay, {
      clipPath: 'inset(0% 0% 100% 0%)', // Reveal from bottom to top
      duration: 1,
      ease: 'power4.out',
      delay: 1.5, // 1500ms delay
    });
  }
});

// Header scroll effect - because we need to feel something when scrolling
const header = document.querySelector('.navbar');
const scrollThreshold = 150;
window.addEventListener('scroll', () => {
  if (window.scrollY > scrollThreshold) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// Headings
const containers = document.querySelectorAll('.site-main .e-con');
const targetContainers = Array.from(containers).slice(1); // skip the first two

// Gather all headings inside the remaining .e-con elements
const headings = targetContainers.flatMap((container) =>
  Array.from(container.querySelectorAll('h1, h2, h3, h4'))
);

headings.forEach((heading) => {
  const split = new SplitText(heading, {
    type: 'words',
    wordsClass: 'split-word',
  });
  gsap.set(split.words, { yPercent: 70, opacity: 0 });
  gsap.to(split.words, {
    yPercent: 0,
    opacity: 1,
    duration: 0.6,
    ease: 'back.out(2)',
    stagger: 0.07,
    scrollTrigger: {
      trigger: heading,
      start: 'top 70%',
      once: true,
      // markers: true,
    },
  });
});

// Paragraphs
// Paragraphs (excluding footer)
const paragraphs = document.querySelectorAll(
  '.site-main .e-con p, .site-main .e-con li'
);

gsap.set(paragraphs, { opacity: 0, y: 30 });

paragraphs.forEach((paragraph) => {
  gsap.to(paragraph, {
    opacity: 1,
    y: 0,
    duration: 0.7,
    ease: 'back.out(2)',
    scrollTrigger: {
      trigger: paragraph,
      start: 'top 85%',
      once: true,
    },
  });
});

// Section images (excluding gallery icons)
const sectionImages = document.querySelectorAll(
  '.e-con.e-parent img:not(.gallery-icon)'
);
gsap.set(sectionImages, { clipPath: 'inset(100% 0 0 0)' });
sectionImages.forEach((image) => {
  gsap.to(image, {
    clipPath: 'inset(0% 0 0 0)',
    duration: 1.5,
    ease: 'power2.out',
    scrollTrigger: {
      trigger: image,
      start: 'top 60%',
      end: 'top 50%',
      once: true,
    },
  });
});
