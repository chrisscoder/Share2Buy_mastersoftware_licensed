'use strict';

module.exports = function() {
  return {
    dhms: function(t, date, active) {
      var enddate = date;
      var days, hours, minutes, seconds;
      var time, display;
      var pre = '';
      var post = '';

      days = Math.floor(t / 86400);
      t -= days * 86400;
      hours = Math.floor(t / 3600) % 24;
      t -= hours * 3600;
      minutes = Math.floor(t / 60) % 60;
      t -= minutes * 60;
      seconds = t % 60;

      if (days < 1 && hours > 0 && minutes >= 0 && seconds >= 0) {
        time = hours;
        if (hours > 1) {
          display = 'hours';
        } else {
          display = 'hour';
        }
      } else if (days == 0 && hours == 0 && minutes > 0 && seconds >= 0) {
        time = minutes;
        display = 'min';
      } else if (days == 0 && hours == 0 && minutes == 0 && seconds >= 0) {
        time = seconds;
        display = 'sec';
      } else {
        time = days;
        if (days > 1) {
          display = 'days';
        } else {
          display = 'day';
        }

      }
      if (!active) {
        pre = 'Starts in ';
      } else {
        post = ' left';
      }

      return [
        '<time datetime="' + enddate + '">',
        '<span class="countdown-time">' + pre + time + '<span class="count-type"> ' + display + post +'</span></span>',
        '</time>'
      ].join(' ');

    },
    end: function(date) {
      var enddate = date;
      return [
        '<time datetime="' + enddate + '"><span class="sr-only">Campaign ended</span></time>'
      ].join(' ');
    }
  };
};
