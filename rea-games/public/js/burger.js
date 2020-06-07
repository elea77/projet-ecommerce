jQuery(function($){
$('.header__nav__wrapper').on('click', function (){
    $('.nav--responsive').addClass("is-open");
    $('.overlay').toggle();
    $('.header-nav-burger').addClass('is-animate');
    setTimeout(function() {
        $('.overlay').addClass('is-open');
    }, 100);
    $('body').addClass('overflow');
});
$('.overlay').on('click', function(){
    $('.nav--responsive').removeClass('is-open');
    $('.overlay').toggle();
    $('.overlay').removeClass('is-open');
    $('.header-nav-burger').removeClass('is-animate');
    $('body').removeClass('overflow');
})
})