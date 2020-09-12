'use strict';

module.exports = function() {
  return {
    require: 'ngModel',
    link: function (scope, element, attrs, ngModelCtrl) {
      // http://jsfiddle.net/bZGcg/1/
      var maxlength = Number(attrs.customMaxlength);
      function userInput(text) {
          ngModelCtrl.$setValidity('textLengthError', text.length <= maxlength);
          return text;
      }
      ngModelCtrl.$parsers.push(userInput);
    }
  };
};
