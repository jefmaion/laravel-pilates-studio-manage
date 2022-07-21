import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import bootstrapPlugin from '@fullcalendar/bootstrap';

(function (global) {
    global.FullCalendar = {
      Calendar: function (elt, options) {
        return new Calendar(elt, Object.assign({
          plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, bootstrapPlugin ],
          locales: allLocales,
        }, options))
      }
    }
  })(window)