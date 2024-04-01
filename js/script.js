// Get SideMenu
var sideMenu = document.getElementById("sidemenu");

// On openTab function call
function openMenu() {
  sideMenu.style.right = "0";
}

// On closeTab function call
function closeMenu() {
  sideMenu.style.right = "-220px";
}

// Scroll Reveal's site

ScrollReveal({ 
  distance: '80px',
  duration: 2000,
  delay: 200
});

ScrollReveal().reveal('.header-bottom, .head-title, .footer-top', { origin: 'top' });
ScrollReveal().reveal('.opacity-layer, .flex-cards, .notice-headings, .iframe', { origin: 'bottom' });
ScrollReveal().reveal('#cta-section, .notice, .hero-left', { origin: 'left' });
ScrollReveal().reveal('.social-icons, .menu, .hero-right', { origin: 'right' });

const typed = new Typed('.multiple-text', {
  strings: ['FrontEnd Developer', 'Youtuber', 'Blogger'],
  typeSpeed: 100,
  backSpeed: 100,
  backDelay: 1000,
  loop: true
});
