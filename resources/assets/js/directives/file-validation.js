'use strict';

// filereader API
// https://jsfiddle.net/0GiS0/Yvgc2/
// http://stackoverflow.com/questions/17063000/ng-model-for-input-type-file
// http://stackoverflow.com/questions/33973097/displaying-a-selected-file-from-an-input-in-angularjs
module.exports = function() {
  return {
    require: 'ngModel',
    scope: '=',
    link: function(scope, el, attrs, ngModel) {
      //change event is fired when file is selected
      el.bind('change', function(img) {
        var reader = new FileReader();
        reader.onload = function(loadEvent) {
          // can be used to get base64 data
          // scope.$apply(function() {
          //   scope.fileread = loadEvent.target.result;
          // });

          var img = new Image();
          // img.onload = function() {
          //   console.log("The width of the image is " + img.width + "px.");
          //   console.log("The height of the image is " + img.height + "px.");
          // };
          img.src = reader.result;
        };
        reader.readAsDataURL(img.target.files[0]);

        scope.$apply(function() {
          ngModel.$setViewValue(el.val());
          ngModel.$render();
        });

      });
    }
  };
};
