document.addEventListener('DOMContentLoaded', () => {
  initHeaderScroll();
  initSmoothScroll();
  initScrollReveal();
  initParallaxEffect();
  initActiveOnScroll();
});


// =========================
// HEADER INTELIGENTE
// =========================
function initHeaderScroll() {
  const body = document.body;
  const header = document.querySelector('.header-container');

  window.addEventListener('scroll', () => {
    const y = window.scrollY;

    if (y > 50) {
      body.classList.add('scrolled');
      header.style.transform = "scale(0.97)";
      header.style.backdropFilter = "blur(25px)";
    } else {
      body.classList.remove('scrolled');
      header.style.transform = "scale(1)";
    }
  }, { passive: true });
}


// =========================
// SCROLL SUAVE
// =========================
function initSmoothScroll() {
  const links = document.querySelectorAll('a[href^="#"]');

  links.forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;

      const target = document.querySelector(targetId);
      if (!target) return;

      e.preventDefault();

      const headerOffset = 100; // altura do header
      const elementPosition = target.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

      smoothScrollTo(offsetPosition, 700); // duração em ms
    });
  });
} 

// =========================
// NAV ATIVA AUTOMÁTICA (PRO LEVEL)
// =========================
function initActiveOnScroll() {
  const sections = document.querySelectorAll('section');
  const navLinks = document.querySelectorAll('.nav-link');

  window.addEventListener('scroll', () => {
    let current = "";

    sections.forEach(section => {
      const top = section.offsetTop - 120;
      if (window.scrollY >= top) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  });
}


// =========================
// REVEAL ANIMATION
// =========================
function initScrollReveal() {
  const elements = document.querySelectorAll('.reveal');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {

      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        entry.target.classList.remove('out');
      } else {
        entry.target.classList.remove('active');
        entry.target.classList.add('out');
      }

    });
  }, {
    threshold: 0.15
  });

  elements.forEach(el => observer.observe(el));
}


// =========================
// PARALLAX PREMIUM
// =========================
function initParallaxEffect() {
  // evita em celular
  if (window.matchMedia("(pointer: coarse)").matches) return;

  const wrappers = document.querySelectorAll('.parallax-img');

  wrappers.forEach(wrapper => {
    const img = wrapper.querySelector('img');
    if (!img) return;

    wrapper.addEventListener('mousemove', (e) => {
      const rect = wrapper.getBoundingClientRect();

      const x = (e.clientX - rect.left - rect.width / 2) / 20;
      const y = (e.clientY - rect.top - rect.height / 2) / 20;

      img.style.transform = `scale(1.05) translate(${x}px, ${y}px)`;
      img.style.transition = 'transform 0.08s linear';
    });

    wrapper.addEventListener('mouseleave', () => {
      img.style.transform = `scale(1) translate(0, 0)`;
      img.style.transition = 'transform 0.4s ease';
    });
  });
}

function smoothScrollTo(target, duration) {
  const start = window.pageYOffset;
  const distance = target - start;
  let startTime = null;

  function animation(currentTime) {
    if (!startTime) startTime = currentTime;
    const timeElapsed = currentTime - startTime;

    const run = easeInOutQuad(timeElapsed, start, distance, duration);
    window.scrollTo(0, run);

    if (timeElapsed < duration) {
      requestAnimationFrame(animation);
    }
  }

  function easeInOutQuad(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  }

  requestAnimationFrame(animation);
}