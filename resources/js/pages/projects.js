import $ from 'jquery';

$(window).on('load', function () {
    if (typeof window.initFlatpickr === 'function') {
        window.initFlatpickr('#project_deadline', {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    }
});
