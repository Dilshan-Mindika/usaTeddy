import './bootstrap';

import Swal from 'sweetalert2';

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    timer: 7500,
    timerProgressBar: true,
});

