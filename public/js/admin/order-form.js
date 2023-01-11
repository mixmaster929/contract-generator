"use strict";

function toogleOptions(){

    if($('#auto_invoice').val()=='1'){
        $('#invoice-group').show();
        console.log('is select');
    }
    else{
        $('#invoice-group').hide();
        console.log('not select');
    }
}

$(function(){
    toogleOptions();
    $('#auto_invoice').on('change',function(){
        toogleOptions();
    });
})
