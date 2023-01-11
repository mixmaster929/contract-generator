"use strict";


$("#form-container").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true,
    onFinished: function (event, currentIndex)
    {
        $('#wizardform').submit();
    }
});

$('.date').pickadate({
    format: 'yyyy-mm-dd'
});
