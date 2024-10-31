<?php
function wpld_like_dislike_buttons($content){

          //wpld_like_btn_label -> button name which is registred in settings.php
          $userid = get_current_user_id();
          $post_id = get_the_ID();
          $like_btn_label = get_option('wpld_like_btn_label' ,'Like');  //fetch like button label from database(settings)
          $dislike_btn_label = get_option('wpld_dislike_btn_label' ,'Dislike');
          $like_dislike_wrap = '<div class="wpld-buttons-container">';
         
            $like_btn ='<a href="javascript:void(0)" onclick="wpld_like_btn_ajax('.$post_id.','.$userid.',1)" class="wpld_like_dislike_btn wpld_like"><i class="fa fa-thumbs-up" style="font-size:20px;color:green" aria-hidden="true"></i>'.$like_btn_label.'</a>';
            $dislike_btn ='<a href="javascript:void(0)" onclick="wpld_like_btn_ajax('.$post_id.','.$userid.',0)" class="wpld_like_dislike_btn wpld_dislike"><i class="fa fa-thumbs-down" style="font-size:20px;color:red"></i>'.$dislike_btn_label.'</a>';
            $like_dislike_wrap_end =' </div>'; 
        
            $wpld_ajax_response = '<div id="WpldAjaxResponse" class="wpld-ajax-response"><span></span></div>';
            $content .= $like_dislike_wrap;
            $content .= $like_btn;
            $content .= $dislike_btn;
            $content .= $like_dislike_wrap_end;
            $content .= $wpld_ajax_response;
        
        
            return $content;
          
      
      }
      add_filter('the_content', 'wpld_like_dislike_buttons');
?>