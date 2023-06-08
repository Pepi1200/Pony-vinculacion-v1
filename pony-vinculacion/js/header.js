//menuButton
const menuButton = document.getElementById('menuButton');
const sideBarContainer = document.getElementById('side');

menuButton.addEventListener('click', () => {
  menuButton.classList.toggle('active');
  sideBarContainer.classList.toggle('active');
});