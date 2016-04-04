<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

/**
 *  SMSF SPECIFIC FUNCTIONS - REMOVE TO SEPARATE FILE!
 */

function menu_key_action_one($atts) {

    $a = shortcode_atts(array('selected' => "item1"), $atts);

    $selected = $a['selected'];

    $code = '<div class="smsf-side-menu">';
    $code .= '<ul>';
    $code .= '<li' . ($selected == "item1" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Introduction</a></li>';
    $code .= '<li' . ($selected == "item2" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Contribution to a self-managed super fund</a></li>';
    $code .= '<li' . ($selected == "item3" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Accessing your super</a></li>';
    $code .= '<li' . ($selected == "item4" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Self-managed super fund investment strategies</a></li>';
    $code .= '<li' . ($selected == "item5" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Who is a trustee and what is a trust deed?</a></li>';
    $code .= '<li' . ($selected == "item6" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Maintaining a self-managed super fund</a></li>';
    $code .= '<li' . ($selected == "item7" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Winding up a fund</a></li>';
    $code .= '<li' . ($selected == "item8" ? ' class="active"' : '') . '><a href="/thinking-of-starting">Statement of advice</a></li>';
    $code .= '</ul></div>';
    return $code;
}

add_shortcode('smsf_menu_key_action_one', menu_key_action_one);

/**
 * Inserts an Avada full width container with a four column "footer" that has the Specialists and Sign Up boxes. Common to many pages. 
 */
function smsf_footer_common() {
    return do_shortcode('[one_fourth last="no" spacing="yes" center_content="yes" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="solid" padding="" margin_top="" margin_bottom="" animation_type="0" animation_direction="down" animation_speed="0.1" class="" id=""][imageframe lightbox="no" lightbox_image="" style_type="none" hover_type="none" bordercolor="" bordersize="0px" borderradius="0" stylecolor="" align="center" link="" linktarget="_self" animation_type="fade" animation_direction="up" animation_speed="0.8" hide_on_mobile="no" class="" id=""] <img alt="" src="http://smsf.expansionware.com.au/wp-content/uploads/2016/03/SMSF_Graphic_Specialists.svg" />[/imageframe][/one_fourth][one_fourth last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""][fusion_text]
<h2>SMSF Association Specialists provide peace of mind for your financial future.</h2>
[/fusion_text][button link="/find-a-specialist" color="default" size=""  type="" shape="" target="_self" title="" gradient_colors="|" gradient_hover_colors="|" accent_color="" accent_hover_color="" bevel_color="" border_width="1px" icon="" icon_position="left" icon_divider="no" modal="" animation_type="0" animation_direction="left" animation_speed="1" alignment="" class="smsf-button" id=""]Find a Specialist[/button][/one_fourth][one_fourth last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""][imageframe lightbox="no" lightbox_image="" style_type="none" hover_type="none" bordercolor="" bordersize="0px" borderradius="0" stylecolor="" align="center" link="" linktarget="_self" animation_type="fade" animation_direction="up" animation_speed="0.8" hide_on_mobile="no" class="" id=""] <img alt="" src="http://smsf.expansionware.com.au/wp-content/uploads/2016/03/SMSF_Graphic_Signup.svg" />[/imageframe][/one_fourth][one_fourth last="yes" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""][fusion_text]
<h2>Subscribe for news to receive all the latest information you need.</h2>
[/fusion_text][button link="/sign-up" color="default" size=""  type="" shape="" target="_self" title="" gradient_colors="|" gradient_hover_colors="|" accent_color="" accent_hover_color="" bevel_color="" border_width="1px" icon="" icon_position="left" icon_divider="no" modal="" animation_type="0" animation_direction="left" animation_speed="1" alignment="" class="smsf-button" id=""]Sign up[/button][/one_fourth]');
}

add_shortcode('smsf_footer_common', smsf_footer_common);

function smsf_footer($homepage = false) {

    // Set the full width codes with the appropriate background
    if ($homepage) {
        $code = '[fullwidth background_color="" background_image="http://smsf.expansionware.com.au/wp-content/uploads/2016/03/footer-bg.png" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_repeat="no-repeat" background_position="right top" video_url="" video_aspect_ratio="16:9" video_webm="" video_mp4="" video_ogv="" video_preview_image="" overlay_color="" overlay_opacity="0.5" video_mute="yes" video_loop="yes" fade="no" border_size="0px" border_color="" border_style="solid" padding_top="50px" padding_bottom="300px" padding_left="60px" padding_right="60px" hundred_percent="yes" equal_height_columns="no" hide_on_mobile="no" menu_anchor="" class="" id=""]';
    } else {
        $code = '[fullwidth background_color="" background_image="http://smsf.expansionware.com.au/wp-content/uploads/2016/03/blue-bg-reverse.png" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_repeat="repeat-x" background_position="left top" video_url="" video_aspect_ratio="16:9" video_webm="" video_mp4="" video_ogv="" video_preview_image="" overlay_color="" overlay_opacity="0.5" video_mute="yes" video_loop="yes" fade="no" border_size="0px" border_color="" border_style="solid" padding_top="50px" padding_bottom="300px" padding_left="60px" padding_right="60px" hundred_percent="yes" equal_height_columns="no" hide_on_mobile="no" menu_anchor="" class="" id=""]';
    }

    // Set the contents
    $code = $code . '[one_fourth last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""]';

    // Homepage requires logo and padding to the contact info. Page footers do not.
    if ($homepage) {
        $code = $code . '[imageframe lightbox="no" lightbox_image="" style_type="none" hover_type="none" bordercolor="" bordersize="0px" borderradius="0" stylecolor="" align="none" link="" linktarget="_self" animation_type="0" animation_direction="down" animation_speed="0.1" hide_on_mobile="no" class="" id=""] <img alt="" src="http://smsf.expansionware.com.au/wp-content/uploads/2016/03/logo.png" />[/imageframe][separator style_type="none" top_margin="10" bottom_margin="10" sep_color="" border_size="" icon="" icon_circle="" icon_circle_color="" width="" alignment="center" class="" id=""][fusion_text]<div class="smsf-bold" style="color: white; margin-left: 66px;">1800 779 096 <span style="font-size: 11px;">(toll free)</span><br /><a class="smsf-footer-link" href="mailto:enquiries@spaa.com.au">enquiries@spaa.com.au</a></div>[/fusion_text][/one_fourth][one_fourth last="no" spacing="yes" center_content="yes" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="solid" padding="" margin_top="" margin_bottom="" animation_type="0" animation_direction="down" animation_speed="0.1" class="" id=""][fusion_text]';
    } else {
        $code = $code . '[fusion_text]<div class="smsf-bold" style="color: white;">1800 779 096 <span style="font-size: 11px;">(toll free)</span><br /><a class="smsf-footer-link" href="mailto:enquiries@spaa.com.au">enquiries@spaa.com.au</a></div>[/fusion_text][/one_fourth][one_fourth last="no" spacing="yes" center_content="yes" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="solid" padding="" margin_top="" margin_bottom="" animation_type="0" animation_direction="down" animation_speed="0.1" class="" id=""][fusion_text]';
    }

    $code = $code . '<div class="smsf-address">Mailing Address<br />PO Box 6540, Halifax St<br />Adelaide SA 5000</div>
[/fusion_text][/one_fourth][one_fourth last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""][fusion_text]
<div class="smsf-address">Adelaide Head Office<br />Level 1, 366 King William St<br />Adelaide SA 5000</div>
[/fusion_text][/one_fourth][one_fourth last="yes" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" border_position="all" border_size="0px" border_color="" border_style="" padding="" margin_top="" margin_bottom="" animation_type="" animation_direction="" animation_speed="0.1" class="" id=""][fusion_text]<div><a href="' . Avada()->settings->get('facebook_link') . '" target="_blank"><i class="smsf-social-media icon-SMSF_Graphic_Facebook"></i></a><a href="' . Avada()->settings->get('twitter_link') . '" target="_blank"><i class="smsf-social-media icon-SMSF_Graphic_Twitter"></i></a><a href="' . Avada()->settings->get('linkedin_link') . '" target="_blank"><i class="smsf-social-media icon-SMSF_Graphic_LinkedIn"></i></a><a href="' . Avada()->settings->get('youtube_link') . '" target="_blank"><i class="smsf-social-media icon-SMSF_Graphic_Youtube"></i></a>&nbsp;</div>[/fusion_text][/one_fourth][/fullwidth]';

    return do_shortcode($code);
}

add_shortcode('smsf_footer', smsf_footer);
