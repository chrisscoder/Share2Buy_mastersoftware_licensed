'use strict';

module.exports = ['$scope', function($scope) {
  $scope.toggle = function() {
    $scope.menuToggle = !$scope.menuToggle;
  };
}];
