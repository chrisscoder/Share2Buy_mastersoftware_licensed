'use strict';
var app = require('angular').module('app');

app.directive('shopModule', require('./shop-module'));
app.directive('countdown', require('./countdown'));
app.directive('validFile', require('./file-validation'));
app.directive('customMaxlength', require('./custom-max-length'));
app.directive('imgUploadPreview', require('./image-upload-preview'));
