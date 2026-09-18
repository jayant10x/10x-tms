<div class="row">
    <div class="col-md-12">
        <div class="mt-4 mt-lg-0">
            <div id="task-calendar"></div>
        </div>
    </div>
</div>

@vite(['resources/js/pages/calendar.js' ])

<script>
    document.addEventListener('DOMContentLoaded', function () {

        function initCalendars() {
            const rawCalendarTasks = @json($calendar_tasks);
            const formattedEvents = [];

            // Get local date string YYYY-MM-DD
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const todayStr = `${year}-${month}-${day}`;

            if (rawCalendarTasks && typeof rawCalendarTasks === 'object') {
                Object.entries(rawCalendarTasks).forEach(([dateKey, tasks]) => {
                    tasks.forEach(task => {
                        const dueDate = task.prt_due_date || dateKey;
                        const status = (task.prt_status || '').toLowerCase();
                        const isCompleted = status === 'completed' || status === 'done';
                        const isOverdue = dueDate < todayStr && !isCompleted;

                        formattedEvents.push({
                            id: task.prt_id,
                            title: task.prt_title,
                            start: task.prt_due_date || dateKey,
                            allDay: true,
                            extendedProps: {
                                prt_enc_id: task.prt_enc_id || task.prt_id_enc,
                                isOverdue: isOverdue,
                                category: task.prt_category,
                                priority: task.prt_priority,
                                status: task.prt_status,
                                estimatedHours: task.prt_est_hours,
                                description: task.prt_description,
                                tags: task.prt_tags,
                                project: task.project
                            }
                        });
                    });
                });
            }

            window.createCalendar('#task-calendar', {
                initialView: 'dayGridMonth',
                dayMaxEvents: 2,

                // moreLinkClassNames: ['custom-pop-up-view-modal'],

                moreLinkDidMount: function (info) {
                    // Extract date safely from info.date, info.allSegs, or parent DOM attribute
                    let formattedDate = '';

                    if (info.date) {
                        const dateObj = new Date(info.date);
                        const year = dateObj.getFullYear();
                        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                        const day = String(dateObj.getDate()).padStart(2, '0');
                        formattedDate = `${year}-${month}-${day}`;
                    } else if (info.allSegs && info.allSegs.length > 0) {
                        const dateObj = new Date(info.allSegs[0].footprint.start);
                        const year = dateObj.getFullYear();
                        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                        const day = String(dateObj.getDate()).padStart(2, '0');
                        formattedDate = `${year}-${month}-${day}`;
                    } else {
                        // Fallback: extract date directly from parent day cell DOM
                        const dayCell = info.el.closest('[data-date]');
                        if (dayCell) {
                            formattedDate = dayCell.getAttribute('data-date');
                        }
                    }
/*
                    info.el.setAttribute('data-section', 'view-date');
                    info.el.setAttribute('data-primary-id', formattedDate);*/
                },

                headerToolbar: {
                    prevYear: true,
                    nextYear: true,
                    left: 'prevYear,nextYear',
                    center: 'title',
                    right: 'prev,today,next'
                },
                events: formattedEvents,

                eventDidMount: function (info) {
                    const isOverdue = info.event.extendedProps.isOverdue;
                    const bgColor = isOverdue ? '#dc3545' : '#0d6efd';
                    const borderColor = isOverdue ? '#b02a37' : '#0a58ca';

                    info.el.style.setProperty('background-color', bgColor, 'important');
                    info.el.style.setProperty('border-color', borderColor, 'important');
                    info.el.style.setProperty('color', '#ffffff', 'important');

                    const mainEl = info.el.querySelector('.fc-event-main');
                    if (mainEl) {
                        mainEl.style.setProperty('color', '#ffffff', 'important');
                    }
                },

                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    const encTaskId = info.event.extendedProps.prt_enc_id;
                    if (encTaskId) {
                        let url = `/task/view/${encodeURIComponent(encTaskId)}`;
                        window.open(url, '_blank');
                    }
                }
            });
        }

        if (typeof window.createCalendar === 'function') {
            initCalendars();
        } else {
            window.addEventListener('load', initCalendars);
        }
    });
</script>
