import * as $ from 'jquery';
import Swal from 'sweetalert2';

export default (function () {
    window.Swal = Swal

    $(document).on('click', "form.delete button", function(e) {
        var _this = $(this);
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'هل انت متاكد?', // Opération Dangereuse
            text: 'هل أنت متأكد من الاستمرار ?', // Êtes-vous sûr de continuer ?
            showCancelButton: true,
            confirmButtonColor: 'null',
            cancelButtonColor: 'null',
            confirmButtonText: 'نعم!', // Oui, sûr
            cancelButtonText: 'الغاء', // Annuler
            customClass: {
                confirmButton: 'btn btn-lg btn-danger mx-1',
                cancelButton: 'btn btn-lg btn-primary mx-1'
            },
            buttonsStyling: false
        }).then(res => {
            if (res.value) {
                _this.closest("form").submit();
            }
        });
    });
}())
