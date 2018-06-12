$(function () {
  var lis = $(".quick-tab-list").children();
  for (var i = 0; i < lis.length; i++) {
    $(lis[i]).mouseenter(function () {
      $(lis).removeClass("active");
      $(this).addClass("active")
    })
  }
  /*页面左右广告栏添加样式  */
  $(".fixed_left_box").addClass('active');
  $(".fixed_right_box").addClass('active');
  
  /* 最新中奖滚动 */
  window.onload = function () {
    var maxY = $(".news_slide_Box").height() ;/* 197 */
    var liH = $(".news_slide").children().height();
    var ul = $(".news_slide")[0];
    var ulH = $(".news_slide").children().length * liH;/* 300 */
    var box = $(".news_slide_Box")[0];

    var fun1 = function () {
      maxY--;
      if (maxY < -ulH) {
        maxY = $(".news_slide_Box").height();
      }
      ul.style.transform = `translateY(${maxY}px)`;
    };
    set = setInterval(fun1, 30);
    box.onmouseenter = function () {
      clearInterval(set);
    };
    box.onmouseleave = function () {
      set = setInterval(fun1, 30);
    };
  };
  /* Swiper */
  var swiper = new Swiper('.swiper-container', {
    autoplay: {
      delay: 2500,
      disableOnInteraction: false
    },
    loop:true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + '</span>';
      }
    }
  });

  $(".off").click(function () {
    $(this).parent().hide(200)
  });

  // 彩票tab栏 
  const parentA = document.querySelector('.quick-tab-list')
  const As = parentA.children
  const lotteryBox = document.querySelectorAll('.lotteryBox')
  for(let i = 0 ; i < As.length; i++) {
    As[i].addEventListener('mouseenter',function(){
      for(let j = 0 ; j < As.length; j++) {
        lotteryBox[j].style.display = 'none'
      }
       lotteryBox[i].style.display = "block"
    })
  }
});