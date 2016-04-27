jQuery( function($) {
    var $submenu = $('.xs.sub-menu');
    var header = {};
    header.isSubmenuOpen = function () {
        return $submenu.css('display') != 'none';
    };
    $('.xs .icon.right').click(function(){
        if ( header.isSubmenuOpen() ) $submenu.slideUp();
        else $submenu.slideDown();
    });
} );