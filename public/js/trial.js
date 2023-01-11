"use strict";
$(function(){
    $('select').select2();
});

function toogleOptions(){

    if($('#trial_enabled').val()=='1'){
        $('.options').show();
        $('.options select,.options input').attr('required','required');
        console.log('not free');
    }
    else{
        $('.options').hide();
        $('.options select,.options input').removeAttr('required');
        console.log('is free');
    }
}

$(function(){
    toogleOptions();
    $('#trial_enabled').on('change',function(){
        toogleOptions();
    });
})
