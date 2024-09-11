import Alpine from 'alpinejs';
import { initFlowbite } from 'flowbite';

window.Alpine = Alpine;

Alpine.start();

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}


initFlowbite({

})