/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
    $(function () {
        $('[data-toggle="tooltip"],.tooltip-show').tooltip({'placement': 'bottom'});
    });

    $(".del-item").submit(function (e) {
        e.preventDefault();
        $.confirm({
            title: 'Confirm?',
            content: 'Are you sure you want to delete this item?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: function () {
                    e.currentTarget.submit();
                },
                cancel: function () {}
            }
        });
    });

    $(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
    });

})(jQuery);
