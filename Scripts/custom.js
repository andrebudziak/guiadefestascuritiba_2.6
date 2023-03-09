$( document ).ready(function() {
$('.menu-item').hover(function () {
    $('#active', this).toggleClass('active');
    $('#active', this).css({'display':'block'}); //adds context
});
});