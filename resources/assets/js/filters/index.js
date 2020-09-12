'use strict';
var app = require('angular').module('app');

app.filter('replaceFilePath', require('./replace-filepath'));
