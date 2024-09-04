import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
