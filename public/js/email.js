"use strict";

$(function(){

    $('.check:button').on('click',function(){
        var checked = !$(this).data('checked');
        $('#msg-list input:checkbox').prop('checked', checked);
        $(this).val(checked ? 'uncheck all' : 'check all' )
        $(this).data('checked', checked);
    });

    $("#checkBtn"),on('click',function () {
        console.log('checking');
        $("#member-form input:checkbox").prop('checked', $(this).prop("checked"));
    });
});
