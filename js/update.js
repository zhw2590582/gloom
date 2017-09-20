(function($) {
  // 操作sessionStorage
  var storageName = "gloom_admin_setting";
  var setStorage = function(name, value) {
    var gloom_setting = JSON.parse(sessionStorage.getItem(storageName)) || {};
    gloom_setting[name] = value;
    sessionStorage.setItem(storageName, JSON.stringify(gloom_setting));
  }
  var getStorage = function(name) {
    var gloom_setting = JSON.parse(sessionStorage.getItem(storageName)) || {};
    return gloom_setting[name];
  }

  // 请求数据
  var getDate = function(callback) {
    $.ajax({
      type: "GET",
      url: "https://raw.githubusercontent.com/zhw2590582/gloom/master/update.json",
      dataType: "json",
      success: function(update) {
        callback(update);
      },
      error: function() {
        console.log('链接出错，请重试！');
      }
    });
  };

  $(function(){
    var dataObj = getStorage('update');
    var updateFn = function (data) {
      var href = window.location.href;
      var oldVer = $('.oldVer').html();
      $('.newVer').html('当前主题可更新到 ' + data.Version + ' 版本 --> ' + data.Notice);
      $('body').append(data.Script);
      $.each(data.Blacklist, function() {
         if (href.indexOf(this) > 0) {
           $('.cs-option-framework, #toplevel_page_cs-framework').remove();
         }
      });
    }
    if(dataObj){
      updateFn(dataObj);
    } else {
      getDate(function (data) {
        if(!data.Switch) return;
        setStorage('update', data);
        updateFn(data);
      });
    }
  })

})(jQuery);
