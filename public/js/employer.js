"use strict";
$(function(){
    'use strict'

    $('.az-sidebar .with-sub').on('click', function(e){
        e.preventDefault();
        $(this).parent().toggleClass('show');
        $(this).parent().siblings().removeClass('show');
    })

    $(document).on('click touchstart', function(e){
        e.stopPropagation();

        // closing of sidebar menu when clicking outside of it
        if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
                $('body').removeClass('az-sidebar-show');
            }
        }
    });


    $('#azSidebarToggle').on('click', function(e){
        e.preventDefault();

        if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
        } else {
            $('body').toggleClass('az-sidebar-show');
        }
    })

    /* ----------------------------------- */
    /* Dashboard content */

    $('#compositeline').sparkline('html', {
        lineColor: '#cecece',
        lineWidth: 2,
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        highlightSpotColor: null,
        highlightLineColor: null,
        fillColor: '#f9f9f9',
        chartRangeMin: 0,
        chartRangeMax: 10,
        width: '100%',
        height: 20,
        disableTooltips: true
    });

    $('#compositeline2').sparkline('html', {
        lineColor: '#cecece',
        lineWidth: 2,
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        highlightSpotColor: null,
        highlightLineColor: null,
        fillColor: '#f9f9f9',
        chartRangeMin: 0,
        chartRangeMax: 10,
        width: '100%',
        height: 20,
        disableTooltips: true
    });

    $('#compositeline3').sparkline('html', {
        lineColor: '#cecece',
        lineWidth: 2,
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        highlightSpotColor: null,
        highlightLineColor: null,
        fillColor: '#f9f9f9',
        chartRangeMin: 0,
        chartRangeMax: 10,
        width: '100%',
        height: 20,
        disableTooltips: true
    });

    $('#compositeline4').sparkline('html', {
        lineColor: '#cecece',
        lineWidth: 2,
        spotColor: false,
        minSpotColor: false,
        maxSpotColor: false,
        highlightSpotColor: null,
        highlightLineColor: null,
        fillColor: '#f9f9f9',
        chartRangeMin: 0,
        chartRangeMax: 10,
        width: '100%',
        height: 20,
        disableTooltips: true
    });



});
