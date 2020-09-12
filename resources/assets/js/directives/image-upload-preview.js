'use strict';

// filereader API
// https://jsfiddle.net/0GiS0/Yvgc2/
// http://stackoverflow.com/questions/17063000/ng-model-for-input-type-file
// http://stackoverflow.com/questions/33973097/displaying-a-selected-file-from-an-input-in-angularjs
// validate image size http://stackoverflow.com/questions/7460272/getting-image-dimensions-using-javascript-file-api
// https://scotch.io/tutorials/use-the-html5-file-api-to-work-with-files-locally-in-the-browser
// http://codepen.io/SpencerCooley/pen/JtiFL?editors=1010
module.exports = function() {
  return {
    replace: true,
    restrict: 'E',
    // require: '?ngModel',
    scope: {
      formName: '@',
      inputName: '@',
      label: '@',
      uploadText: '@',
      helpText: '@',
      aspectRatio: '@',
      initImage: '@',
      maxSize: '@',
      minWidth: '@',
      minHeight: '@',
      required: '@',
    },
    templateUrl: '/partials/image-upload-preview/image-upload-preview.html',
    link: function(scope, el, attrs, ngModelCtrl) {

      //change event is fired when file is selected
      el.bind('change', function(img) {

        var reader = new FileReader();

        reader.onload = function(loadEvent) {

          // var image = new Image();
          //
          // // Get image width and heigth for validation
          // image.onload = function() {
          //   console.log("The width of the image is " + image.width + "px.");
          //   console.log("The height of the image is " + image.height + "px.");
          // }

          // Get base64 data for preview use
          scope.$apply(function(){
            scope.imagePrev = loadEvent.target.result;
          });
        };

        reader.readAsDataURL(img.target.files[0]);
        // console.log(img.target.files[0]);


      });
    }
  };
};
