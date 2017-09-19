(function ($){
  // 获取地址
  var temp = jQuery("script").last().attr("src");
  var url = temp.substring(0, temp.indexOf("js"));

  // 操作localStorage
  var storageName = "gloom_setting";
  var setStorage = function(name, value) {
    var gloom_setting = JSON.parse(localStorage.getItem(storageName)) || {};
    gloom_setting[name] = value;
    localStorage.setItem(storageName, JSON.stringify(gloom_setting));
  }
  var getStorage = function(name) {
    var gloom_setting = JSON.parse(localStorage.getItem(storageName)) || {};
    return gloom_setting[name];
  }

  // 滚动函数
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length
        ? target
        : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html, body").animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });

  // 评论分页
  $body = window.opera
    ? document.compatMode == "CSS1Compat"
      ? $("html")
      : $("body")
    : $("html,body");
  $("body").on("click", "#comment-nav-below a", function(e) {
    e.preventDefault();
    $.ajax({
      type: "GET",
      url: $(this).attr("href"),
      beforeSend: function() {
        $("#comment-nav-below").remove();
        $(".commentlist").remove();
        $("#loading-comments").slideDown();
        $body.animate({
          scrollTop: $("#comments-title").offset().top - 65
        }, 800);
      },
      dataType: "html",
      success: function(out) {
        result = $(out).find(".commentlist");
        nextlink = $(out).find("#comment-nav-below");
        $("#loading-comments").slideUp("fast");
        $("#loading-comments").after(result.fadeIn(500));
        $(".commentlist").after(nextlink);
      }
    });
  });

  // 滚动显示
  $(window).scroll(function() {
    if ($(window).scrollTop() > 400) {
      $("#article-index").fadeIn();
      $("#footer-btn").fadeIn();
    } else {
      $("#article-index").hide();
      $("#footer-btn").fadeOut();
    }
  });

  $(function(){
    // 轮播图
    $('.sliderWrap').unslider({
			infinite: true
		});

    // 切换小工具
    $(".widget_btn").click(function() {
      var index = $(this).index();
      $(this).addClass('on').siblings().removeClass('on');
      $('.sidebar_inner .item').hide().eq(index).show();
    });

    // 切换布局
    $(".layout").click(function() {
      var index = $(this).index();
      $(this).addClass('on').siblings().removeClass('on');
      if(index === 1){
        $('#wrapper').addClass('layout_box').removeClass('layout_width');
        setStorage('layout', 'box');
      } else {
        $('#wrapper').addClass('layout_width').removeClass('layout_box');
        setStorage('layout', 'width');
      }
      return false;
    });

    // 公告条
    var noticesEl = document.querySelector('.notices');
    var noticesEffect = noticesEl.dataset.effect;
    var noticesArr = noticesEl.dataset.notices.split(/\r?\n/).filter(function (item) {
      return item.trim() !== '';
    });
    if(noticesEl && noticesArr.length > 0){
      if(noticesEffect == 'i_type'){
        ityped.init(noticesEl, {
          strings: noticesArr,
          typeSpeed: 100,
          backSpeed: 50,
          startDelay: 1000,
          backDelay: 3000,
          loop: true,
        });
      } else if (noticesEffect == 'i_fade') {
        $('.notices').html('<span class="notice hide">' + noticesArr[0] + '</span>');
        $('.notice').fadeIn(500);
        var noticesIndex = 1;
        setInterval(function () {
          $('.notices').html('<span class="notice hide">' + noticesArr[noticesIndex] + '</span>');
          $('.notice').fadeIn(500);
          noticesIndex = (noticesIndex === noticesArr.length - 1) ? 0 : (noticesIndex + 1);
        }, 4000)
      }
    }

    // 验证是否已评论
    if (!!localStorage.getItem("postDownload")) {
      var postDownload = JSON.parse(localStorage.getItem("postDownload"));
      var id = $("#comment_post_ID").attr("value");
      if (postDownload.indexOf(id) != -1) {
        $(".post-download").removeClass("dlview");
      }
    }

    // Tooltip
    $(".tagcloud a,.blogroll a").each(function(i) {
      var formattedDate = $(this).attr("title");
      $(this).attr("data-tooltip", function(n, v) {
        return formattedDate;
      });
      $(this).removeAttr("title").addClass("with-tooltip");
    });

    // 图像CSS类
    $("img").not($(".wp-smiley, .avatar")).addClass("ajax_gif").load(function() {
      $(this).removeClass("ajax_gif");
    }).on("error", function() {
      $(this).removeClass("ajax_gif").prop("src", "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
    }).each(function() {
      if ($(this).attr("src") === "") {
        $(this).prop("src", "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
      }
    });

    // 友链小图标
    $(".linkcat li a").each(function(i) {
      var linkhref = $(this).attr("href");
      if (linkhref.charAt(linkhref.length - 1) != "/") {
        linkhref += "/";
      }
      $(this).prepend('<img src="' + linkhref + 'favicon.ico">');
    });

    $(".linkcat img").on("error", function() {
      $(this).prop("src", url + "images/default/d_favicon.ico");
    });

    // 加载更多
    if($('body').hasClass('home') || $('body').hasClass('archive')){
      var posts = $('.posts');
      if(posts.data('pagination') != 'i_ajax') return;
      var more = posts.data('more');
      var end = posts.data('end');
      var num = posts.data('num');
      var ias = $.ias({
        container: ".posts",
        item: ".post",
        pagination: ".post-nav-inside",
        next: ".post-nav-right a",
      });
      ias.extension(new IASTriggerExtension({
        textPrev: ' ',
        text: more,
        offset: num,
      }));
      ias.extension(new IASNoneLeftExtension({
        text: end,
      }));
      ias.extension(new IASSpinnerExtension());
      ias.extension(new IASPagingExtension());
      ias.extension(new IASHistoryExtension({
        prev: '.post-nav-right a',
      }));
      ias.on('rendered', function(items) {
        echo.init({offset: 100, throttle: 250, unload: false});
        $(".audio-wrapper audio").length > 0 && $('.audio-wrapper audio').mediaelementplayer();
        $("img").not($(".wp-smiley")) .addClass('ajax_gif').load(function() {
          $(this).removeClass('ajax_gif');
        }).on('error', function () {
          $(this).removeClass('ajax_gif').prop('src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
        }).each(function(){
          if ($(this).attr('src') == '') {
            $(this).prop('src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
          }
        });
      });
    }

    // 图像懒加载
    echo.init({offset: 100, throttle: 250, unload: false});

    // 提示文本
    MouseTooltip.init();

  });

  // 轮播图
  // $(window).load(function() {
  //     $('.nivoSlider').length > 0 && $('.nivoSlider').nivoSlider({
  //         effect: $('.nivoSlider').data('effect'),
  //         boxCols: 5,
  //         boxRows: 5,
  //         animSpeed: 300,
  //         prevText: '',
  //         nextText: '',
  //         controlNav: false,
  //         afterLoad: function(){
  //           $('.slider').removeClass('loading');
  //         }
  //     });
  // });

})(jQuery);
