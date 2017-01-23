require('../bootstrap');
require('awesomplete');

var input = document.getElementById('search-input');

$('document').ready(function(){
    $('#search-input').on('keyup', function(e) {
        e.preventDefault();
        var inputValue = $(this).val();
        var ajaxUrl = $(this).data('url');
        $.post(
            ajaxUrl,
            {
                key: inputValue
            },
            function (response) {
                console.log(response);
            }
        );
    })
});

new Awesomplete(input);
