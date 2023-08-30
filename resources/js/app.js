import './bootstrap';

import Alpine from 'alpinejs';

import numbercodes from './lib/numbercodes';

import plate from './lib/plate';

import extraJob from './lib/extra_job';

window.Alpine = Alpine;

Alpine.data("numbercodes",numbercodes);

Alpine.data("plate",plate);

Alpine.data("extraJob",extraJob);

Alpine.start();
