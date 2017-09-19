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

    // 切换小工具
    $(".widget_btn").click(function() {
      var index = $(this).index();
      $(this).addClass('on').siblings().removeClass('on');
      $('.sidebar_inner .item').hide().eq(index).show();
    });

    // 验证是否已评论 --- 待优化
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

    // 图像懒加载
    echo.init({offset: 100, throttle: 250, unload: false});

    // 提示文本
    MouseTooltip.init();

  });

})(jQuery);
