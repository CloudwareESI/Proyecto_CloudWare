document.addEventListener('DOMContentLoaded', function () {
    const carga1Element = document.querySelector('.carga1');
    const carga2Element = document.querySelector('.carga2');
    const carga3Element = document.querySelector('.carga3');
    const carga4Element = document.querySelector('.carga4');

   // Aplicar el estado al 100% para detener la animación
   carga1Element.classList.add('detener-animacion');


    // Configurar las animaciones iniciales
    carga2Element.style.animationPlayState = 'running';
    carga3Element.style.animationPlayState = 'paused';
    carga4Element.style.animationPlayState = 'paused';
});