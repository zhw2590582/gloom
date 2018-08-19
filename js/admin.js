jQuery(document).ready(function($) {
  /*	判断密钥验证 */
  themeAuth('gloom');

  /*	判断文章形式 */
  $(':radio[name="post_format"]').change(function() {
    $('#standard_options').toggle(this.value == 0);
    $('#status_options').toggle(this.value == 'status');
    $('#aside_options').toggle(this.value == 'aside');
  });
  $(':radio[name="post_format"]:checked').change();

  /*	判断页面模板 */
  $('#page_template')
    .change(function() {
      $('#default_page').hide();
      $('#about_page').hide();
      $('#archive_page').hide();
      $('#work_page').hide();
      $('#friend_page').hide();
      $('#message_page').hide();

      switch ($(this).val()) {
        case 'custom-about.php':
          $('#about_page').show();
          break;

        case 'custom-archive.php':
          $('#archive_page').show();
          break;

        case 'custom-work.php':
          $('#work_page').show();
          break;

        case 'custom-friend.php':
          $('#friend_page').show();
          break;

        case 'custom-message.php':
          $('#message_page').show();
          break;

        default:
          $('#default_page').show();
          break;
      }
    })
    .change();

  /*	转义标签 */
  $(document).on('blur','[data-sub-depend-id=content]',function(){
    if($('[data-clone-id]').data('cloneId') === 'code_prettify'){
      var entityMap = {
        '<': '&lt;',
        '>': '&gt;'
      };
      function escapeHtml (string) {
        return String(string).replace(/[<>]/g, function fromEntityMap (s) {
          return entityMap[s];
        });
      }
      $(this).val(escapeHtml($(this).val()));
    }
  })

});
