function wpld_like_btn_ajax(postId, userid, a)
{

          var postid = postId;
          var userId = userid;
          var btn_type = a;
         
          jQuery.ajax({
          url : wpld_ajax_url.ajax_url,  ////objectname.urlvalue(ex:wpld_ajax_url.ajax_url)
          type : 'post',
          data : {
                    action : 'wpld_like_btn_ajax_action',
                    pid : postid,
                    uid : userId,
                    btn_type : btn_type
          },
            success : function( response ){
             
                    jQuery("#WpldAjaxResponse span").html(response);
            }
          });
}