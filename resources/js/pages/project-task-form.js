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
                    dateFormat: 'Y-m-d'
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
