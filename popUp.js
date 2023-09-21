const abrir = document.getElementById('abrir');
const popUpContainer = document.getElementById('popUpContainer');
const cerrar = document.getElementById('cerrar');
const cerrar1 = document.getElementById('cerrar1');

abrir.addEventListener('click', () => {
    popUpContainer.classList.add('show');  
});

cerrar.addEventListener('click', () => {
    popUpContainer.classList.remove('show');
});

cerrar1.addEventListener('click', () => {
    popUpContainer.classList.remove('show');
});