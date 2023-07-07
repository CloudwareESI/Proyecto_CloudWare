const input = document.getElementById('myInput');
const label = document.getElementById('myLabel');

input.addEventListener('focus', () => {
  label.classList.add('active');
});

input.addEventListener('blur', () => {
  if (input.value === '') {
    label.classList.remove('active');
  }
});