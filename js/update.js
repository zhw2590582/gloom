(function($) {
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

  // 请求数据
  var data;
  var getDate = function() {
    $.ajax({
      type: "GET",
      url: "https://raw.githubusercontent.com/zhw2590582/gloom/master/update.json",
      dataType: "json",
      success: function(update) {
        console.log(update);
        data = update;
      },
      error: function() {
        console.log('链接出错，请重试！');
      }
    });
  };

  getDate();

})(jQuery);
