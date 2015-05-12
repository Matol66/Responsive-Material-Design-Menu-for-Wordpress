$(document).ready(function () {

    var timer = 300;
    $('.icon-menu').click(function(){
        $('.mobile-menu-toggle').velocity({left:0}, timer);
        console.log('xxx');
    });

    $('.close-menu').click(function () {
        $('.mobile-menu-toggle').velocity({left:'-100%'}, timer);
    });

    $('.q-action').eq(1).addClass('middle');
});
