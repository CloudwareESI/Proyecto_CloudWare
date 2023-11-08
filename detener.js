document.addEventListener('DOMContentLoaded', function () {
  const cargaElement = document.querySelector('.carga');
  
  if (typeof fechaEntrega !== 'undefined') {
      cargaElement.style.animationPlayState = 'paused';
  } 
});