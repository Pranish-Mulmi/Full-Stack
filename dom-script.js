const menuButton = document.getElementById('menu-button');
const navLinks = document.getElementById('nav-links');
const scrollProgress = document.getElementById('scroll-progress');
const contactForm = document.getElementById('contact-form-id');
const msgDiv = document.getElementById('form-message');
const uiSound = document.getElementById('ui-sound');
const playSoundBtn = document.getElementById('play-sound');
const yearSpan = document.getElementById('year');

if (yearSpan) {
  yearSpan.textContent = new Date().getFullYear();
}

function toggleMenu() {
  navLinks.classList.toggle('open');
  const isExpanded = navLinks.classList.contains('open');
  menuButton.setAttribute('aria-expanded', String(isExpanded));
  menuButton.textContent = isExpanded ? '✕' : '☰';
}
menuButton.addEventListener('click', toggleMenu);

navLinks.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    if (navLinks.classList.contains('open')) toggleMenu();
  });
});

function updateScrollProgress() {
  const scrollTop = window.scrollY || document.documentElement.scrollTop;
  const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
  scrollProgress.style.width = `${progress}%`;
}
window.addEventListener('scroll', updateScrollProgress);
window.addEventListener('resize', updateScrollProgress);
updateScrollProgress();

playSoundBtn.addEventListener('click', () => {
  if (!uiSound) return;
  uiSound.currentTime = 0;
  uiSound.play().catch(() => {
  });
});

function isEmailValid(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  return re.test(String(email).toLowerCase());
}

function setError(id, message) {
  const el = document.getElementById(id);
  if (el) el.textContent = message || '';
}

if (contactForm) {
  contactForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    let hasError = false;

    if (!name) {
      setError('error-name', 'Please enter your name.');
      hasError = true;
    } else {
      setError('error-name', '');
    }

    if (!email) {
      setError('error-email', 'Please enter your email.');
      hasError = true;
    } else if (!isEmailValid(email)) {
      setError('error-email', 'Please enter a valid email address.');
      hasError = true;
    } else {
      setError('error-email', '');
    }

    if (!message) {
      setError('error-message', 'Please enter a message.');
      hasError = true;
    } else {
      setError('error-message', '');
    }

    if (hasError) {
      msgDiv.textContent = 'Please fix the errors above and try again.';
      msgDiv.style.color = '#ff7b7b';
      return;
    }

    msgDiv.textContent = 'Thank you for your message! I will be in touch shortly.';
    msgDiv.style.color = '#4ade80';
    contactForm.reset();
  });
}