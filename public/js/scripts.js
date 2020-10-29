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

    /*
    * Add a nice tooltips for an element with a class tooltip-show or with attribute data-toggle=tooltip
    * */
    $(function () {
        $('[data-toggle="tooltip"],.tooltip-show').tooltip({'placement': 'bottom'});
    });

    /*
    * Delete confirmation
    * When we submit a form with a class, we check if we want to delete the element exactly
    * */
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
                cancel: function () {
                }
            }
        });
    });

    /*
    * Open modal windows after click by class, and add ajax result to modal body
    * Show the preloader before sending the ajax request, then hide it
    * */
    $(document).on('click', '.event-add, .event-list', function (event) {
        event.preventDefault();
        let href = $(this).data('url');
        let date = $(this).data('date');
        let target = $(this).data('target');
        let info = $(this).data('info');
        $.ajax({
            type: "GET",
            url: href,
            data: {date: date},
            dataType: "json",
            beforeSend: function () {
                $('.loader').show();
            },
            success: function (result) {
                $(target + ' .modal-body').html(result.html).show();
                $(target + ' .modal-title').html(info).show();
                $(target + ' .modal-body .datepicker').val(date);
                $('.tooltip-show').tooltip({'placement': 'bottom'});
            },
            complete: function () {
                $('.loader').hide();
            },
            error: function (jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('.loader').hide();
            },
            timeout: 8000
        })
    });
})(jQuery);

