/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$('#toggleNavPosition').click(function () {
    $('body').toggleClass('fixed-nav');
    $('nav').toggleClass('fixed-top static-top');
});


$('#toggleNavColor').click(function () {
    $('nav').toggleClass('navbar-dark navbar-light');
    $('nav').toggleClass('bg-dark bg-light');
    $('body').toggleClass('bg-dark bg-light');
});

    