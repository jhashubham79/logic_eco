
// filter active 
const filterButtons = document.querySelectorAll('.filter-box button');

filterButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Remove active from all
    filterButtons.forEach(btn => btn.classList.remove('active'));
    // Add active to clicked one
    button.classList.add('active');
  });
});

//   filter cards 

const filterButton = document.querySelectorAll('.btn-filter'); // corrected variable name
const cards = document.querySelectorAll('.card-item');

filterButton.forEach(btn => {
  btn.addEventListener('click', () => {
    const filter = btn.getAttribute('data-filter');

    // Toggle active class
    filterButton.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Show/Hide cards
    cards.forEach(card => {
      const categoryList = card.getAttribute('data-category').split(' '); // handles multiple categories

      if (filter === 'all' || categoryList.includes(filter)) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  });
});



// nav

document.addEventListener('DOMContentLoaded', () => {
  if (window.innerWidth > 992) {
    document.querySelectorAll('.navbar .nav-item.dropdown').forEach(item => {
      item.addEventListener('mouseenter', () => {
        const link = item.querySelector('[data-bs-toggle="dropdown"]');
        if (link) {
          link.classList.add('show');
          link.nextElementSibling.classList.add('show');
        }
      });
      item.addEventListener('mouseleave', () => {
        const link = item.querySelector('[data-bs-toggle="dropdown"]');
        if (link) {
          link.classList.remove('show');
          link.nextElementSibling.classList.remove('show');
        }
      });
    });
  }
});












