import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
$('.date').datepicker({
    uiLibrary: 'bootstrap5',
    format: 'yyyy-dd-mm'
});
