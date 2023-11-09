function cambiarColores() {
    const elements = {
        h2: document.querySelectorAll('h2'),
        label: document.querySelectorAll('label'),
        form: document.querySelectorAll('form'),
        p: document.querySelectorAll('p'),
        h4: document.querySelectorAll('h4'),
        a: document.querySelectorAll('a'),
        button: document.querySelectorAll('button'),
    };

    const colors = {
        h2: '#E68E25',
        label: 'blue',
        form: 'green',
        p: '#E68E25',
        h4: 'purple',
        a: 'pink',
        button: 'cyan',
    };

    for (let element in elements) {
        elements[element].forEach((el) => {
            el.style.color = colors[element];
        });
    }

    document.body.style.backgroundColor = '#969696';
}

const boton = document.querySelector('.boton');

boton.addEventListener('click', cambiarColores);
