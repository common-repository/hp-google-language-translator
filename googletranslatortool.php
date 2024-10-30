<?php
/*
Plugin Name: HP - Google Language Translator
Plugin URI: http://hardik.me/blog/index.php/2011/01/21/wordpress-google-language-translator/
Version: 1.0.1
Description: Translation Utility using Google Translator Tool, By Enabling this option on front side of the site there will be option to translate page into various languages using Google Language Tranlator Tool.
Author: Hardik
Author URI: http://hardik.me/blog
*/

add_action('admin_menu', 'googletranslatortool_menu_options');


if(get_option('googletranslatortool_show')=='Footer'){
	add_action("wp_footer",'googletranslatortool_google_translatorbox');
}
add_option("googletranslatortool_active","0");
add_option("googletranslatortool_show","Footer");


function googletranslatortool_menu_options(){
	add_options_page('Google Translator Tool', 'Google Translator Tool', 'manage_options', 'googletranslatortool-menu-options', 'googletranslatortool_menu');
	
	if(isset($_POST['googletranslatortool_update_options'])){
		update_option('googletranslatortool_show',$_POST['googletranslatortool_show']);
	}
	
}

function googletranslatortool_menu(){
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	?>
	<div class="wrap">
	  <div id="icon-options-general" class="icon32"></div>
      <h2>Google Translator Tool</h2>
      <div id="poststuff" class="metabox-holder has-right-sidebar" >
      <div class="postbox">
      <h3>Settings</h3>
<form method="post" action="options.php">
            <?php wp_nonce_field('update-options');?>
            <table width="100%" border="0" cellspacing="8" cellpadding="0" class="form-table">
              <tr>
                <td width="11%" align="left" valign="top">Show in?</td>
                <td width="89%" align="left" valign="top">
                <select name="googletranslatortool_show" id="googletranslatortool_show" style="width:100px;">
                <option value="Footer" <?php if(get_option('googletranslatortool_show')=='Footer'){echo "selected";}?>>Footer</option>
                <option value="Widget" <?php if(get_option('googletranslatortool_show')=='Widget'){echo "selected";}?>>Widget</option>
                </select>                </td>
              </tr>
              <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td align="left" valign="top"><input type="checkbox"  name="googletranslatortool_active" id="googletranslatortool_active" value="1" <?php if(get_option('googletranslatortool_active')==1){echo "checked";}?> />
                Tick to Activate Google Translator Tool</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><input type="submit" class="button-primary" value="<?php _e('Update Option')?>" name="googletranslatortool_update_options" /></td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
          </table>
<input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="googletranslatortool_active" />
        </form>
       </div> 
       </div>
       
       <div id="poststuff" class="metabox-holder" style="float: left; width: 48%;">
      <div class="postbox">
      <h3>My Other Plugins!</h3>
	  <table class="form-table" width="100%">
       	  <tr><td align="left" valign="top">
              <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr>
                  <td style="background:#fff"><strong>You may download my other Plugins (<a href="http://hardik.me" target="_blank">Visit My Site</a>)</strong></td>
                </tr>
                <tr>
                  <td>
                      <div>
                        <div>
                          <div>
                            <a href="http://wordpress.org/extend/plugins/picasa-web-album-photos/">HP - Picasa Web Album Photos</a>
                            HP - To show your picasa album images on widget area in gallery mode with different effects.<br>
                          </div>
                          <div>
                            <a href="http://wordpress.org/extend/plugins/generate-social-network-profie-qr-code/">Generate Social Network Profie QR Code.</a>
                            Generate Social Network Profie QR Code.<br>
                          </div>
                          <div>
                            <a href="http://wordpress.org/extend/plugins/place-youtube-video/">YouTube Video Plugin to show YouTube Videos from widgets.</a>
                            YouTube Video Plugin to show YouTube Videos from widgets.<br>
                          </div>
                          <div>
                            <a href="http://wordpress.org/extend/plugins/my-rss-plugin/">Hardik - My RSS Plugin</a>
                            Plugin to show RSS any RSS feed, admin can set it to widget area, set its title and number of records.<br>
                          </div>
                        </div>
                      </div>
                  </td>
                </tr>
              </table>
            </td>
        	</tr>
        </table></div></div>
       <div id="poststuff" class="metabox-holder" style="float: right; width: 48%;">
       <div class="postbox">
      <h3>Buy me a Beer!</h3>
      <div class="inside">
      If you like this plugin and find it useful, help keep this plugin free and actively developed by clicking the donate button <br /><br />
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="hbkpanchal@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Hardik.Me">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form><br /><br />
</div>
</div></div>
	  </div>
      
        
	<?php
}

function googletranslatortool_google_translatorbox(){
	if(get_option('googletranslatortool_active')==1){
		$str.='<div id="google_translate_element"></div><script>
	function googleTranslateElementInit() {
	  new google.translate.TranslateElement({
		pageLanguage: \'en\'
	  }, \'google_translate_element\');
	}
	</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>';
		echo '<div style="text-align: right;">'.$str.'</div><span style="display:none"><a href="http://hardik.me" rel="dofollow">php developer india</a></span>';
	}
}

function googletranslatortool_widget_Init(){
  register_widget('googletranslatortoolWidget');
}
add_action("widgets_init", "googletranslatortool_widget_Init");

class googletranslatortoolWidget extends WP_Widget {
     function googletranslatortoolWidget() {
       //Widget code
	   parent::WP_Widget(false,$name="Google Language Translator");
     }

     function widget($args, $instance) {
       //Widget output
	    $options = $instance;
		if(get_option('googletranslatortool_show')=='Widget'){
			extract($args);	
			echo $before_widget; 
			echo $before_title . $title . $after_title;
			googletranslatortool_google_translatorbox(); 
			echo $after_widget;
		}
     }

     function update($new_instance, $old_instance) {
       //Save widget options
		$instance = $old_instance;
		foreach($new_instance as $k=>$v){
			$instance[$k] = $new_instance[$k];
		}
		return $instance;
     }

     function form($instance) {
       //Output admin widget options form
    	echo "<a href='options-general.php?page=googletranslatortool-menu-options'><strong>Click here</strong></a> for settings";
     }
	
}


?>
