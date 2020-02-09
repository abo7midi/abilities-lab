
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