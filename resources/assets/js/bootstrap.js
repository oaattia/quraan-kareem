window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

// for any post request sent through the page we bind the token
$(document).ajaxSend(function(elm, xhr, s){
    if (s.type == "POST") {
        xhr.setRequestHeader('x-csrf-token', $('input[name=_token]').val());
    }
});