$(document).ready(function() {
    $('a .add').click(function() {
        $('form .add').slideToggle('slow', function() {
        });
    });
    $('a .edit').click(function() {
        $('form .edit').slideToggle('slow', function() {
        });
    });
    $('a .signup').click(function() {
        $('form .signup').slideToggle('slow', function() {
        });
    });
    $('a .login').click(function() {
        $('form .login').slideToggle('slow', function() {
        });
    });
});