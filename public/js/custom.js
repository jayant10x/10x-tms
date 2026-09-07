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

    .
        then(response => {

            if (!response.ok) {
                throw new Error('Failed to mark notifications as read.');
            }

            return response.json();

        })

            .then(data => {

                if (!data.success) {
                    return;
                }

                // Remove notification count.
                const count = document.getElementById('notification-count');

                if (count) {
                    count.remove();
                }

                // Remove unread background.
                document
                    .querySelectorAll('.notification-item.bg-light')
                    .forEach(item => {
                        item.classList.remove('bg-light');
                    });

                // Remove unread dots.
                document
                    .querySelectorAll('.notification-unread-dot')
                    .forEach(dot => {
                        dot.remove();
                    });

                // Remove button.
                markAllButton.remove();

            })

            .catch(error => {

                console.error(
                    'Notification error:',
                    error
                );

            });

    });

});
