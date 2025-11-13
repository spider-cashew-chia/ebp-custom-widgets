// document.addEventListener('DOMContentLoaded', function () {
//   const offcanvasEl = document.querySelector('.offcanvas');
//   const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);

//   document.querySelectorAll('#toc-nav .menu-item a').forEach((link) => {
//     link.addEventListener('click', function (e) {
//       e.preventDefault(); // stop the instant jump

//       const targetId = this.getAttribute('href'); // e.g. "#section1"

//       // when offcanvas fully hidden, then scroll to target
//       offcanvasEl.addEventListener('hidden.bs.offcanvas', function handler() {
//         offcanvasEl.removeEventListener('hidden.bs.offcanvas', handler);

//         if (targetId && targetId.startsWith('#')) {
//           document.querySelector(targetId).scrollIntoView({
//             behavior: 'smooth',
//           });
//         }
//       });

//       // close the offcanvas
//       bsOffcanvas.hide();
//     });
//   });
// });
