const navLinks = Array.from(document.querySelectorAll('.nav-link'));
const cards = Array.from(document.querySelectorAll('.card'));
const sections = document.querySelectorAll('section[id]');

function updateActiveLink() {
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  
  navLinks.forEach((link) => {
    const href = link.getAttribute('href');
    const isCurrentPage = href === currentPage || (currentPage === '' && href === 'index.html');
    link.classList.toggle('active', isCurrentPage);
  });
}

function activateCardsOnScroll() {
  cards.forEach((card) => {
    const rect = card.getBoundingClientRect();
    if (rect.top < window.innerHeight * 0.9) {
      card.classList.add('visible');
    }
  });
}

function setupSmoothNavigation() {
  navLinks.forEach((link) => {
    const href = link.getAttribute('href');
    if (!href || !href.startsWith('#')) {
      return;
    }

    link.addEventListener('click', (event) => {
      event.preventDefault();
      const targetId = href.slice(1);
      const target = document.getElementById(targetId);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

window.addEventListener('scroll', () => {
  activateCardsOnScroll();
});

window.addEventListener('load', () => {
  setupSmoothNavigation();
  updateActiveLink();
  activateCardsOnScroll();
});
