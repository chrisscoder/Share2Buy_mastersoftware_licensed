'use strict';

module.exports = function() {
  return function(obj) {
    if (obj !== null)
      return obj.replace(/^C:\\fakepath\\/, "");
    else
      return obj;
    // fileName = e.target.value.split( '\\' ).pop();
  };
};
