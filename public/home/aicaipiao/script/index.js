$(document).ready(function(){
	window.setTimeout(function(){
		$(".loading").fadeOut(500)
	},400)
	$(".sinpt").each(function(){
		$(this).sinpt();
	})
	
	function animteehFn(){
		var oHeight = document.documentElement.clientHeight || document.body.clientHeight;
		var oWidth = document.documentElement.clientWidth || document.body.clientWidth;
		var sc = $(window).scrollTop();
		$(".animteeh").each(function(){
			if(sc+ oHeight > $(this).offset().top+150 ){
				$(this).addClass("active")
			}
		});
		$(window).scroll(function(){
			var oWidth = document.documentElement.clientWidth || document.body.clientWidth;
			oHeight = document.documentElement.clientHeight || document.body.clientHeight;
			sc = $(window).scrollTop();
			$(".animteeh").each(function(){
				if(sc+ oHeight > $(this).offset().top+150 ){
					$(this).addClass("active")
				}
			});
			$(".secton").each(function(){
				if(sc+ oHeight > $(this).offset().top+150 ){
					$(this).addClass("active")
				}
			})
			if(oWidth<610){
				$(".anlilunt li").each(function(){
					if(sc+ oHeight > $(this).offset().top+150 ){
						$(this).addClass("active")
					}
				})
			}
			
			
		});
		
	}
	animteehFn();
	
	$(".yh1").click(function(){
		$(this).siblings(".yh2").toggle();
	});

	$(".yohuqie a").click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		var x = $(this).attr("datex");
		if(x == 0){
			$(".youhuiul li").show();
		}else{
			$(".youhuiul li[datex="+x+"]").show().siblings("li").hide();
		}
	});
	
	 function getTime() {
        var nowDate = new Date(new Date().getTime() - 43200000),
            nY = nowDate.getFullYear(),
            nM = nowDate.getMonth() + 1,
            nD = nowDate.getDate(),
            nH = nowDate.getHours(),
            nMi = nowDate.getMinutes(),
            nS = nowDate.getSeconds();
        nM = nM < 10 ? '0' + nM : nM;
        nD = nD < 10 ? '0' + nD : nD;
        nH = nH < 10 ? '0' + nH : nH;
        nMi = nMi < 10 ? '0' + nMi : nMi;
        nS = nS < 10 ? '0' + nS : nS;

        var fullTime = nY + '-' + nM + '-' + nD + ' ' + nH + ':' + nMi + ':' + nS;
        $('#nowTime').text(fullTime);
    }
	getTime();
    setInterval(getTime, 1000);
	
	$(".nav li").hover(function(){
		$(this).find(".xiala").stop().slideDown(200)
	},function(){
		$(this).find(".xiala").stop().slideUp(200)
	});
	
	$(".conen1qe li").hover(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		var x = $(this).index();
		$(".qiasmtb[dasme="+x+"]").show().siblings(".qiasmtb").hide();
	});
	
	$(window).scroll(function(){
			var sc = $(window).scrollTop();
			$(".rightdao").stop().animate({
				top: sc+100
			},400);
		});
		$(".closedao").click(function(){
			$(this).parent().hide();
		});
})