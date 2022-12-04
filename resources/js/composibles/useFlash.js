import Swal from "sweetalert2";

export function useFlash() {
    function flash(title, msg, level = 'success') {
        return Swal.fire(title, msg, level);
    }

    return { flash };
}
