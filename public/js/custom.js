document.addEventListener('DOMContentLoaded', function () {
    const markAllButton = document.getElementById('mark-all-read');
    if (!markAllButton) {
        return;
    }

    markAllButton.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }
        )
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to mark notifications as read.');
                }
                return response.json();
            }).then(data => {
            if (!data.success) {
                return;
            }
            // Remove notification count.
            const count = document.getElementById('notification-count');
            if (count) {
                count.remove();
            }
            // Remove unread background.
            document.querySelectorAll('.notification-item.bg-light')
                .forEach(item => {
                    item.classList.remove('bg-light');
                });
            // Remove unread dots.
            document.querySelectorAll('.notification-unread-dot')
                .forEach(dot => {
                    dot.remove();
                });
            // Remove button.
            markAllButton.remove();
        })
            .catch(error => {
                console.error('Notification error:', error);
            });
    });
});

$(document).ready(function () {

    $('.custom-pop-up-add-edit-modal').on('click', function () {
        const button = $(this);
        const section = button.attr('data-bs-section');
        const primaryId = button.attr('data-bs-primary-id');
        const mode = button.attr('data-bs-mode');

        const modal = $('#addEditModalPopup');

        // Reset modal
        modal.find('.modal-generic-title').text('Loading...');

        modal.find('.modal-generic-body').html(`
            <div class="text-center py-5">
                <div class="spinner-border" role="status"></div>
                <div class="mt-2">Loading...</div>
            </div>
        `);

        $.ajax({
            url: '/show-modal-popup/add-edit',
            type: 'GET',

            data: {
                section: section,
                primary_id: primaryId,
                mode: mode
            },

            success: function (response) {
                if (response.data !== null && response.secondary_data !== null) {
                    modal.find('.modal-generic-title')
                        .text(response.secondary_data);

                    modal.find('.modal-generic-body')
                        .html(response.data);

                } else {
                    modal.find('.modal-generic-title')
                        .text('Error');

                    modal.find('.modal-generic-body')
                        .html(`
                            <div class="alert alert-warning">
                                View not found.
                            </div>
                        `);
                }
                initBootstrapComponents(modal.find('.modal-generic-body')[0]);
            },

            error: function (xhr) {
                console.error(xhr.responseText);

                modal.find('.modal-generic-title')
                    .text('Error');

                modal.find('.modal-generic-body')
                    .html(`
                        <div class="alert alert-danger">
                            Unable to load content.
                        </div>
                    `);
            }
        });
    });

    $('.custom-pop-up-view-modal').on('click', function () {
        const button = $(this);
        const section = button.attr('data-bs-section');
        const primaryId = button.attr('data-bs-primary-id');
        const mode = button.attr('data-bs-mode');

        const modal = $('#viewModalPopup');

        // Reset modal
        modal.find('.modal-generic-title').text('Loading...');

        modal.find('.modal-generic-body').html(`
            <div class="text-center py-5">
                <div class="spinner-border" role="status"></div>
                <div class="mt-2">Loading...</div>
            </div>
        `);

        $.ajax({
            url: '/show-modal-popup/view',
            type: 'GET',

            data: {
                section: section,
                primary_id: primaryId,
                mode: mode
            },

            success: function (response) {
                if (response.data !== null && response.secondary_data !== null) {
                    modal.find('.modal-generic-title')
                        .text(response.secondary_data);

                    modal.find('.modal-generic-body')
                        .html(response.data);

                } else {
                    modal.find('.modal-generic-title')
                        .text('Error');

                    modal.find('.modal-generic-body')
                        .html(`
                            <div class="alert alert-warning">
                                View not found.
                            </div>
                        `);
                }
                initBootstrapComponents(modal.find('.modal-generic-body')[0]);
            },

            error: function (xhr) {
                console.error(xhr.responseText);

                modal.find('.modal-generic-title')
                    .text('Error');

                modal.find('.modal-generic-body')
                    .html(`
                        <div class="alert alert-danger">
                            Unable to load content.
                        </div>
                    `);
            }
        });
    });
});
