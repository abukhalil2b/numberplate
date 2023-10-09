import './bootstrap';

import Alpine from 'alpinejs';

import numbercodes from './lib/numbercodes';

import plate from './lib/plate';

window.Alpine = Alpine;

Alpine.data("numbercodes",numbercodes);

Alpine.data("plate",plate);

Alpine.start();
