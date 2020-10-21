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
                cancel: function () {
                }
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

    $('.event').on('show.bs.modal', function (e) {
        //get data-id attribute of the clicked element
        let day = $(e.relatedTarget).data('day');
        $(this).find(".pName").text(day)
        //$(".confirmAdd #pName").text(day);
        /* var productName = $(e.relatedTarget).data('product_name');

         $("#delForm").attr('action', 'put your action here with productId');//e.g. 'domainname/products/' + productId*/
    });

    $(document).on('click', '.income-add', function (event) {
        event.preventDefault();
        let href = $(this).data('url');
        let day = $(this).data('day');
        let month = $(this).data('month');
        let target = $(this).data('target');
        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            success: function (result) {
                $(target).modal("show");
                $(target + ' .modal-body').html(result).show();
            },
            complete: function () {
                $('#loader').hide();
            },
            error: function (jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });

})(jQuery);

