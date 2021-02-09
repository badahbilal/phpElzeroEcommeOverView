$(function () {
    'use strict';


    $('.form-control').focus(function () {

        $(this).attr('data-text',$(this).attr('placeholder'));

        $(this).attr('placeholder','');
    }).blur(function () {

        $(this).attr('placeholder',$(this).attr('data-text'));

    });



    // Add Asterisk On Required Field

    $("input").each(function () {

        if($(this).attr('required') === 'required'){

            $(this).after("<span class='asterisk'>*</span>");
        }
    });
    
    
    
    // Show password
    
    
    var inputPass = $('.password');

    $('.showPass').click(function () {

        console.log( inputPass.attr('type'));
       if( inputPass.attr('type') == 'password')
       {
           $(this).removeClass("fas fa-eye").addClass("fas fa-low-vision");
           inputPass.attr("type",'text');
       }else{
           $(this).removeClass("fas fa-low-vision").addClass("fas fa-eye");
           inputPass.attr("type",'password');
       }
        
    });


    // confirmation of delete

    $(".confirm").click(function () {

        return confirm("Are you sure to deleted");
    })    ;


});