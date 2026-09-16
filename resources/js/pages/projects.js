import $ from 'jquery';

if (called_from != 'view_project') {
    $(window).on('load', function () {
        if (typeof window.initFlatpickr === 'function') {
            window.initFlatpickr('#project_deadline', {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        }
    });
} else {
    $(document).ready(function () {
        function updateTaskProgress() {
            let percentage = total > 0 ? Math.round((completed / total) * 100) : 0;
            $('#task-completed').text(completed);
            $('#task-total').text(total);
            $('#task-percentage').text(percentage + '%');

            $('#task-progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage);
        }

        updateTaskProgress();
    });
}
