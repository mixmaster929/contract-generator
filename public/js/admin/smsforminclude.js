"use strict";

$(".send").on('change',function(){
    $("#dateBox").toggle();
});

$('#all_candidates').on('click',function(){
    $('#categoryBox').toggle();
});


//$('.select2').select2();


$('.date').pickadate({
    format: 'yyyy-mm-dd'
});
