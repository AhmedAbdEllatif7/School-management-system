<div>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
    </div>
</div>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');
            var data = @this.events;
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
                dateClick(info) {
                    var title = prompt('Enter Event Title');
                    var date = new Date(info.dateStr + 'T00:00:00');
                    if (title != null && title != '') {
                        calendar.addEvent({
                            title: title,
                            start: date,
                            allDay: true
                        });
                        var eventAdd = { title: title, start: date };
                    @this.emit('eventAdded', eventAdd);
                        alert('Great. Now, update your database...');
                    } else {
                        alert('Event Title Is Required');
                    }
                },
                eventDrop(info) {
                    var eventUpdate = { id: info.event.id, start: info.event.start.toISOString() };
                @this.emit('eventDropped', eventUpdate);
                    alert('Great. Now, update your database...');
                },
                eventClick(info) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        info.event.remove();
                    @this.emit('eventDeleted', info.event.id);
                    }
                },
                editable: true, // Enable event dragging
                eventResizableFromStart: true, // Enable event resizing from the start
                eventDurationEditable: true, // Enable event duration editing when dragged
                // Rest of your options...
            });
            calendar.render();

        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents();
        });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
