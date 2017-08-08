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




	  function autoScroll(obj){  
			$(obj).find("ul").animate({  
				marginTop : "-6vw"  
			},500,function(){  
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
			})  
		}  
		$(function(){  
			setInterval('autoScroll(".text")',9000);
			  
		}) 
		
		$('.sign_success').hide();
		$(".menu a:nth-child(4)").click(function(){
		$('.sign_success').show()
		});