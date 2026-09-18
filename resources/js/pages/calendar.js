import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

// Helper to transform boolean flag objects or standard configs into FullCalendar toolbar layouts
function parseToolbarOption(toolbarConfig) {
    if (!toolbarConfig) return undefined;
    if (typeof toolbarConfig === 'string') return toolbarConfig;
    if (toolbarConfig === false) return false;

    const { left, center, right, ...flags } = toolbarConfig;

    const enabledFlags = Object.keys(flags).filter(key => flags[key] === true);

    if (enabledFlags.length > 0) {
        const hasPrevYear = flags.prevYear === true;
        const hasNextYear = flags.nextYear === true;
        const extraFlags = enabledFlags.filter(key => key !== 'prevYear' && key !== 'nextYear');

        const dynamicLeft = [
            hasPrevYear ? 'prevYear' : null,
            'prev',
            'next',
            hasNextYear ? 'nextYear' : null,
            ...extraFlags,
            'today'
        ].filter(Boolean).join(',');

        return {
            left: left !== undefined ? left : dynamicLeft,
            center: center !== undefined ? center : 'title',
            right: right !== undefined ? right : 'dayGridMonth,timeGridWeek,timeGridDay'
        };
    }

    return {
        left: left !== undefined ? left : 'prev,next today',
        center: center !== undefined ? center : 'title',
        right: right !== undefined ? right : 'dayGridMonth,timeGridWeek,timeGridDay'
    };
}

export function createCalendar(target, customOptions = {}) {
    const el = typeof target === 'string' ? document.querySelector(target) : target;

    if (!el) return null;

    const { headerToolbar, footerToolbar, datesSet, ...restOptions } = customOptions;

    // Map button classes to human-readable titles
    const tooltipMap = {
        'fc-prev-button': 'Previous Month',
        'fc-next-button': 'Next Month',
        'fc-prevYear-button': 'Previous Year',
        'fc-nextYear-button': 'Next Year',
        'fc-today-button': 'Go to Today',
        'fc-dayGridMonth-button': 'Month View',
        'fc-timeGridWeek-button': 'Week View',
        'fc-timeGridDay-button': 'Day View',
    };

    // Helper to initialize Bootstrap Tooltips on FullCalendar buttons
    const initBootstrapTooltips = () => {
        Object.entries(tooltipMap).forEach(([className, text]) => {
            const button = el.querySelector(`.${className}`);
            if (button) {
                // Set required Bootstrap data attributes
                button.setAttribute('data-bs-toggle', 'tooltip');
                button.setAttribute('data-bs-title', text);

                // Initialize Bootstrap Tooltip instance if not already active
                if (window.bootstrap && window.bootstrap.Tooltip) {
                    if (!window.bootstrap.Tooltip.getInstance(button)) {
                        new window.bootstrap.Tooltip(button, {
                            container: 'body',
                            trigger: 'hover'
                        });
                    }
                }
            }
        });
    };

    const defaultOptions = {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        handleWindowResize: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }
    };

    const calendarOptions = {
        ...defaultOptions,
        ...restOptions,
        datesSet: function (info) {
            // Re-apply tooltips whenever view or dates change
            initBootstrapTooltips();
            if (typeof datesSet === 'function') {
                datesSet(info);
            }
        }
    };

    if (headerToolbar !== undefined) {
        calendarOptions.headerToolbar = parseToolbarOption(headerToolbar);
    }

    if (footerToolbar !== undefined) {
        calendarOptions.footerToolbar = parseToolbarOption(footerToolbar);
    }

    const calendar = new Calendar(el, calendarOptions);
    calendar.render();

    // Initial tooltip initialization
    initBootstrapTooltips();

    const observer = new ResizeObserver(() => {
        calendar.updateSize();
    });
    observer.observe(el);

    return calendar;
}

// Expose globally for inline Blade scripts
if (typeof window !== 'undefined') {
    window.createCalendar = createCalendar;
}
