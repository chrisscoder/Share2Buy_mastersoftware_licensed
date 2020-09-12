// based on http://codepen.io/garethdweaver/pen/eNpWBb
// Could also use: https://github.com/siddii/angular-timer/

'use strict';

module.exports = ['CountdownUtil', '$interval', function(CountdownUtil, $interval) {
  return {
    restrict: 'A',
    replace: true,
    scope: {
      date: '@',
      selectedPeriod: '@'
    },
    link: function(scope, element) {
      var promise;
      var enddate = new Date(scope.date).getTime();
      var selectedPeriod = parseInt(scope.selectedPeriod); // user selected
      var periodMs = daysToMs(selectedPeriod);
      var periodMm = daysMsToMm(periodMs);

      function daysToMs(days) {
        return days * 86400000;
      }

      function daysMsToMm(daysInMs) {
        return daysInMs / 1000;
      }

      function countDown() {
        var currentTime = new Date().getTime();
        var diff = Math.floor((enddate - currentTime) / 1000);

        if(diff > periodMm) {
          var diffUntilActive = Math.floor((enddate - (currentTime + periodMs)) / 1000);
          return element.html(CountdownUtil.dhms(diffUntilActive, scope.date, false));
        } else {
          if (diff <= 0) {
            // Stop countdown if diff is zero or smaller otherwise return countdown
            stopCountDown();
            return element.html(CountdownUtil.end(scope.date));
          } else  {
            return element.html(CountdownUtil.dhms(diff, scope.date, true));
          }
        }
      }

      // Set initial time before interval delay
      countDown();

      // Starts the countdown interval
      function startCountDown() {
        // store the interval promise
        promise = $interval(function() {
          countDown();
        }, 1000);
      }

      startCountDown();

      // stops the interval
      function stopCountDown() {
        if (angular.isDefined(promise)) {
          $interval.cancel(promise);
          promise = undefined;
        }
      }
      // stops the interval when the scope is destroyed,
      // this usually happens when a route is changed and
      // the ItemsController scope gets destroyed. The
      // destruction of the ItemsController scope does not
      // guarantee the stopping of any intervals, you must
      // be responsible of stopping it when the scope is
      // is destroyed.
      scope.$on('$destroy', function() {
        stopCountDown();
      });
    }
  };
}];
