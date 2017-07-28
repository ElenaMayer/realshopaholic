$(document).ready(function () {
    "use strict";

    /* === pre-loader init === */
    $(window).load(function () {
        $('#st-preloader').fadeOut();
        $('.st-preloader-circle').delay(350).fadeOut('slow');
    });
    /* === Search === */
    $('.top-search a').click(function (e) {
        e.preventDefault();
        //when the notification icon is clicked open the menu
        $(this).toggleClass('active');
        $('.show-search').fadeToggle(function () {
            //then bind the close event to html so it closes when you mouse off it.
            $('html').bind('click', function () {
                $('.show-search').fadeOut(function () {
                    //once html has been clicked and the menu has closed, unbind the html click so nothing else has to lag up
                    $('html').unbind('click');
                });
                $('.top-search a').removeClass('active');
            });
            $('.show-search').bind('click', function (e) {

                e.stopPropagation();
            });
        });
    });

    /* === gallery image popup  === */
    $('.img-popup').magnificPopup({
        delegate: 'a',
        type: 'image',
        // other options
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',

        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, // don't forget to change the duration also in CSS
            opener: function (element) {
                return element.find('img');
            }
        }

    });
    /* === menu drop-down === */
    if (screen.width > 768) {
        $(".nav.navbar-nav .dropdown").mousemove(function () {
            $(".nav.navbar-nav .dropdown").removeClass("open");
            $(this).addClass("open");
        });
        $(".nav.navbar-nav .dropdown").mouseleave(function () {
            $(".nav.navbar-nav .dropdown").removeClass("open");
        })
    }

    /*--------------------------
     scrollUp
     ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

});

// Post page - send comment
$( "body" ).on("click", "#send-comment", function() {
    var e = $(this).parents('.leave-comment');
    if(e.find("#comment-field").val().length > 0) {
        e.find(".email-alert").hide();
        var comment = e.find("#comment-field").val();
        var parent_id = 0;
        if(e.hasClass('replay-area'))
            parent_id = e.attr("id");
        e.find("#comment-field").val('');
        $.ajax({
            url: '/ajax/addcomment',
            data: {
                post_id: e.attr("id"),
                comment: comment,
                parent_id: parent_id,
            },
            type: "POST",
            dataType: "html",
            success: function (data) {
                $('#comment-data').html(data);
                $(".new-comment" ).css({ background: '#ffb5b3' });
                $(".new-comment" ).animate({ backgroundColor: '#fff' }, 'slow');
            }
        });
    } else {
        e.find(".email-alert").show();
    }
});

// Post page - show replay form
$( "body" ).on("click", "#replay-btn", function() {
    if(!$(this).hasClass("disabled")){
        var e = $(this).parents('.single-comment');
        $( ".replay-area" ).remove();
        createReplayForm(e);
        $('body').animate({
            scrollTop: e.offset().top
        }, 2000);
    } else {
        console.log($(this).parent());
        $(this).parents(".media-heading").find(".comment-ignoring__popup").show('slow');
    }
});

function createReplayForm(e) {
    var div1 = $("<div></div>").addClass("leave-comment").addClass("replay-area").css("display", "none").attr("id", e.attr("id"));
    var form = $("<form></form>").addClass("form-horizontal").addClass("contact-form");
    div1.append(form);
    var div2 = $("<div></div>").addClass("form-group");
    form.append(div2);
    var div3 = $("<div></div>").addClass("col-md-12");
    div2.append(div3);
    var textarea = "<textarea id=\"comment-field\" class=\"form-control\" rows=\"2\" name=\"message\" placeholder=\"Введите текст сообщения\"></textarea>"
    div3.append(textarea);
    var button = "<button id=\"send-comment\" type=\"button\" class=\"btn send-btn\">Комментировать</button>";
    div2.after(button);
    var p = "<p class=\"email-alert\" style=\"display: none\">Введите сообщение.</p>";
    form.after(p);

    e.after(div1);
    div1.show('slow');
}

// Sidebar - save subscription
$( "#subscribe-form" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
        url: '/ajax/addsubscription',
        data: {
            email: $("#subscribe-email").val(),
        },
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#subscribe-form').remove();
            $(".news-letter p").text(data);
        }
    });
});