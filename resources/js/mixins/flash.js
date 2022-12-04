import Swal from 'sweetalert2';

function flash(msg) {
    return Swal.fire('Success!', msg, 'success');
}
