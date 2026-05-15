import './bootstrap';

// Importar Alpine.js
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

// Registrar el plugin Intersect para animaciones on-scroll
Alpine.plugin(intersect);

// Iniciar Alpine
window.Alpine = Alpine;
Alpine.start();

console.log('Alpine.js iniciado correctamente');