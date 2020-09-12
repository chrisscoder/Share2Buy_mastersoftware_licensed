'use strict';

module.exports = ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http) {
  $rootScope.isRouteLoading = false;
  $http.get('/json/products', {
    cache: true
  }).then(function(response) {
    $scope.status = response.status;
    $scope.products = response.data;

    loadLogic();

  }).finally(function() {
    $rootScope.isRouteLoading = true;
  });

  function loadLogic() {

    $scope.categoryFilter = {
      availableOptions: [{
        id: '0',
        value: '',
        name: 'All categories'
      }, {
        id: '1',
        value: 'lifestyle',
        name: 'Lifestyle'
      }, {
        id: '2',
        value: 'men',
        name: '– Men'
      }, {
        id: '3',
        value: 'women',
        name: '– Women'
      }, {
        id: '4',
        value: 'accessories',
        name: '– Accessories'
      }, {
        id: '5',
        value: 'jewelry',
        name: '– Jewelry'
      }, {
        id: '6',
        value: 'living',
        name: 'Living'
      }, {
        id: '7',
        value: 'furniture',
        name: '– Furniture'
      }, {
        id: '8',
        value: 'interior',
        name: '– Interior'
      }, {
        id: '9',
        value: 'graphic',
        name: '– Graphic'
      }, {
        id: '10',
        value: 'beauty',
        name: 'Beauty'
      }, {
        id: '11',
        value: 'makeup',
        name: '– Makeup'
      }, {
        id: '12',
        value: 'wellness',
        name: '– Wellness'
      }, {
        id: '13',
        value: 'kids',
        name: 'Kids'
      }, {
        id: '13',
        value: 'kids-living',
        name: '– Kids Living'
      }, {
        id: '13',
        value: 'kids-lifestyle',
        name: '– Kids Lifestyle'
      }],
      selectedOption: {
        id: '0',
        value: '',
        name: 'Choose category'
      }
    };
    $scope.productFilter = {
      availableOptions: [{
        id: '1',
        value: '-orderCount',
        name: 'Popular'
      }, {
        id: '2',
        value: '+enddate',
        name: 'Ending soon'
      }, {
        id: '3',
        value: '-enddate',
        name: 'New campaigns'
      }, {
        id: '6',
        value: '-priceIncCommission',
        name: 'Price (high to low)'
      }, {
        id: '7',
        value: '+priceIncCommission',
        name: 'Price (low to high)'
      }, {
        id: '8',
        value: '+title',
        name: 'Products (A to Z)'
      }, {
        id: '9',
        value: '-title',
        name: 'Products (Z to A)'
      }],
      selectedOption: {
        id: '1',
        value: '-orderCount',
        name: 'Popular'
      } //This sets the default value of the select in the ui
    };

    $scope.filterModelValue = '';
    // ---- filter list of category for selected category
    $scope.filterCategory = function(product) {
      if ($scope.categoryFilter.selectedOption.value === '') {
        $scope.filterModelValue = '';
        return true;
      } else if (product.category === $scope.categoryFilter.selectedOption.value) {
        $scope.filterModelValue = $scope.categoryFilter.selectedOption.value;
        return true;
      } else if (product.type === $scope.categoryFilter.selectedOption.value) {
        $scope.filterModelValue = $scope.categoryFilter.selectedOption.value;
        return true;
      } else {
        return false;
      }
    };

    $scope.$watch('filterModelValue', function(newValue, oldValue) {
      $scope.loadCount = 16;
      $scope.loadIncrement = $scope.products.length - $scope.loadCount; //load all
      $scope.filteredData = [];

      if (newValue === oldValue ||  newValue === '') {
        $scope.filteredData = $scope.products;
      }

      for (var i = 0; i < $scope.products.length; i++) {
        if ($scope.products[i].category === newValue) {
          $scope.filteredData.push($scope.products[i]);
        }
      }

      var increment = 0;
      $scope.loadMore = function() {
        var increment = $scope.loadCount + $scope.loadIncrement;
        $scope.loadCount = increment > $scope.filteredData.length ? $scope.filteredData.length : increment;
      };

      $scope.loadLimit = function() {
        return $scope.loadCount < $scope.filteredData.length;
      };
    });

  }
}];
