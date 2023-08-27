import './bootstrap';

import Alpine from 'alpinejs';

import numbercodes from './numbercodes';

import size from './size';

window.Alpine = Alpine;

Alpine.data("numbercodes",numbercodes);

Alpine.data("size",size);

Alpine.start();
