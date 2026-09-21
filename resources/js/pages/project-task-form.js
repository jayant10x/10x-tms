(function () {
    function initTaskForm(container = document) {
        // ==========================================
        // Flatpickr
        // ==========================================

        if (typeof window.initFlatpickr === 'function') {
            let dates = [];
            if (
                container.nodeType === Node.ELEMENT_NODE &&
                container.matches &&
                container.matches('#start_date, #due_date')
            ) {
                dates.push(container);
            }

            if (container.querySelectorAll) {
                dates = dates.concat(
                    Array.from(
                        container.querySelectorAll(
                            '#start_date, #due_date'
                        )
                    )
                );
            }

            dates.forEach(function (element) {
                if (element._flatpickr) {
                    return;
                }
                window.initFlatpickr(element, {
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'Y-m-d',
                    onChange: function (selectedDates, dateStr, instance) {
                        $(instance.element).valid(); // Force validate on selection
                    },
                    onClose: function (selectedDates, dateStr, instance) {
                        $(instance.element).valid(); // Force validate when picker closes
                    },
                    onReady: function (selectedDates, dateStr, instance) {
                        // Ensure the visible alt input triggers validation on keyup/clear
                        $(instance.altInput).on('blur keyup', function () {
                            $(instance.element).valid();
                        });
                    }
                });
            });
        }
    }

    window.initTaskForm = initTaskForm;

    // ==========================================
    // Initial page
    // ==========================================
    initTaskForm();
    // ==========================================
    // Watch AJAX inserted HTML
    // ==========================================

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                if (node.nodeType !== Node.ELEMENT_NODE) {
                    return;
                }
                initTaskForm(node);
            });
        });
    });
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
})();
