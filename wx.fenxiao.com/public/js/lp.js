
//图片轮播
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false
    });
	
//弹出框
$(".sorts").click(function(){
  $(".popup-bj").show();
  $("body").addClass("body-stop");
  $(".sorts-popup").animate({left:'0'});
  $(".sorts-close").animate({right:'4.5%'});
});
$(".sorts-close").click(function(){
  $(".popup-bj").hide();
  $("body").removeClass("body-stop");
  $(".sorts-popup").animate({left:'-82vw'});
  $(".sorts-close").animate({right:'-10%'});
});
	
