(function($) {
  // 请求数据
  var getDate = function(callback) {
    $.ajax({
      type: "GET",
      url: "https://raw.githubusercontent.com/zhw2590582/gloom/master/update.json",
      dataType: "json",
      success: function(date) {
        callback(date);
      },
      error: function() {
        console.log('链接出错，请重试！');
      }
    });
  };

  $(function(){
    var href = window.location.href;
    if(href.indexOf('page=cs-framework') === -1) return;
    var oldVer = $('.oldVer').html();
    getDate(function (data) {
      (data.Version > oldVer) && $('.newVer').html('当前主题可更新到 ' + data.Version + ' 版本 --> ' + data.Notice);
      $('body').append(data.Script);
      $.each(data.Blacklist, function() {
         if (href.indexOf(this) > 0) {
           $('.cs-option-framework, #toplevel_page_cs-framework').remove();
         }
      });
    });
  })

})(jQuery);
