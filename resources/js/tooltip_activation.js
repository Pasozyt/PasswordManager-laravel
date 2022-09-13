

function tooltipActivation(object) {
    // Aktywacja tooltips
    var tooltipTriggerList = [].slice.call(object.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
}

exports.tooltipActivation = tooltipActivation;