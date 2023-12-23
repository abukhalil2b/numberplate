import './bootstrap';

import Alpine from 'alpinejs';

import plate from './lib/plate';

window.Alpine = Alpine;

Alpine.data("plate",plate);

Alpine.start();
