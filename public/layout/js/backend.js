
$(function(){
    'use strict';

    // Dashboard

    $('.main_cat').click(function () {

        $('.categories').prop('disabled', true);
    });

    $('.sub_cat').click(function () {
        $('.categories').prop('disabled', false);
    });



    $('.toggle-info').click(function () {

        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

        if($(this).hasClass('selected')) {

            $(this).html('<i class="fa fa-plus fa-lg"></i>');

        } else {

            $(this).html('<i class="fa fa-minus fa-lg"></i>');

        }
    });

    //Hide Placeholder On Form Focus

    $('[placeholder]').focus(function () {

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function () {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });

    //  Add Asterisk On Required Field
    $('input').each(function () {

        if($(this).attr('required') === 'required'){
            $(this).after("<span class='asterisk'>*</span>");
        }

    });

    // Convert Password Field To Text Field On Hover

    $('.show-pass').hover(function () {
        $('.password').attr('type','text');
    }, function () {
        $('.password').attr('type','password');
    });

    $('.b').hover(function () {
        $('.b').css('background-color','#ffffff');
        $('.nav-item').css('color','#44b7b9');
    }, function () {
        $('.b').css('background-color','#44b7b9');
        $('.nav-item').css('color','#ffffff');
    });

    $('.n1').hover(function () {
        $('.n1').css('background-color','#ffffff');
        $('.nav-item1').css('color','#44b7b9');
    }, function () {
        $('.n1').css('background-color','#44b7b9');
        $('.nav-item1').css('color','#ffffff');
    });

    $('.n2').hover(function () {
        $('.n2').css('background-color','#ffffff');
        $('.nav-item2').css('color','#44b7b9');
    }, function () {
        $('.n2').css('background-color','#44b7b9');
        $('.nav-item2').css('color','#ffffff');
    });

    $('.n3').hover(function () {
        $('.n3').css('background-color','#ffffff');
        $('.nav-item3').css('color','#44b7b9');
    }, function () {
        $('.n3').css('background-color','#44b7b9');
        $('.nav-item3').css('color','#ffffff');
    });

    $('.n4').hover(function () {
        $('.n4').css('background-color','#ffffff');
        $('.nav-item4').css('color','#44b7b9');
    }, function () {
        $('.n4').css('background-color','#44b7b9');
        $('.nav-item4').css('color','#ffffff');
    });

    $('.n5').hover(function () {
        $('.n5').css('background-color','#ffffff');
        $('.nav-item5').css('color','#44b7b9');
    }, function () {
        $('.n5').css('background-color','#44b7b9');
        $('.nav-item5').css('color','#ffffff');
    });

    $('.n6').hover(function () {
        $('.n6').css('background-color','#ffffff');
        $('.nav-item6').css('color','#44b7b9');
    }, function () {
        $('.n6').css('background-color','#44b7b9');
        $('.nav-item6').css('color','#ffffff');
    });

    $('.n7').hover(function () {
        $('.n7').css('background-color','#ffffff');
        $('.nav-item7').css('color','#44b7b9');
    }, function () {
        $('.n7').css('background-color','#44b7b9');
        $('.nav-item7').css('color','#ffffff');
    });

    $('.n8').hover(function () {
        $('.n8').css('background-color','#ffffff');
        $('.nav-item8').css('color','#44b7b9');
    }, function () {
        $('.n8').css('background-color','#44b7b9');
        $('.nav-item8').css('color','#ffffff');
    });

    $('.dropdown').hover(function () {
        $('.dropdown').css('background-color','#ffffff');
        $('.nav-link').css('color','#44b7b9');
    }, function () {
        $('.dropdown').css('background-color','#44b7b9');
        $('.nav-link').css('color','#ffffff');
    });

    $('.d1').hover(function () {
        $('.d1').css('background-color','#ffffff');
        $('.da1').css('color','#44b7b9');
    }, function () {
        $('.d1').css('background-color','#44b7b9');
        $('.da1').css('color','#ffffff');
    });

    $('.d2').hover(function () {
        $('.d2').css('background-color','#ffffff');
        $('.da2').css('color','#44b7b9');
    }, function () {
        $('.d2').css('background-color','#44b7b9');
        $('.da2').css('color','#ffffff');
    });

    $('.d3').hover(function () {
        $('.d3').css('background-color','#ffffff');
        $('.da3').css('color','#44b7b9');
    }, function () {
        $('.d3').css('background-color','#44b7b9');
        $('.da3').css('color','#ffffff');
    });




    // Confirmation Message On Button

    $('.trash').click(function () {
       return confirm('Are You Sure You Want To Delete This Member ?');
    });

    $('.non-active').click(function () {
        return confirm('Are You Sure You Want To Activate This Member ?');
    });

    $('.actived').click(function () {
        return confirm('Are You Sure You Want To NonActivate This Member ?');
    });

    $('.cat-trash').click(function () {
        return confirm('Are You Sure You Want To Delete This Category ?');
    });

    $('.cat-non-active').click(function () {
        return confirm('Are You Sure You Want To Activate This Category ?');
    });

    $('.cat-actived').click(function () {
        return confirm('Are You Sure You Want To NonActivate This Category ?');
    });




    // Category Show Option
    $(".cat h3").click(function(){
           $(this).next('.full-view').fadeToggle(300);
    });

    $(".option span").click(function () {
        $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data('view') === 'full'){
            $('.cat .full-view').fadeIn();
        } else {
            $('.cat .full-view').fadeOut()
        }
    });

    ///////////////////////////////////////////////////////////

    $(".preview").click(function(){
        $("#upload").click();
    });

    $("#upload").change(function(){
        preview(this);
    });

    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    ///////////////////////////////////////////////////////////

});

function getValueFromOptionToInput(element) {
    document.getElementById("cat-sub").value = element;
}