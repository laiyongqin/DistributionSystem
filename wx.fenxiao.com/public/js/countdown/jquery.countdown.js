/**
 * 倒计时插件
 * ShowTime
 */
$(document).ready(function(){
    (function($){
        $.fn.yomi=function(){
            var data="";
            var _DOM=null;
            var TIMER;
            createdom =function(dom){
                _DOM=dom;
                data=$(dom).attr("data");
                data = data.replace(/-/g,"/");
                data = Math.round((new Date(data)).getTime()/1000);
                $(_DOM).append("<ul class='yomi'><li class='yomihour'></li><li class='split'>:</li><li class='yomimin'></li><li class='split'>:</li><li class='yomisec'></li></ul>")
                reflash();

            };
            reflash=function(){
                var	range  	= data-Math.round((new Date()).getTime()/1000),
                    secday  = 86400, sechour = 3600,
                    days 	= parseInt(range/secday),
                    hours	= parseInt((range%secday)/sechour),
                    min		= parseInt(((range%secday)%sechour)/60),
                    sec		= ((range%secday)%sechour)%60;

                if(range >= 0){
                    //$(_DOM).find(".yomiday").html(nol(days));
                    $(_DOM).find(".yomihour").html(nol(hours));
                    $(_DOM).find(".yomimin").html(nol(min));
                    $(_DOM).find(".yomisec").html(nol(sec));
                }else{
                    $(_DOM).hide();
                    $(_DOM).parent().find(".end").show();
                }
            };
            TIMER = setInterval( reflash,1000 );
            nol = function(h){
                return h>9?h:'0'+h;
            }

            return this.each(function(){
                var $box = $(this);
                createdom($box);
            });
        }
    })(jQuery);
    $(function(){
        $(".yomibox").each(function(){
            $(this).yomi();
        });
    });
})