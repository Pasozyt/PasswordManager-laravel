/**
 * export default - domyslnie ekportowany element pliku (modułu), może być tylko jedne na plik
 */

function registerConfirmAction() {
$('form[name=confirm-action]').on('submit', function(e) {
    e.preventDefault();
    const data = $(e.currentTarget).data();
    const message = !_.isNil(data.message) ? data.message : 'NO_MESSAGE_PROVIDED';
    const icon = !_.isNil(data.icon) ? data.icon : 'warning';
    const confirmText = !_.isNil(data.confirmText) ? data.confirmText : 'Yes';
    const confirmClass = !_.isNil(data.confirmClass) ? data.confirmClass : '';
    const cancelText = !_.isNil(data.cancelText) ? data.cancelText : 'No';    
    const cancelClass = !_.isNil(data.cancelClass) ? data.cancelClass : '';    

    Swal.mixin({
        customClass: {
            confirmButton: confirmClass,
            cancelButton: cancelClass
        },
        buttonsStyling: false
    }).fire({
        text: message,
        showCancelButton: true,
        confirmButtonText: confirmText,      
        cancelButtonText: cancelText,
        focusCancel: true,
        icon: icon
    }).then((result) => {
        if (result.value) {
            this.submit()
        }
    });
});
}

/**
 * ES6
 */
// export default registerConfirmAction;

/**
 * eksport modułu CommonJS
 */
exports.registerConfirmAction = registerConfirmAction;
