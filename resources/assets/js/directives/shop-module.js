'use strict';

module.exports = function() {
  return {
    restrict: 'E',
    replace: true,
    scope: {
      moduleData: '=info',
      type: '@type'
    },
    controller: ['$scope', '$http', '$sce', '$location', function($scope, $http, $sce, $location) {

      // ---------------------------------------
      // ---- TODO implement Deactivate module if time is less than or equal to zero
      // ---------------------------------------
      $scope.isActive = function(today, orderCount) {
        var state = '';
        var maxOrders = 10;
        var diff = Math.floor((new Date(today).getTime() - new Date().getTime()) / 1000);

        if (diff > 0  ||  orderCount <= maxOrders) {
          state = 'active';
        } else  {
          state = 'inactive';
        }
        return state;
      };

    }],
    templateUrl: '/partials/shop-module/shop-module.html'
  };
};
