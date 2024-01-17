/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

$(document).ready(function(){
    $("#live_search").keyup(function(event){
        event.preventDefault();
        var input = $(this).val();
        //alert(input);
        if(input != ""){
            $.ajax({
                url:"view/v_searchAjax.php",
                method:"POST",
                data:{input:input},
                success:function(data){
                    $("#searchresult").html(data);
                    $("#searchresult").css("display", "flex");
                }
            });
        }else{
            $("#searchresult").css("display", "none")
        }
    });
});

'use strict';

(function ($) {

/*------------------
    Preloader
--------------------*/
$(window).on('load', function () {
    $(".loader").fadeOut();
    $("#preloder").delay(0).fadeOut("slow");

    /*------------------
        Gallery filter
    --------------------*/
    $('.featured__controls li').on('click', function () {
        $('.featured__controls li').removeClass('active');
        $(this).addClass('active');
    });
    if ($('.featured__filter').length > 0) {
        var containerEl = document.querySelector('.featured__filter');
        var mixer = mixitup(containerEl);
    }
});

/*------------------
    Background Set
--------------------*/
$('.set-bg').each(function () {
    var bg = $(this).data('setbg');
    $(this).css('background-image', 'url(' + bg + ')');
});

//Humberger Menu
$(".humberger__open").on('click', function () {
    $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
    $(".humberger__menu__overlay").addClass("active");
    $("body").addClass("over_hid");
});

$(".humberger__menu__overlay").on('click', function () {
    $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
    $(".humberger__menu__overlay").removeClass("active");
    $("body").removeClass("over_hid");
});

/*------------------
    Navigation
--------------------*/
$(".mobile-menu").slicknav({
    prependTo: '#mobile-menu-wrap',
    allowParentLinks: true
});

/*-----------------------
    Categories Slider
------------------------*/
$(".categories__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 4,
    dots: false,
    nav: true,
    navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {

        0: {
            items: 1,
        },

        480: {
            items: 2,
        },

        768: {
            items: 3,
        },

        992: {
            items: 4,
        }
    }
});


$('.hero__categories__all').on('click', function(){
    $('.hero__categories ul').slideToggle(400);
});

/*--------------------------
    Latest Product Slider
----------------------------*/
$(".latest-product__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: false,
    nav: true,
    navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true
});

/*-----------------------------
    Product Discount Slider
-------------------------------*/
$(".product__discount__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 3,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {

        320: {
            items: 1,
        },

        480: {
            items: 2,
        },

        768: {
            items: 2,
        },

        992: {
            items: 3,
        }
    }
});

/*---------------------------------
    Product Details Pic Slider
----------------------------------*/
$(".product__details__pic__slider").owlCarousel({
    loop: true,
    margin: 20,
    items: 4,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true
});

/*-----------------------
    Price Range Slider
------------------------ */
var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max');
rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
        minamount.val('$' + ui.values[0]);
        maxamount.val('$' + ui.values[1]);
    }
});
minamount.val('$' + rangeSlider.slider("values", 0));
maxamount.val('$' + rangeSlider.slider("values", 1));

/*--------------------------
    Select
----------------------------*/
$("select").niceSelect();

/*------------------
    Single Product
--------------------*/
$('.product__details__pic__slider img').on('click', function () {

    var imgurl = $(this).data('imgbigurl');
    var bigImg = $('.product__details__pic__item--large').attr('src');
    if (imgurl != bigImg) {
        $('.product__details__pic__item--large').attr({
            src: imgurl
        });
    }
});

/*-------------------
    Quantity change
--------------------- */

})(jQuery);



// CHECK FORM ĐĂNG NHẬP
function kiemtra_dn(){
var Email = document.getElementById("Email");
if(Email.value==""){
    document.getElementById("alert-login").innerHTML="Email không được để trống";
    Email.focus();
    return false;
}else{
    
}

var MatKhau = document.getElementById("MatKhau");
if(MatKhau.value==""){
    document.getElementById("alert-login").innerHTML="Mật khẩu không được để trống";
    MatKhau.focus();
    return false;
}
}

// CHECK FORM ĐĂNG KÝ
function kiemtra_dk(){
//hoten 
var HoTen = document.getElementById("HoTen");
if(HoTen.value==""){
    document.getElementById("alert-register").innerHTML="Họ tên không để trống";
    HoTen.focus();
    return false;
}else{
    var regex_HoTen = /^[A-Za-z\s]+$/; //Biểu thức chính quy
    if(!regex_HoTen.test(HoTen.value)){//Nếu giá trị HoTen không phù hợp voi Biểu thức chính quy //bạn cần sử dụng phương thức test() của biểu thức chính quy.
        document.getElementById("alert-register").innerHTML="Họ tên không nhập các ký tư dặc biệt";
        HoTen.focus();
        return false;
    }else{
        if(HoTen.value.length > 50 ){
            document.getElementById("alert-register").innerHTML="Họ tên không quá 50 ký tự";
            HoTen.focus();
            return false;
        }
    }
}
//UserName
if(UserName.value==""){
    document.getElementById("alert-register").innerHTML="Bạn chưa nhập username";
    UserName.focus();
    return false;
}

 //Email
if(Email.value==""){
    document.getElementById("alert-register").innerHTML="Email không để trống";
    Email.focus();
    return false;
}else{
   
}

//password
if(MatKhau.value==""){
    document.getElementById("alert-register").innerHTML="Mật khẩu không để trống";
    MatKhau.focus();
    return false;
}else{
    if(MatKhau.value.length>=10){
        document.getElementById("alert-register").innerHTML="Mật khẩu không quá 10 ký tự";
        MatKhau.focus();
        return false;
    }
}

//DiaChi
if(DiaChi.value==""){
    document.getElementById("alert-register").innerHTML="Bạn chưa nhập địa chỉ";
    DiaChi.focus();
    return false;
}

//SoDienThoai
if(SoDienThoai.value==""){
    document.getElementById("alert-register").innerHTML="Bạn chưa nhập số điện thoại";
    SoDienThoai.focus();
    return false;
}

//GioiTinh
var GioiTinh = document.getElementById("GioiTinh");
if(GioiTinh.value=== ""){
    document.getElementById("alert-register").innerHTML="Bạn chưa chọn giới tinh";
    GioiTinh.focus();
    return false;
}

}

document.addEventListener("DOMContentLoaded", function() {
setInterval(function(){
document.getElementById("alert-login").innerHTML="";
},5000);

setInterval(function(){
document.getElementById("alert-register").innerHTML="";
},7000);
});

// Activate the carousel with a specified interval
$('.carousel').carousel({
    interval: 2000 // Time in milliseconds, e.g., 2000 for 2 seconds
});



