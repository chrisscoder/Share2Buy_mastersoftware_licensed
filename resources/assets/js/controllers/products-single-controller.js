'use strict';

module.exports = ['$scope', '$location', '$http', function($scope, $location, $http) {

  // ---------------------------------------
  // ---- Increment/decrement product amount
  // ---------------------------------------
  $scope.currentCount = 1;
  $scope.increment = function(orderCount) {
    if ($scope.currentCount < (10 - orderCount))
      $scope.currentCount++;
  };

  $scope.decrement = function() {
    if ($scope.currentCount > 1)
      $scope.currentCount--;
  };

  /**
   * Calc continious percentage based on order quantity and vars set by the designer
   * @param  {float} orderQuantity        [description]
   * @param  {Number} [productQuantity=10] [description]
   * @param  {Number} [pctBase=15]         [description]
   * @param  {Number} [pctFinal=35]        [description]
   * @return {float}                      [description]
   */
  function currentPct(orderQuantity, productQuantity = 10, pctBase = 15, pctFinal = 35) {

    var pct = pctBase;
    var prevPct = pctBase;
    var pctDiff = pctFinal - pctBase;

    if (orderQuantity) {
      if (orderQuantity == 0) {
        pct = pctBase;
      } else if (orderQuantity != 0 && (orderQuantity <= productQuantity - 1)) {
        for (var i = 0; i < orderQuantity; i++) {
          pct = prevPct + (pctDiff / (productQuantity - 1));
          prevPct = pct;
        }
      } else {
        pct = pctFinal; //pct can't be greater than the final pct
      }
    }

    return pct;
  }

  /**
   * Calc commission
   * @param  {float} initialPrice
   * @param  {float} [commission=0.07]
   * @return {float}                   Returns the commission
   */
  function commission(initialPrice, commission = 0.07) {
    return initialPrice * commission;
  }

  /**
   * Calc price with discount
   * @param  {float} initialPrice [description]
   * @param  {float} pct          [description]
   * @return {float}              Returns the price
   */
  $scope.currentPrice = function(initialPrice, pct) {
    return initialPrice * (1 - (pct / 100));
  };

  /**
   * Calc price inc. commission
   * @param  {float} initialPrice [description]
   * @param  {float} pct          [description]
   * @return {float}              return price with commission
   */
  $scope.priceIncCommission = function(initialPrice, orderQuantity, productQuantity = 10, pctBase = 15, pctFinal = 35) {
    // console.log(currentPct(1, 10, 15, 35));

    return $scope.currentPrice(initialPrice, currentPct(orderQuantity, productQuantity, pctBase, pctFinal)) + commission(initialPrice);
  }

  /**
   * Calc discount
   * @param  {float} $initialPrice [description]
   * @param  {float} $currentPrice [description]
   * @return {float}               Return amount saved
   */
  $scope.discount = function(initialPrice, currentPrice) {
    return initialPrice - currentPrice;
  }

  // ---------------------------------------
  // ---- Submit form data to checkout
  // ---------------------------------------
  $scope.formData = {};

  var param = function serialize(obj, prefix) {
    var str = [];
    for (var p in obj) {
      if (obj.hasOwnProperty(p)) {
        var k = prefix ? prefix + "[" + p + "]" : p,
          v = obj[p];
        str.push(typeof v === "object" ? serialize(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
      }
    }
    return str.join("&");
  };

  $scope.submitForm = function() {
    if (this.order.$valid) {
      $http({
          method: 'POST',
          url: $location.protocol() + '://' + $location.host() + ':' + $location.port() + '/addToBasket',
          data: param($scope.formData), // pass in data as strings
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
          } // set the headers so angular passing info as form data (not request payload)
        })
        .then(function(data) {
          location.href = "/checkout"; // redirect to checkout
        });
    }

  };

}];
