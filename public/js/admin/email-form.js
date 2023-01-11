"use strict";
$('textarea#message').summernote({
    height: 300
});

$(".send").on('change',function(){
    $("#dateBox").toggle();
});

$('#attachCheckbox').on('click',function(){
    $("#invoiceFields").toggle();
});

$('.select2').select2();

$('.date').pickadate({
    format: 'yyyy-mm-dd'
});
