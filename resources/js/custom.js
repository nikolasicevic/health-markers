$(document).ready(function(){
    // Animate main menu
    $('.hamburger').click(function(e){
        e.preventDefault();
        $('.nav-wrap').animate({
            left: "0"
        }, 300);
    });

    // Close main menu
    $('.exit').click(function(e){
        e.preventDefault();
        $('.nav-wrap').animate({
            left: "-100%"
        });
    });

    // Switch charts
    $('.stats-btn').click(function(e){
        e.preventDefault();

        var id = $(this).data('type');

        $('.stats-btn').removeClass('active');
        $(this).addClass('active');

        $('.stats').removeClass('stats-show');
        $('#' + id).addClass('stats-show');
    });
});
