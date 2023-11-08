// Obtén todos los botones de abrir y cerrar
document.addEventListener("DOMContentLoaded", function() {
    const botonesAbrir = document.querySelectorAll('.abrir');
    const botonesCerrar = document.querySelectorAll('.cerrar');
    const contenedorModales = document.querySelectorAll('.contenedorModal');
    
    // Función para abrir la ventana modal
    function abrirModal(index) {
        document.write(index);
        contenedorModales[index].classList.add('show');
    }
    
    // Función para cerrar la ventana modal
    function cerrarModal(index) {
        contenedorModales[index].classList.remove('show');
    }
    
    // Asignar eventos de apertura
    botonesAbrir.forEach((boton, index) => {
        boton.addEventListener('click', () => abrirModal(index));
    });
    
    // Asignar eventos de cierre
    botonesCerrar.forEach((boton, index) => {
        boton.addEventListener('click', () => cerrarModal(index));
    });});
    
    