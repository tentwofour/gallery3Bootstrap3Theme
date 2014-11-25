$(document).ready(function () {

    // TWBS 3-level nav addition
    $('.dropdown-toggle', '.dropdown-menu').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();

        // Close any open menus on this level
        var $this = $(this);
        $this.parent('li').siblings('li').removeClass('open');

        // opening the one you clicked on
        $this.parent().addClass('open');

        // Find menu that's being opened, and adjust position
        var menu = $this.siblings('ul').first();
        var menupos = $(menu).offset();

        if (menupos.left + menu.width() > $(window).width()) {
            var newpos = -$(menu).width();
            menu.css({left: newpos});
        }
        else {
            var newpos = $this.parent().width();
            menu.css({left: newpos});
        }
    });

    // Pagination tooltips to show images on hover
    $('[data-toggle="tooltip"]').tooltip();

});