<?php 
namespace EventScriptPHP20;
session_start();
$installed = '';
include("configs.php");
include("language_admin.php");

$message = "";
$logMessage = "";

if(isset($_REQUEST["act"])) {
  if ($_REQUEST["act"]=='logout') {
	
	$_SESSION["ProFiAnTsEveNtLoGin"] = "";
	unset($_SESSION["ProFiAnTsEveNtLoGin"]);

	unset($_SESSION["KCFINDER"]);		
			
 } elseif ($_REQUEST["act"]=='login') {
	
	if ($_REQUEST["user"] == $CONFIG["admin_user"] and $_REQUEST["pass"] == $CONFIG["admin_pass"]) {
		$_SESSION["ProFiAnTsEveNtLoGin"] = "ALoggedIn";
 		$_REQUEST["act"]='events';		
  	} else {
		$logMessage = $lang['Message_Incorrect_login_details'];
  	}
  }
}
?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $lang['Script_Administration_Header']; ?></title>

<script language="javascript" src="include/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="accordion/javascript/prototype.js"></script>
<script type="text/javascript" src="accordion/javascript/effects.js"></script>
<script type="text/javascript" src="accordion/javascript/accordion.js"></script>
<script language="javascript" src="include/color_pick.js"></script>
<script language="javascript" src="include/jscolor.js"></script>
<script type="text/javascript" src="include/datetimepicker_css.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link href="styles/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>
<script>
    CKEDITOR.env.isCompatible = true;
</script>
</head>

<body>

<div class="logo">
	<div class="script_name"><?php echo $lang['Script_Administration_Header']; ?></div>
	<div class="logout_button"><a href="admin.php?act=logout"><img src="images/logout1.png" width="32" alt="Logout" border="0" /></a></div>
    <div class="clear"></div>
</div>

<div style="clear:both"></div>

<?php  
$Logged = false;
if(isset($_SESSION["ProFiAnTsEveNtLoGin"]) and ($_SESSION["ProFiAnTsEveNtLoGin"]=="ALoggedIn")) {
	$Logged = true;
	$ThisIsAdmin = true;
}

if ( $Logged ){
	
function lang_date($subject) {	
	$search  = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	
	$replace = array(
					ReadDB($GLOBALS['OptionsLang']['January']), 
					ReadDB($GLOBALS['OptionsLang']['February']), 
					ReadDB($GLOBALS['OptionsLang']['March']), 
					ReadDB($GLOBALS['OptionsLang']['April']), 
					ReadDB($GLOBALS['OptionsLang']['May']), 
					ReadDB($GLOBALS['OptionsLang']['June']), 
					ReadDB($GLOBALS['OptionsLang']['July']), 
					ReadDB($GLOBALS['OptionsLang']['August']), 
					ReadDB($GLOBALS['OptionsLang']['September']), 
					ReadDB($GLOBALS['OptionsLang']['October']), 
					ReadDB($GLOBALS['OptionsLang']['November']), 
					ReadDB($GLOBALS['OptionsLang']['December']), 
					ReadDB($GLOBALS['OptionsLang']['Monday']), 
					ReadDB($GLOBALS['OptionsLang']['Tuesday']), 
					ReadDB($GLOBALS['OptionsLang']['Wednesday']), 
					ReadDB($GLOBALS['OptionsLang']['Thursday']), 
					ReadDB($GLOBALS['OptionsLang']['Friday']), 
					ReadDB($GLOBALS['OptionsLang']['Saturday']), 
					ReadDB($GLOBALS['OptionsLang']['Sunday'])
					);

	$lang_date = str_replace($search, $replace, $subject);
	return $lang_date;
}

if (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsAdmin') {
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `email`			='".SaveDB($_REQUEST["email"])."',	
				`time_zone`		='".SaveDB($_REQUEST["time_zone"])."',
				`event_approve`	='".SaveDB($_REQUEST["event_approve"])."',
				`captcha`		='".SaveDB($_REQUEST["captcha"])."',
				`htmleditor`	='".SaveDB($_REQUEST["htmleditor"])."',
				`smtp_auth`		='".SaveDB($_REQUEST["smtp_auth"])."',
				`smtp_server`	='".SaveDB($_REQUEST["smtp_server"])."',
				`smtp_port`		='".SaveDB($_REQUEST["smtp_port"])."',
				`smtp_email`	='".SaveDB($_REQUEST["smtp_email"])."',
				`smtp_pass`		='".SaveDB($_REQUEST["smtp_pass"])."',
				`smtp_secure`	='".SaveDB($_REQUEST["smtp_secure"])."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='options'; 
  	$message = $lang['Message_Admin_options_saved'];
	
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsEvents') {
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `per_page`		='".SaveDB($_REQUEST["per_page"])."',
				`orderby`		='".SaveDB($_REQUEST["orderby"])."',
				`items_link`	='".SaveDB($_REQUEST["items_link"])."',
				`showcategdd`	='".SaveDB($_REQUEST["showcategdd"])."',
				`hideold`		='".SaveDB($_REQUEST["hideold"])."',
				`showshare`		='".SaveDB($_REQUEST["showshare"])."',
				`showsearch`	='".SaveDB($_REQUEST["showsearch"])."',
				`show_gmap`		='".SaveDB($_REQUEST["show_gmap"])."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='event_options'; 
  	$message = $lang['Message_Event_options_saved'];
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsVisual') {
	
	// general visual settings
	$visual['gen_font_family'] 	= $_REQUEST['gen_font_family']; 
	$visual['gen_font_size'] 	= $_REQUEST['gen_font_size']; 
	$visual['gen_font_color']	= $_REQUEST['gen_font_color'];
	$visual['gen_bgr_color'] 	= $_REQUEST['gen_bgr_color'];
	$visual['gen_line_height'] 	= $_REQUEST['gen_line_height'];
	$visual['gen_width'] 		= $_REQUEST['gen_width'];
	$visual['gen_width_dim'] 	= $_REQUEST['gen_width_dim'];
	
	// links in "main menu" style
	$visual['link_color'] 					= $_REQUEST['link_color']; 
	$visual['link_color_hover'] 			= $_REQUEST['link_color_hover']; 
	$visual['main_menu_bgr'] 				= $_REQUEST['main_menu_bgr']; 
	$visual['link_font'] 					= $_REQUEST['link_font']; 
	$visual['link_font_size'] 				= $_REQUEST['link_font_size']; 
	$visual['link_font_weight'] 			= $_REQUEST['link_font_weight']; 
	$visual['link_text_decoration'] 		= $_REQUEST['link_text_decoration'];
	$visual['link_text_decoration_hover'] 	= $_REQUEST['link_text_decoration_hover'];	
	
	// Category drop-down in "main menu" style 
	$visual['cat_dd_color'] 		= $_REQUEST['cat_dd_color']; 
	$visual['cat_dd_bgr_color'] 	= $_REQUEST['cat_dd_bgr_color']; 	
	$visual['cat_dd_bgr_color_hover']= $_REQUEST['cat_dd_bgr_color_hover'];
	$visual['cat_dd_family'] 		= $_REQUEST['cat_dd_family']; 
	$visual['cat_dd_font_size']		= $_REQUEST['cat_dd_font_size']; 
	$visual['cat_dd_font_style'] 	= $_REQUEST['cat_dd_font_style'];
	$visual['cat_dd_font_weight'] 	= $_REQUEST['cat_dd_font_weight'];
	$visual['cat_dd_align'] 		= $_REQUEST['cat_dd_align'];
	
	
	
	// image in the events list
	$visual['summ_img_width'] 	= $_REQUEST['summ_img_width']; 
	$visual['summ_img_propor'] 	= $_REQUEST['summ_img_propor']; 
	
	// events list title style
	$visual['summ_title_color'] 	 	= $_REQUEST['summ_title_color']; 
	$visual['summ_title_color_hover'] 	= $_REQUEST['summ_title_color_hover']; 
	$visual['summ_title_font'] 		 	= $_REQUEST['summ_title_font']; 
	$visual['summ_title_size']		 	= $_REQUEST['summ_title_size']; 
	$visual['summ_title_font_weight']	= $_REQUEST['summ_title_font_weight']; 
	$visual['summ_title_font_style'] 	= $_REQUEST['summ_title_font_style']; 
	$visual['summ_title_text_align'] 	= $_REQUEST['summ_title_text_align']; 
	$visual['summ_title_line_height'] 	= $_REQUEST['summ_title_line_height']; 
	$visual['summ_title_decor'] 		= $_REQUEST['summ_title_decor']; 
	$visual['summ_title_decor_hover'] 	= $_REQUEST['summ_title_decor_hover']; 
	
	// events list date style
	$visual['summ_edate_color'] 	= $_REQUEST['summ_edate_color']; 
	$visual['summ_edate_font'] 		= $_REQUEST['summ_edate_font']; 
	$visual['summ_edate_size'] 		= $_REQUEST['summ_edate_size']; 
	$visual['summ_edate_font_style']= $_REQUEST['summ_edate_font_style']; 
	$visual['summ_edate_format'] 	= $_REQUEST['summ_edate_format']; 
	$visual['summ_eshowing_time'] 	= $_REQUEST['summ_eshowing_time'];
	
	// events list location style
	$visual['summ_loc_font'] 		= $_REQUEST['summ_loc_font']; 
	$visual['summ_loc_color'] 		= $_REQUEST['summ_loc_color']; 
	$visual['summ_loc_size'] 		= $_REQUEST['summ_loc_size']; 
	$visual['summ_loc_font_weight']	= $_REQUEST['summ_loc_font_weight']; 
	$visual['summ_loc_font_style']	= $_REQUEST['summ_loc_font_style'];
	
	// events list price style
	$visual['summ_pric_font'] 		= $_REQUEST['summ_pric_font']; 
	$visual['summ_pric_color'] 		= $_REQUEST['summ_pric_color']; 
	$visual['summ_pric_size'] 		= $_REQUEST['summ_pric_size']; 
	$visual['summ_pric_font_weight']= $_REQUEST['summ_pric_font_weight']; 
	$visual['summ_pric_font_style']	= $_REQUEST['summ_pric_font_style']; 
	
	// events list category style
	$visual['cat_font'] 		= $_REQUEST['cat_font']; 
	$visual['cat_color'] 		= $_REQUEST['cat_color']; 
	$visual['cat_font_size'] 	= $_REQUEST['cat_font_size']; 
	$visual['cat_font_weight'] 	= $_REQUEST['cat_font_weight'];
	
	// "read more" link style
	$visual['more_font'] 					= $_REQUEST['more_font']; 
	$visual['more_color'] 					= $_REQUEST['more_color']; 
	$visual['more_color_hover'] 			= $_REQUEST['more_color_hover']; 
	$visual['more_font_size'] 				= $_REQUEST['more_font_size']; 
	$visual['more_font_weight'] 			= $_REQUEST['more_font_weight'];
	$visual['more_text_decoration'] 		= $_REQUEST['more_text_decoration'];
	$visual['more_text_decoration_hover'] 	= $_REQUEST['more_text_decoration_hover'];
	
	
	/////////// pagination style ///////////
	$visual['pag_font_family'] 		= $_REQUEST['pag_font_family']; 
	$visual['pag_font_color'] 		= $_REQUEST['pag_font_color'];
	$visual['pag_font_color_hover'] = $_REQUEST['pag_font_color_hover'];
	$visual['pag_font_color_sel'] 	= $_REQUEST['pag_font_color_sel'];
	$visual['pag_font_color_prn'] 	= $_REQUEST['pag_font_color_prn'];
	$visual['pag_color_prn_hover'] 	= $_REQUEST['pag_color_prn_hover'];	
	$visual['pag_font_color_ina'] 	= $_REQUEST['pag_font_color_ina'];
	$visual['pag_font_size'] 		= $_REQUEST['pag_font_size']; 
	$visual['pag_font_weight'] 		= $_REQUEST['pag_font_weight']; 	 
	$visual['pag_font_style'] 		= $_REQUEST['pag_font_style'];
	$visual['pag_align_to'] 		= $_REQUEST['pag_align_to'];
	
	
	// event details title
	$visual['title_color'] 			= $_REQUEST['title_color']; 
	$visual['title_font'] 			= $_REQUEST['title_font']; 
	$visual['title_size'] 			= $_REQUEST['title_size']; 
	$visual['title_font_weight']	= $_REQUEST['title_font_weight']; 
	$visual['title_font_style'] 	= $_REQUEST['title_font_style']; 
	$visual['title_text_align'] 	= $_REQUEST['title_text_align']; 
	$visual['title_line_height'] 	= $_REQUEST['title_line_height']; 
	
	// event details date style
	$visual['edate_color'] 		= $_REQUEST['edate_color']; 
	$visual['edate_font'] 		= $_REQUEST['edate_font']; 
	$visual['edate_size'] 		= $_REQUEST['edate_size']; 
	$visual['edate_font_weight']= $_REQUEST['edate_font_weight'];
	$visual['edate_font_style'] = $_REQUEST['edate_font_style']; 
	$visual['edate_format'] 	= $_REQUEST['edate_format']; 
	$visual['eshowhide_time'] 	= $_REQUEST['eshowhide_time'];
	$visual['eshowing_time'] 	= $_REQUEST['eshowing_time'];
	
	// event details publish date, A+/a- and article hits style
	$visual['show_aa'] 			= $_REQUEST['show_aa'];  
	$visual['showhits'] 		= $_REQUEST['showhits']; 
	$visual['show_date'] 		= $_REQUEST['show_date']; 
	$visual['date_color'] 		= $_REQUEST['date_color']; 
	$visual['date_font'] 		= $_REQUEST['date_font']; 
	$visual['date_size'] 		= $_REQUEST['date_size']; 
	$visual['date_font_weight']	= $_REQUEST['date_font_weight'];
	$visual['date_font_style'] 	= $_REQUEST['date_font_style']; 
	$visual['date_format'] 		= $_REQUEST['date_format']; 
	$visual['showing_time'] 	= $_REQUEST['showing_time'];
	$visual['show_text_align'] 	= $_REQUEST['show_text_align']; 
		
	// event details location style
	$visual['loc_font'] 		= $_REQUEST['loc_font']; 
	$visual['loc_color'] 		= $_REQUEST['loc_color']; 
	$visual['loc_size'] 		= $_REQUEST['loc_size']; 
	$visual['loc_font_weight']	= $_REQUEST['loc_font_weight']; 
	$visual['loc_font_style']	= $_REQUEST['loc_font_style']; 
	
	// event details price style
	$visual['pric_font'] 		= $_REQUEST['pric_font']; 
	$visual['pric_color'] 		= $_REQUEST['pric_color']; 
	$visual['pric_size'] 		= $_REQUEST['pric_size']; 
	$visual['pric_font_weight']	= $_REQUEST['pric_font_weight']; 
	$visual['pric_font_style']	= $_REQUEST['pric_font_style']; 
		
	// event details text content 
	$visual['cont_color'] 		= $_REQUEST['cont_color']; 
	$visual['cont_font'] 		= $_REQUEST['cont_font']; 
	$visual['cont_size'] 		= $_REQUEST['cont_size']; 
	$visual['cont_font_style'] 	= $_REQUEST['cont_font_style']; 
	$visual['cont_text_align'] 	= $_REQUEST['cont_text_align']; 
	$visual['cont_line_height'] = $_REQUEST['cont_line_height'];
	$visual['viewer_width']		= $_REQUEST['viewer_width']; 
	
		
	// links in the events text area
	$visual['links_font_color'] 			= $_REQUEST['links_font_color']; 
	$visual['links_font_color_hover']		= $_REQUEST['links_font_color_hover'];
	$visual['links_text_decoration'] 		= $_REQUEST['links_text_decoration'];
	$visual['links_text_decoration_hover'] 	= $_REQUEST['links_text_decoration_hover'];
	$visual['links_font_size'] 				= $_REQUEST['links_font_size'];
	$visual['links_font_style'] 			= $_REQUEST['links_font_style'];
	$visual['links_font_weight'] 			= $_REQUEST['links_font_weight'];
	
	
	// share buttons style
	$visual['show_share_this']  = $_REQUEST['show_share_this'];
	$visual['share_this_align'] = $_REQUEST['share_this_align']; 
	$visual['share_font_size'] 	= $_REQUEST['share_font_size'];
	
	
	//// SUBMIT EVENT FORM PAGE ////
	// submit event general styles
	$visual['subm_bkg_color'] 	= $_REQUEST['subm_bkg_color']; 
	$visual['subm_lab_font'] 	= $_REQUEST['subm_lab_font'];
	$visual['subm_lab_color'] 	= $_REQUEST['subm_lab_color']; 
	$visual['subm_lab_size']	= $_REQUEST['subm_lab_size']; 
	$visual['subm_lab_weight'] 	= $_REQUEST['subm_lab_weight']; 
	$visual['subm_lab_style'] 	= $_REQUEST['subm_lab_style']; 
	
	// submit event form fields styles
	$visual['subm_field_font'] 		= $_REQUEST['subm_field_font']; 
	$visual['subm_field_color'] 	= $_REQUEST['subm_field_color'];
	$visual['subm_field_bkg_col'] 	= $_REQUEST['subm_field_bkg_col']; 
	$visual['subm_field_size']		= $_REQUEST['subm_field_size']; 
	$visual['subm_field_bord_rad'] 	= $_REQUEST['subm_field_bord_rad']; 
	$visual['subm_field_bord_col'] 	= $_REQUEST['subm_field_bord_col'];  
	$visual['subm_field_padd'] 		= $_REQUEST['subm_field_padd'];  
	
	// submit event heading 
	$visual['subm_head_font'] 	= $_REQUEST['subm_head_font']; 
	$visual['subm_head_color'] 	= $_REQUEST['subm_head_color'];
	$visual['subm_head_size'] 	= $_REQUEST['subm_head_size']; 
	$visual['subm_head_weight']	= $_REQUEST['subm_head_weight']; 
	$visual['subm_head_style'] 	= $_REQUEST['subm_head_style']; 
	$visual['subm_head_align'] 	= $_REQUEST['subm_head_align']; 
	$visual['subm_head_height'] = $_REQUEST['subm_head_height'];
	
	// submit event submit button 
	$visual['subm_butt_font'] 		= $_REQUEST['subm_butt_font']; 
	$visual['subm_butt_color'] 		= $_REQUEST['subm_butt_color'];
	$visual['subm_butt_color_hov'] 	= $_REQUEST['subm_butt_color_hov']; 
	$visual['subm_butt_bkg_col']	= $_REQUEST['subm_butt_bkg_col']; 
	$visual['subm_butt_bkg_col_hov']= $_REQUEST['subm_butt_bkg_col_hov'];  
	$visual['subm_butt_size']		= $_REQUEST['subm_butt_size']; 
	
	
	// distances
	$visual['dist_title_date'] 		= $_REQUEST['dist_title_date'];
	$visual['summ_dist_title_date'] = $_REQUEST['summ_dist_title_date'];
	$visual['dist_date_text'] 		= $_REQUEST['dist_date_text'];
	$visual['dist_edate_etime'] 	= $_REQUEST['dist_edate_etime'];
	$visual['summ_dist_edate_etime']= $_REQUEST['summ_dist_edate_etime'];
	$visual['dist_etime_loc'] 		= $_REQUEST['dist_etime_loc'];
	$visual['dist_loc_price'] 		= $_REQUEST['dist_loc_price'];
	$visual['summ_dist_loc_price']	= $_REQUEST['summ_dist_loc_price'];
	$visual['dist_price_descr'] 	= $_REQUEST['dist_price_descr'];
	$visual['summ_dist_price_descr']= $_REQUEST['summ_dist_price_descr'];
	$visual['dist_btw_events'] 		= $_REQUEST['dist_btw_events'];	
	$visual['dist_link_title'] 		= $_REQUEST['dist_link_title'];
	
		
	$visual = serialize($visual);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `visual`='".SafetyDB($visual)."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='visual_options'; 
  	$message = $lang['Message_Visual_options_saved']; 

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateOptionsLanguage') {
	
	$language['Back_to_home'] 		= $_REQUEST['Back_to_home']; 
	$language['Search_button'] 		= $_REQUEST['Search_button'];
	$language['Submit_an_Event'] 	= $_REQUEST['Submit_an_Event'];
	$language['Event_Date'] 		= $_REQUEST['Event_Date'];
	$language['Event_Time'] 		= $_REQUEST['Event_Time'];
	$language['Category'] 			= $_REQUEST['Category'];
	$language['Category_all'] 		= $_REQUEST['Category_all']; 
	$language['Location'] 			= $_REQUEST['Location'];
	$language['Price'] 				= $_REQUEST['Price'];
	$language['Read_more'] 			= $_REQUEST['Read_more'];
	$language['Previous'] 			= $_REQUEST['Previous']; 
	$language['Next'] 				= $_REQUEST['Next'];  
	$language['No_events_published']= $_REQUEST['No_events_published']; 
	$language['Article_Hits'] 		= $_REQUEST['Article_Hits'];
	
	// days of the week in the dates
	$language['Monday'] 	= $_REQUEST['Monday']; 
	$language['Tuesday'] 	= $_REQUEST['Tuesday'];
	$language['Wednesday'] 	= $_REQUEST['Wednesday'];
	$language['Thursday'] 	= $_REQUEST['Thursday']; 
	$language['Friday'] 	= $_REQUEST['Friday']; 
	$language['Saturday'] 	= $_REQUEST['Saturday'];
	$language['Sunday'] 	= $_REQUEST['Sunday'];
	
	// month names in the dates
	$language['January'] 	= $_REQUEST['January']; 
	$language['February'] 	= $_REQUEST['February'];
	$language['March'] 		= $_REQUEST['March'];
	$language['April'] 		= $_REQUEST['April']; 
	$language['May'] 		= $_REQUEST['May']; 
	$language['June'] 		= $_REQUEST['June'];
	$language['July'] 		= $_REQUEST['July'];
	$language['August'] 	= $_REQUEST['August'];
	$language['September'] 	= $_REQUEST['September']; 
	$language['October'] 	= $_REQUEST['October']; 
	$language['November'] 	= $_REQUEST['November'];
	$language['December'] 	= $_REQUEST['December'];
	
	$language['metatitle'] 			= $_REQUEST['metatitle']; 
	$language['metadescription'] 	= $_REQUEST['metadescription'];
	
	
	// submit event page
	$language['Submit_Event_head'] 	= $_REQUEST['Submit_Event_head']; 
	$language['Submit_Date_Start'] 	= $_REQUEST['Submit_Date_Start']; 
	$language['Submit_Date_End'] 	= $_REQUEST['Submit_Date_End']; 
	$language['Submit_Time_Start'] 	= $_REQUEST['Submit_Time_Start']; 
	$language['Submit_Time_End'] 	= $_REQUEST['Submit_Time_End']; 
	$language['Submit_Hide'] 		= $_REQUEST['Submit_Hide'];
	$language['Submit_Title'] 		= $_REQUEST['Submit_Title'];
	$language['Description'] 		= $_REQUEST['Description'];
	$language['Submit_Price'] 		= $_REQUEST['Submit_Price'];
	$language['Submit_Price_info'] 	= $_REQUEST['Submit_Price_info'];
	//$language['Submit_Name'] 		= $_REQUEST['Submit_Name'];
	$language['Submit_Location'] 	= $_REQUEST['Submit_Location']; 
	$language['Submit_Location_info']= $_REQUEST['Submit_Location_info']; 
	$language['Submit_Image'] 		= $_REQUEST['Submit_Image'];
	$language['Submit_Image_info'] 	= $_REQUEST['Submit_Image_info'];
	$language['Submit_Email'] 		= $_REQUEST['Submit_Email']; 
	$language['Submit_Email_Info'] 	= $_REQUEST['Submit_Email_Info'];
	//$language['Submit_Phone'] 	= $_REQUEST['Submit_Phone'];
	$language['Enter_verify_code'] 	= $_REQUEST['Enter_verify_code'];
	$language['verify_placeholder'] = $_REQUEST['verify_placeholder'];
	$language['Submit_Required_fields'] = $_REQUEST['Submit_Required_fields'];
	$language['Submit_incorrect_verify_code'] = $_REQUEST['Submit_incorrect_verify_code'];
	$language['Submit_Fill_the_required_fields'] = $_REQUEST['Submit_Fill_the_required_fields'];
	$language['Submit_incorrect_email'] = $_REQUEST['Submit_incorrect_email'];
	$language['field_code'] 		= $_REQUEST['field_code']; 	
	$language['Event_has_been_submitted'] = $_REQUEST['Event_has_been_submitted'];
	$language['After_approve_will_publish'] = $_REQUEST['After_approve_will_publish'];
	
	// submit event email
	$language['New_event_submitted'] = $_REQUEST['New_event_submitted']; 
	$language['Thanks_for_submitting_event'] = $_REQUEST['Thanks_for_submitting_event']; 
	$language['Thanks_email_message'] = $_REQUEST['Thanks_email_message'];
	
	
	$language = serialize($language);
	
	$sql = "UPDATE ".$TABLE["Options"]." 
			SET `language`='".SaveDB($language)."'";
	$sql_result = sql_result($sql);
	$_REQUEST["act"]='language_options'; 
  	$message = $lang['Message_Language_options_saved']; 
 

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addEvent"){
	
	if($_REQUEST["eventdate"]>$_REQUEST["end_date"]) {
		$_REQUEST["end_date"]=$_REQUEST["eventdate"];
	} 
		
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["featured"]) or $_REQUEST["featured"]=='') $_REQUEST["featured"] = '2';
	if (!isset($_REQUEST["hide_endtime"]) or $_REQUEST["hide_endtime"]=='') $_REQUEST["hide_endtime"] = '';
	
	if($OptionsVis['eshowing_time']=='g:i a') {
		if(($_REQUEST["sAmPm"] == "am") and ($_REQUEST["starting_h"] > 11)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] - 12;
		if(($_REQUEST["sAmPm"] == "pm") and ($_REQUEST["starting_h"] < 12)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] + 12;

		if(($_REQUEST["eAmPm"] == "am") and ($_REQUEST["ending_h"] > 11)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] - 12;
		if(($_REQUEST["eAmPm"] == "pm") and ($_REQUEST["ending_h"] < 12)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] + 12;
	}
	
	$starting_t 	= $_REQUEST["starting_h"].":".$_REQUEST["starting_m"];
	$ending_t		= $_REQUEST["ending_h"].":".$_REQUEST["ending_m"];
	
	$sql = "INSERT INTO ".$TABLE["Events"]." 
			SET `publish_date` 	= '".SaveDB($_REQUEST["publish_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."', 
				`cat_id` 		= '".SaveDB($_REQUEST["cat_id"])."', 
				`featured` 		= '".SaveDB($_REQUEST["featured"])."',  
				`eventdate` 	= '".SaveDB($_REQUEST["eventdate"])."', 
				`end_date` 		= '".SaveDB($_REQUEST["end_date"])."',  
				`starting_t` 	= '".SaveDB($starting_t)."', 
				`ending_t` 		= '".SaveDB($ending_t)."',   
				`hide_endtime` 	= '".SaveDB($_REQUEST["hide_endtime"])."', 
				`location` 		= '".SaveDB($_REQUEST["location"])."', 
				`price` 		= '".SaveDB($_REQUEST["price"])."',
				`title` 		= '".SaveDB($_REQUEST["title"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`imgwidth` 		= '".SaveDB($_REQUEST["imgwidth"])."', 
				`email` 		= '".SaveDB($_REQUEST["email"])."', 
				`reviews` 		= '0'";
	$sql_result = sql_result($sql);	
	
	$index_id = mysqli_insert_id($connEV);
	
	// upload image to the event
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
		
		$filexpl = explode(".", $_FILES["image"]['name']);
		$format = end($filexpl);					
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");			
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
		
			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;

			$filePath = $CONFIG["upload_folder"] . $name;
			$thumbPath = $CONFIG["upload_thumbs"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath, 0777);
				Resize_File($filePath, $OptionsVis["viewer_width"], 0); 
				//Resize_File($filePath, $OptionsVis["summ_img_width"], 0, $thumbPath);
				Resize_File($filePath, 600, 0, $thumbPath);
	
				$sql = "UPDATE ".$TABLE["Events"]."  
						SET `image` = '".$name."'  
						WHERE id='".$index_id."'";
				$sql_result = sql_result($sql);
				$message .= '';
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folder"].'" directory! ';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	} else { $message = $lang['Message_Image_file_is_not_uploaded']; }
		
	include('rss_generate_xml.php');	
	
	$_REQUEST["act"] = "events";		
	$message .= $lang['Message_Item_created'];
	

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='updateEvent') {
	
	if($_REQUEST["eventdate"]>$_REQUEST["end_date"]) {
		$_REQUEST["end_date"]=$_REQUEST["eventdate"];
	} 
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	if (!isset($_REQUEST["featured"]) or $_REQUEST["featured"]=='') $_REQUEST["featured"] = '2';
	if (!isset($_REQUEST["hide_endtime"]) or $_REQUEST["hide_endtime"]=='') $_REQUEST["hide_endtime"] = '';
	
	if($OptionsVis['eshowing_time']=='g:i a') {
		if(($_REQUEST["sAmPm"] == "am") and ($_REQUEST["starting_h"] > 11)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] - 12;
		if(($_REQUEST["sAmPm"] == "pm") and ($_REQUEST["starting_h"] < 12)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] + 12;

		if(($_REQUEST["eAmPm"] == "am") and ($_REQUEST["ending_h"] > 11)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] - 12;
		if(($_REQUEST["eAmPm"] == "pm") and ($_REQUEST["ending_h"] < 12)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] + 12;
	}
	
	$starting_t 	= $_REQUEST["starting_h"].":".$_REQUEST["starting_m"];
	$ending_t		= $_REQUEST["ending_h"].":".$_REQUEST["ending_m"];

	$sql = "UPDATE ".$TABLE["Events"]." 
			SET `publish_date` 	= '".SaveDB($_REQUEST["publish_date"])."',
				`status` 		= '".SaveDB($_REQUEST["status"])."',
				`cat_id` 		= '".SaveDB($_REQUEST["cat_id"])."', 
				`featured` 		= '".SaveDB($_REQUEST["featured"])."',  
				`eventdate` 	= '".SaveDB($_REQUEST["eventdate"])."', 
				`end_date` 		= '".SaveDB($_REQUEST["end_date"])."',  
				`starting_t` 	= '".SaveDB($starting_t)."', 
				`ending_t` 		= '".SaveDB($ending_t)."',   
				`hide_endtime` 	= '".SaveDB($_REQUEST["hide_endtime"])."', 
				`location` 		= '".SaveDB($_REQUEST["location"])."', 
				`price` 		= '".SaveDB($_REQUEST["price"])."',
				`title` 		= '".SaveDB($_REQUEST["title"])."',
				`content` 		= '".SaveDB($_REQUEST["content"])."',
				`imgwidth` 		= '".SaveDB($_REQUEST["imgwidth"])."',  
				`email` 		= '".SaveDB($_REQUEST["email"])."' 
			WHERE id='".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id = '".SafetyDB($_REQUEST["id"])."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	
	$index_id = SafetyDB($_REQUEST["id"]);
	
	// upload image to the event 
	if (is_uploaded_file($_FILES["image"]['tmp_name'])) { 
	
		$filexpl = explode(".", $_FILES["image"]['name']);
		$format = end($filexpl);			
		$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");
		if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
		
			if($image != "") unlink($CONFIG["upload_folder"].$image);
			if($image != "") unlink($CONFIG["upload_thumbs"].$image);
			
			$name = str_file_filter($_FILES['image']['name']);
			$name = $index_id . "_" . $name;
			
			$filePath = $CONFIG["upload_folder"] . $name;
			$thumbPath = $CONFIG["upload_thumbs"] . $name;
			
			if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
				chmod($filePath,0777); 				
				Resize_File($filePath, $OptionsVis["viewer_width"], 0); 
				//Resize_File($filePath, $OptionsVis["summ_img_width"], 0, $thumbPath);
				Resize_File($filePath, 600, 0, $thumbPath);
				
				$sql = "UPDATE `".$TABLE["Events"]."` 
						SET `image` = '".SafetyDB($name)."' 
						WHERE id = '".$index_id."'";
				$sql_result = sql_result($sql);
			} else {
				$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folder"].'" directory.';  
			}
		} else {
			$message = $lang['Message_File_must_be_in_image_format'];   
		}
	}
	
	include('rss_generate_xml.php');
	
	$_REQUEST["act"]='events'; 
	$message .= $lang['Message_Item_updated'];
	
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delEvent') {
	
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);

	$sql = "DELETE FROM ".$TABLE["Events"]." WHERE id='".$_REQUEST["id"]."'";
   	$sql_result = sql_result($sql);
 	$_REQUEST["act"]='events'; 
	$message = $lang['Message_Item_deleted'];
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=="delImage") { 
	
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$imageArr = mysqli_fetch_assoc($sql_result);
	$image = ReadDB($imageArr["image"]);
	if($image != "") unlink($CONFIG["upload_folder"].$image);
	if($image != "") unlink($CONFIG["upload_thumbs"].$image);
	
	$sql = "UPDATE `".$TABLE["Events"]."` SET `image` = '' WHERE id = '".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	
	$message = $lang['Message_Image_deleted'];
	$_REQUEST["act"] = "editEvent";

} elseif (isset($_REQUEST["act2"]) and $_REQUEST["act2"]=="change_status_event") { 
	
	$sql = "UPDATE ".$TABLE["Events"]." 
			SET `status` = '".SaveDB($_REQUEST["status"])."' 
			WHERE `id` = '".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	
	$message = $lang['Message_Status_Updated'];
	$_REQUEST["act"] = "events";
	
} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "addCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE `cat_name` = '".SafetyDB(trim($_REQUEST["cat_name"]))."'";
    $sql_result = sql_result($sql);
    if(mysqli_num_rows($sql_result) == 0) {

        $sql = "INSERT INTO ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDB($_REQUEST["cat_name"])."'";
        $sql_result = sql_result($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_added'];

    } else {
        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];
    }


} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"] == "updateCat"){

    $sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE cat_name='".SafetyDB($_REQUEST["cat_name"])."'";
    $sql_result = sql_result($sql);
    if(mysqli_num_rows($sql_result)>1) {

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_exist'];

    } else {

        $sql = "UPDATE ".$TABLE["Categories"]."
				SET `cat_name` = '".SafetyDB($_REQUEST["cat_name"])."'
				WHERE id='".$_REQUEST["id"]."'";
        $sql_result = sql_result($sql);

        $_REQUEST["act"] = "cats";
        $message .= $lang['Message_Categ_updated'];

    }

} elseif (isset($_REQUEST["act"]) and $_REQUEST["act"]=='delCat') {

    $sql = "DELETE FROM ".$TABLE["Categories"]." WHERE id='".SafetyDB($_REQUEST["id"])."'";
    $sql_result = sql_result($sql);
    $_REQUEST["act"]='cats';
    $message = $lang['Message_Categ_deleted'];
	
}

if (!isset($_REQUEST["act"]) or $_REQUEST["act"]=='') $_REQUEST["act"]='events';

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}

$_SESSION['KCFINDER'] = array(
    'disabled' => false
);

if(!isset($_REQUEST["exp"])) $_REQUEST["exp"] = '';

$sqlExp = "SELECT id FROM ".$TABLE["Events"]." WHERE `end_date` < '".date("Y-m-d")."'";
$sql_resultExp = sql_result($sqlExp);
$ExpCount = mysqli_num_rows($sql_resultExp);

if($ExpCount>0) { $numExpEvents = "(".$ExpCount.")"; } else { $numExpEvents = ""; }
?>    

<div class="menuButtons">
    <div class="menuButton"><a<?php if($_REQUEST['act']=='events' or $_REQUEST['act']=='newEvent' or $_REQUEST['act']=='editEvent' or $_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=events"><span><?php echo $lang['menu_1']; ?></span></a></div>  
    
    <div class="menuButton"><a<?php if($_REQUEST['act']=='cats' or $_REQUEST['act']=='newCat' or $_REQUEST['act']=='editCat' or $_REQUEST['act']=='HTML_Cat') echo ' class="selected"'; ?> href="admin.php?act=cats"><span><?php echo $lang['menu_2']; ?></span></a></div> 
      
    <div class="menuButton"><a<?php if($_REQUEST['act']=='options' or $_REQUEST['act']=='event_options' or $_REQUEST['act']=='visual_options' or $_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=options"><span><?php echo $lang['menu_3']; ?></span></a></div>      
    
    <div class="menuButton"><a<?php if($_REQUEST['act']=='html') echo ' class="selected"'; ?> href="admin.php?act=html"><span><?php echo $lang['menu_4'] ?></span></a></div>    
    
    <div class="welcome">Hello <?php echo $CONFIG["admin_user"]; ?>!</div>
    <div class="clear"></div>        
</div>	

<div class="admin_wrapper">

<?php
if ($_REQUEST["act"]=='events' or $_REQUEST["exp"]=='yes' or $_REQUEST["act"]=='newEvent' or $_REQUEST["act"]=='editEvent' or $_REQUEST["act"]=='rss') {
?>
    <div class="menuSubButton"><a<?php if(($_REQUEST['act']=='events' or $_REQUEST['act']=='editEvent') and (!isset($_REQUEST['exp']) or $_REQUEST['exp']!='yes')) echo ' class="selected"'; ?> href="admin.php?act=events"><?php echo $lang['menu_1_1']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newEvent') echo ' class="selected"'; ?> href="admin.php?act=newEvent"><?php echo $lang['menu_1_3']; ?></a></div>
    <div class="menuSubButton"><a<?php if(isset($_REQUEST['exp']) and $_REQUEST['exp']=='yes') echo ' class="selected"'; ?> href="admin.php?act=events&exp=yes"><?php echo $lang['menu_1_2']; ?><?php echo $numExpEvents; ?></a></div>
    <div class="menuSubButton"><a href="preview.php" target="_blank"><?php echo $lang['menu_1_4']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='rss') echo ' class="selected"'; ?> href="admin.php?act=rss"><?php echo $lang['menu_1_5']; ?></a></div>
    <div class="clear"></div>                    


<?php
} elseif ($_REQUEST["act"]=='cats' or $_REQUEST["act"]=='newCat' or $_REQUEST["act"]=='editCat' or $_REQUEST['act']=='HTML_Cat') {
?>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='cats') echo ' class="selected"'; ?> href="admin.php?act=cats"><?php echo $lang['menu_Categories_List']; ?></a></div>
    <div class="menuSubButton"><a<?php if($_REQUEST['act']=='newCat') echo ' class="selected"'; ?> href="admin.php?act=newCat"><?php echo $lang['menu_Create_Category']; ?></a></div>
    <div class="clear"></div>  



<?php 
} elseif ($_REQUEST["act"]=='options' or $_REQUEST['act']=='event_options' or $_REQUEST["act"]=='visual_options' or $_REQUEST["act"]=='language_options') { 
?>	
	  <div class="menuSubButton"><a<?php if($_REQUEST['act']=='options') echo ' class="selected"'; ?> href="admin.php?act=options"><?php echo $lang['menu_2_1']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='event_options') echo ' class="selected"'; ?> href="admin.php?act=event_options"><?php echo $lang['menu_2_2']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='visual_options') echo ' class="selected"'; ?> href="admin.php?act=visual_options"><?php echo $lang['menu_2_3']; ?></a></div>
      <div class="menuSubButton"><a<?php if($_REQUEST['act']=='language_options') echo ' class="selected"'; ?> href="admin.php?act=language_options" style="background:none;"><?php echo $lang['menu_2_4']; ?></a></div>
      <div class="clear"></div>        

<?php } ?>



	<?php if(isset($message) and $message!='') {?>
    <div class="message"><?php echo $message; ?></div>
    <?php } ?>
    <script type="text/javascript">	
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery("div.message").fadeOut("slow", function () {
				jQuery("div.message").remove();
			});
	 
		}, 3500);
	 });
	</script>
    

<?php 
if ($_REQUEST["act"]=='events') { 
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize($Options['language']);
	
	list($OptOrderBy, $OptOrderType) = explode(" ", $Options['orderby']);
	if($OptOrderBy== "") $OptOrderBy = "eventdate";
	if($OptOrderType== "") $OptOrderType = "ASC";
	
	if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') {
		$_REQUEST["search"] = htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES);
	} else { 
		$_REQUEST["search"] = ''; 
	} 
	if(!isset($_REQUEST["orderBy"]))  $_REQUEST["orderBy"] = ''; 
	if(!isset($_REQUEST["orderType"])) $_REQUEST["orderType"] = ''; 
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("title", "eventdate", "publish_date", "status", "cat_id", "reviews");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = $OptOrderBy;
	}
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = $OptOrderType;
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
	
	/* if(isset($_REQUEST['exp']) and $_REQUEST['exp']=="yes") {
		$search .= " WHERE end_date < '".date("Y-m-d")."'";
	} else {
		$search .= " WHERE end_date >= '".date("Y-m-d")."'";
	} */
	
	$sqlPublished   = "SELECT id FROM ".$TABLE["Events"]." WHERE status='Published' AND `end_date` >= '".date("Y-m-d")."'";
	$sql_resultPublished = sql_result($sqlPublished);
	$ItemsPublished = mysqli_num_rows($sql_resultPublished);
	
	$sqlCount   = "SELECT id FROM ".$TABLE["Events"]." WHERE `end_date` >= '".date("Y-m-d")."'";
	$sql_resultCount = sql_result($sqlCount);
	$ItemsCount = mysqli_num_rows($sql_resultCount);
	
	if(!isset($_REQUEST['exp']) or $_REQUEST['exp']!="yes") {
?>
	<div class="pageDescr"><?php echo $lang['List_Below_is_a_list']; ?> <strong style="font-size:16px"><?php echo $ItemsPublished; ?></strong> <?php echo $lang['List_events_published']; ?> <strong style="font-size:16px"><?php echo $ItemsCount; ?></strong>.</div>
    <?php 
	} else {
	?>
    <div class="pageDescr"><?php echo $lang['List_Below_is_a_list_exp']; ?></div>
    <?php 
	}
	?>
    
    <div class="searchForm">
    <form action="admin.php?act=events" method="post" name="form" class="formStyle">
      <input type="text" name="search" value="<?php echo urldecode($_REQUEST["search"]); ?>" class="searchfield" placeholder="<?php echo $lang['List_Search_placeholder']; ?>" />
      <input type="submit" value="<?php echo $lang['List_Search_Button']; ?>" class="submitButton" />
    </form>
    </div>
    

	<table class="allTables">
  	  <tr>
        <td class="headlist"><a href="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=title"><?php echo $lang['List_Title']; ?></a></td>
        <td width="20%" class="headlist"><a href="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=eventdate"><?php echo $lang['List_EventDate']; ?></a></td>        
        <td width="15%" class="headlist"><?php echo $lang['List_EventTime']; ?></td>
        <td width="15%" class="headlist"><a href="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=publish_date"><?php echo $lang['List_Date_published']; ?></a></td>
        <td width="9%" class="headlist"><a href="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=status"><?php echo $lang['List_Status']; ?></a></td>
        
        <td width="8%" class="headlist"><a href="admin.php?act=events&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=cat_id"><?php echo $lang['List_Category']; ?></a></td>
        
        <td width="5%" class="headlist"><a href="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>&orderType=<?php echo $norderType; ?>&search=<?php echo urlencode($_REQUEST["search"]); ?>&orderBy=reviews"><?php echo $lang['List_Reviews']; ?></a></td>
        <td class="headlist" colspan="2" width="10%">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$search = '';
	
	if(isset($_REQUEST['exp']) and $_REQUEST['exp']=="yes") {
		$search .= " WHERE end_date < '".date("Y-m-d")."'";
	} else {
		$search .= " WHERE end_date >= '".date("Y-m-d")."'";
	}
	
	if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
	  $findMe = SafetyDB($_REQUEST["search"]);
	  $search .= " AND `title` LIKE '%".$findMe."%' or `location` LIKE '%".$findMe."%' or `content` LIKE '%".$findMe."%'";
	} 
	
	/* if($Options["hideexpadm"]=="yes") {
		$search .= " AND CONCAT_WS(' ',CAST(end_date AS CHAR),CAST(ending_t AS CHAR)) >= '".date("Y-m-d H:i:s")."'";
	} */

	$sql   = "SELECT count(*) as total FROM ".$TABLE["Events"]." ".$search;
	$sql_result = sql_result($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/100);

	$sql = "SELECT * FROM ".$TABLE["Events"]." ".$search." 
			ORDER BY featured ASC, " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*100 . ",100";
	$sql_result = sql_result($sql);
	
	if (mysqli_num_rows($sql_result)>0) {
		$i=1;
		while ($Event = mysqli_fetch_assoc($sql_result)) {		
	?>
  	  <tr>
        <td class="bodylist" style="font-weight:normal; <?php if($Event["end_date"] < date('Y-m-d')) { echo ' color:#F00;'; }?>; <?php if($Event["featured"]=="1") { echo ' border-left:solid 4px #3877b8;'; }?>"><?php echo ReadHTML($Event["title"]); ?></td>
        <td class="bodylist">
        	<?php 
			$start_dt = $Event["eventdate"]." ".$Event["starting_t"];
			$end_time = $Event["eventdate"]." ".$Event["ending_t"];
			
			if($Event["end_date"]>$Event["eventdate"]) {
				$end_day = $Event["end_date"]." ".$Event["starting_t"];
			}			
			?>
            <?php 
			echo lang_date(date($OptionsVis["edate_format"],strtotime($start_dt))); 
			
			if($Event["end_date"]>$Event["eventdate"]) { 
				echo " - ". lang_date(date($OptionsVis["edate_format"],strtotime($end_day))); 
			} 
			?>
        </td>
        <td class="bodylist">
        	<?php echo date($OptionsVis["eshowing_time"],strtotime($start_dt)); if($Event['hide_endtime']!="yes") { echo "&nbsp;-&nbsp;".date($OptionsVis["eshowing_time"],strtotime($end_time)); } ?>
        </td>
        <td class="bodylist"><?php echo admin_date($Event["publish_date"]); ?></td>
        <td class="bodylist">
        	<form action="admin.php?act=events&exp=<?php echo $_REQUEST["exp"]; ?>" method="post" name="form<?php echo $i; ?>" class="formStyle">
            <input type="hidden" name="act2" value="change_status_event" />
            <input type="hidden" name="id" value="<?php echo $Event["id"]; ?>" />
            <select name="status" onChange="document.form<?php echo $i; ?>.submit()">
                <option value="Published"<?php if($Event['status']=='Published') echo " selected='selected'"; ?>>Published</option>
                <option value="Hidden"<?php if($Event['status']=='Hidden') echo " selected='selected'"; ?>>Hidden</option>
            </select>
            </form>	        
        </td>           
        <td class="bodylist">
        	<?php 
			$sqlCat = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$Event["cat_id"]."'";
			$sql_resultCat = sql_result($sqlCat);
			$Cat = mysqli_fetch_assoc($sql_resultCat);	
			if($Cat["id"]>0) echo ReadDB($Cat["cat_name"]); else echo "------"; ?>
        </td>         
        <td class="bodylist"><?php if($Event["reviews"]=='') echo "0"; else echo $Event["reviews"]; ?></td>
        <td class="bodylistAct"><a href='admin.php?act=editEvent&id=<?php echo $Event["id"]; ?>&exp=<?php echo $_REQUEST["exp"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delEvent&id=<?php echo $Event["id"]; ?>&exp=<?php echo $_REQUEST["exp"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
		$i++;
		}
	} else {
	?>
      <tr>
      	<td colspan="9" class="borderBottomList"><?php echo $lang['List_No_Entries']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>0) {
    ?>
  	  <tr>
      	<td colspan="9" class="bottomlist"><div class='paging'><?php echo $lang['List_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=events&p=".$i."&search=".$_REQUEST["search"]."&amp;orderBy=".$_REQUEST["orderBy"]."&amp;orderType=".$_REQUEST["orderType"]."&exp=".$_REQUEST["exp"]."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
    <tr>
      	<td colspan="9">
            <table class="table_bottom">
              <tr>
                <td width="12px" style="background-color:#3877b8;">&nbsp;</td>
                <td style="padding-left:4px; text-align:left;"> <?php echo $lang['List_featured']; ?></td>
              </tr>
            </table>
    	</td>
      </tr>
	</table>
    

<?php 
} elseif ($_REQUEST["act"]=='newEvent') { 
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
?>
	<form action="admin.php" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="addEvent" />
  	<div class="pageDescr"><?php echo $lang['Create_Event_To_create_event']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['Create_Event']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_Event_Status']; ?></td>
      	<td class="formRight">
            <select name="status">
              <option value="Published"><?php echo $lang['Create_Event_Published']; ?></option>
              <option value="Hidden"><?php echo $lang['Create_Event_Hidden']; ?></option>
            </select>
      	</td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['Create_Event_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_result($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Featured']; ?></td>
        <td class="formRight"><input name="featured" type="checkbox" value="1" /> <?php echo $lang['Create_Event_Feat_info']; ?></td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Date']; ?></td>
        <td class="formRight">        
        	<?php 			
			if($OptionsVis['eshowing_time']=='g:i a') {
				$startAt = 0;
				$endAt = 12;
			} else {
				$startAt = 0;
				$endAt = 23;
			}			
			?>           
        	<table class="table_inside">
              <tr>
                <td align="left" width="33%">
                	<?php echo $lang['Create_Event_Date_Start']; ?> <input type="text" name="eventdate" id="eventdate" maxlength="10" size="12" value="<?php echo date("Y-m-d"); ?>" onclick="copyIt()" onchange="copyIt()" readonly /> <a href="javascript:NewCssCal('eventdate','yyyyMMdd','arrow')"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
                </td>
                <script type = "text/javascript">
				function copyIt() {
					var x = document.getElementById("eventdate").value;
					document.getElementById("end_date").value = x;
				}
				</script>  	
                <td align="left"><?php echo $lang['Create_Event_Date_End']; ?>
                	<input type="text" name="end_date" id="end_date" maxlength="10" size="12" value="<?php echo date("Y-m-d"); ?>" readonly /> <a href="javascript:NewCssCal('end_date','yyyyMMdd','arrow')"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a> <?php echo $lang['Create_Event_Date_Info']; ?> 
                </td>           
                
              </tr>
            </table>
        </td>
      </tr>       
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Time']; ?></td>
        <td class="formRight">        
        	<?php 			
			if($OptionsVis['eshowing_time']=='g:i a') {
				$startAt = 0;
				$endAt = 12;
			} else {
				$startAt = 0;
				$endAt = 23;
			}			
			?>        	
        	<table class="table_inside">
              <tr>
                <td align="left" width="33%"><?php echo $lang['Create_Event_Time_Start']; ?> 
                	<select name="starting_h">
                    	<?php 						
						for ($i=$startAt; $i<=$endAt; $i++){?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>h</option>
                        <?php } ?>
                    </select>
                    <select name="starting_m">
                    	<?php for($i=0; $i<=59; $i+=5) {?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>m</option>
                        <?php } ?>
                    </select>
                    <?php
					if($OptionsVis['eshowing_time']=='g:i a') {
					?>
                    <select name="sAmPm">
                        <option value="am">AM</option>
                        <option value="pm">PM</option>
                    </select>
					<?php
					}
					?>
                </td>
                <td align="left"><?php echo $lang['Create_Event_Time_End']; ?>
                	<select name="ending_h">
                    	<?php 
						for ($i=$startAt; $i<=$endAt; $i++){
						?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>h</option>
                        <?php } ?>
                    </select>
                	<select name="ending_m">
                    	<?php for($i=0; $i<=59; $i+=5) {?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>m</option>
                        <?php } ?>
                    </select>
                    <?php
					if($OptionsVis['eshowing_time']=='g:i a') {
					?>
                    <select name="eAmPm">
                        <option value="am">AM</option>
                        <option value="pm">PM</option>
                    </select>
					<?php
					}
					?>	
                    &nbsp;
                    <input name="hide_endtime" type="checkbox" value="yes" /> <?php echo $lang['Create_Event_Time_Info']; ?>
                </td>
              </tr>
            </table>
        </td>
      </tr>
      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Location']; ?></td>
        <td align="formRight">
        	<table class="table_loc_pric">
              <tr>
                <td align="left" width="70%"><input class="input_post" type="text" name="location" maxlength="250" /></td>
                <td align="left"><?php echo $lang['Create_Event_Price']; ?>&nbsp;
                	<input class="input_post" type="text" name="price" maxlength="250" />
                </td>
              </tr>
            </table>
        </td>
      </tr>
         
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="title" maxlength="250" /></td>
      </tr>     
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['Create_Event_Content']; ?></td>
        <td class="formRight">
        	<textarea name="content" id="content" class="content" cols="85" rows="20"></textarea>
            
            <script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
					
					<?php if(isset($Options['htmleditor']) and $Options['htmleditor']=="plug") { ?>
					extraPlugins: 'imageuploader,youtube,slimbox,oembed,widget,lineutils,codesnippet,pastecode',
					filebrowserUploadUrl : 'ckeditor/plugins/imageuploader/fileupload.php',
					<?php } else { ?>
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
					<?php } ?>	
									
					height: 400, width: '98%'

				});
			</script>  
        </td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Photo']; ?></td>
        <td class="formRight"><input type="file" name="image" size="80" /> <sub><?php echo $lang['Create_Event_Limit_Mb']; ?></sub></td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Image width']; ?></td>
        <td class="formRight">
        	<select name="imgwidth">
            	<?php for($i=700; $i>=80; $i=$i-20) {?>
            	<option value="<?php echo $i;?>px"<?php if($i=='380px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Publish_Email']; ?></td>
        <td class="formRight"><input type="text" name="email" size="50" maxlength="250" /></td>
      </tr>     
      <tr>
        <td class="formLeft"><?php echo $lang['Create_Event_Publish_date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','arrow',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
        </td>
      </tr>     
      <tr>
        <td>&nbsp;</td>
        <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Create_Event_button']; ?>" class="submitButton" /></td>
      </tr>
  	</table>
	</form>
    

<?php 
} elseif ($_REQUEST["act"]=='editEvent') {
	
	$_REQUEST["id"]= (int) SafetyDB($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$Event = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	
	list($starting_h, $starting_m, $starting_s) = explode(':', $Event['starting_t']);
	
	list($ending_h, $ending_m, $ending_s) = explode(':', $Event['ending_t']);
	
	$sAmPm = "am";
	$eAmPm = "am";
	
	if($OptionsVis['eshowing_time']=='g:i a') {
		if($starting_h==12) $sAmPm = "pm";
		if($starting_h==0) $starting_h = 12;
		if($starting_h>12) {
			$starting_h = $starting_h - 12;
			$sAmPm = "pm";
		}
		
		if($ending_h==12) $eAmPm = "pm";
		if($ending_h==0) $ending_h = 12;
		if($ending_h>12) {
			$ending_h = $ending_h - 12;
			$eAmPm = "pm";
		}
	}
?>
	<form action="admin.php?exp=<?php echo $_REQUEST["exp"]; ?>" method="post" name="form" enctype="multipart/form-data">
  	<input type="hidden" name="act" value="updateEvent" />
  	<input type="hidden" name="id" value="<?php echo $Event["id"]; ?>" />
  	<div class="pageDescr"><?php echo $lang['edit_Event_To_edit_Event']; ?></div>
	<table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
      <tr>
      	<td colspan="2" valign="top" class="headlist"><?php echo $lang['edit_Event']; ?></td>
      </tr>
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_Event_Status']; ?></td>
      	<td>
            <select name="status">
              	<option value="Published"<?php if ($Event["status"]=='Published') echo ' selected="selected"'; ?>><?php echo $lang['edit_Event_Published']; ?></option>
              	<option value="Hidden"<?php if ($Event["status"]=='Hidden') echo ' selected="selected"'; ?>><?php echo $lang['edit_Event_Hidden']; ?></option>
            </select>
      	</td>
      </tr> 
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_Event_Category']; ?> </td>
      	<td class="formRight">
        	<select name="cat_id">
            	<option value="0">---------</option>
			<?php
            $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY cat_name ASC";
            $sql_result = sql_result($sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($Cat = mysqli_fetch_assoc($sql_result)) {
            ?>
         		<option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$Event["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
            <?php
			  }
			} 
			?>
      		</select>
		</td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Featured']; ?></td>
        <td><input name="featured" type="checkbox" value="1"<?php if($Event["featured"]=='1') echo ' checked="checked"'; ?> /> <?php echo $lang['edit_Event_Feat_info']; ?></td>
      </tr>  
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Date']; ?></td>
        <td class="formRight">
        	<?php 			
			if($OptionsVis['eshowing_time']=='g:i a') {
				$startAt = 0;
				$endAt = 12;
			} else {
				$startAt = 0;
				$endAt = 23;
			}			
			?>  
        	<table class="table_inside">
              <tr>
                <td align="left" width="33%"><?php echo $lang['edit_Event_Date_Start']; ?>
                	<input type="text" name="eventdate" id="eventdate" maxlength="10" size="12" value="<?php echo ReadDB($Event["eventdate"]); ?>" readonly /> <a href="javascript:NewCssCal('eventdate','yyyyMMdd','arrow')"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a>
                </td>
                <td align="left"><?php echo $lang['edit_Event_Date_End']; ?> 
                	<input type="text" name="end_date" id="end_date" maxlength="10" size="12" value="<?php echo ReadDB($Event["end_date"]); ?>" readonly /> <a href="javascript:NewCssCal('end_date','yyyyMMdd','arrow')"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" /></a> <?php echo $lang['edit_Event_Date_Info']; ?>                 
                </td>          
                
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Time']; ?></td>
        <td class="formRight">
        	<?php 			
			if($OptionsVis['eshowing_time']=='g:i a') {
				$startAt = 0;
				$endAt = 12;
			} else {
				$startAt = 0;
				$endAt = 23;
			}			
			?>  
        	<table class="table_inside">
              <tr> 
                
                <td align="left" width="33%">
                <?php echo $lang['edit_Event_Time_Start']; ?> 
                	<select name="starting_h">
                    	<?php 
						for ($i=$startAt; $i<=$endAt; $i++){
						?>
                        <option value="<?php echo $i; ?>"<?php if($i==$starting_h) echo ' selected="selected"'; ?>><?php echo $i; ?>h</option>
                        <?php } ?>
                    </select>
                    <select name="starting_m">
                    	<?php for($i=0; $i<=59; $i+=5) {?>
                        <option value="<?php echo $i; ?>"<?php if($i==$starting_m) echo ' selected="selected"'; ?>><?php echo $i; ?>m</option>
                        <?php } ?>
                    </select>
                    <?php
					if($OptionsVis['eshowing_time']=='g:i a') {
					?>
                    <select name="sAmPm">
                        <option value="am"<?php if($sAmPm=="am") echo " selected"; ?>>AM</option>
                        <option value="pm"<?php if($sAmPm=="pm") echo " selected"; ?>>PM</option>
                    </select>
					<?php
					}
					?>	
                </td>
                <td align="left">
                <?php echo $lang['edit_Event_Time_End']; ?>
                	<select name="ending_h">
                    	<?php
						for ($i=$startAt; $i<=$endAt; $i++){
						?>
                        <option value="<?php echo $i; ?>"<?php if($i==$ending_h) echo ' selected="selected"'; ?>><?php echo $i; ?>h</option>
                        <?php } ?>
                    </select>
                	<select name="ending_m">
                    	<?php for($i=0; $i<=59; $i+=5) {?>
                        <option value="<?php echo $i; ?>"<?php if($i==$ending_m) echo ' selected="selected"'; ?>><?php echo $i; ?>m</option>
                        <?php } ?>
                    </select>
                    <?php
					if($OptionsVis['eshowing_time']=='g:i a') {
					?>
                    <select name="eAmPm">
                        <option value="am"<?php if($eAmPm=="am") echo " selected"; ?>>AM</option>
                        <option value="pm"<?php if($eAmPm=="pm") echo " selected"; ?>>PM</option>
                    </select>
					<?php
					}
					?>	
                    &nbsp;
                    <input name="hide_endtime" type="checkbox" value="yes"<?php if($Event["hide_endtime"]=='yes') echo ' checked="checked"'; ?> /> <?php echo $lang['edit_Event_Time_Info']; ?>
                </td>
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Location']; ?></td>
        <td align="left">
        	<table class="table_loc_pric">
              <tr>
                <td align="left" width="70%"><input class="input_post" type="text" name="location" maxlength="250" value="<?php echo ReadHTML($Event["location"]); ?>" /></td>
                <td align="left"><?php echo $lang['edit_Event_Price']; ?><input class="input_post" type="text" name="price" maxlength="250" value="<?php echo ReadHTML($Event["price"]); ?>" />
                </td>
              </tr>
            </table>
        </td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Title']; ?></td>
        <td class="formRight"><input class="input_post" type="text" name="title" maxlength="250" value="<?php echo ReadHTML($Event["title"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="formLeft" valign="top"><?php echo $lang['edit_Event_Content']; ?></td>
        <td class="formRight">
        	<textarea name="content" id="content" class="content" cols="85" rows="20"><?php echo ReadDB($Event["content"]); ?></textarea>
           	<script type="text/javascript">
				CKEDITOR.replace( 'content',
                {	
					
					<?php if(isset($Options['htmleditor']) and $Options['htmleditor']=="plug") { ?>
					extraPlugins: 'imageuploader,youtube,slimbox,oembed,widget,lineutils,codesnippet,pastecode',
					filebrowserUploadUrl : 'ckeditor/plugins/imageuploader/fileupload.php',
					<?php } else { ?>
					filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files',
                    filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images',
                    filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash',
					filebrowserUploadUrl  :'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files',
					filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images',
					filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash',
					<?php } ?>		
									
					height: 400, width: '98%'

				});
			</script>     
        </td>
      </tr>      
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Image']; ?></td>
        <td class="formRight">
        <?php if(ReadDB($Event["image"]) != "") { ?>
			<img src="<?php echo $CONFIG["upload_folder"].ReadDB($Event["image"]); ?>" border="0" width="160" /> 			&nbsp;&nbsp;<a href="<?php $_SERVER["PHP_SELF"]; ?>?act=delImage&id=<?php echo $Event["id"]; ?>"><?php echo $lang['edit_Event_delete']; ?></a><br /> 
            <?php echo $lang['edit_Event_If_you_upload']; ?> <br />
            <?php } ?>
          	<input type="file" name="image" size="70" /> <sub><?php echo $lang['edit_Event_Limit_2Mb']; ?></sub>
        </td>
      </tr>   
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Image_width']; ?></td>
        <td class="formRight">
        	<select name="imgwidth">
                <?php for($i=700; $i>=80; $i=$i-20) {?>
            	<option value="<?php echo $i;?>px"<?php if($i==$Event["imgwidth"]) echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      
      <tr>
      	<td class="formLeft"><?php echo $lang['edit_Event_Publish_Email']; ?> </td>
      	<td class="formRight"><input type="text" name="email" size="50" maxlength="250" value="<?php echo ReadDB($Event["email"]); ?>" /></td>
      </tr>
           
      <tr>
        <td class="formLeft"><?php echo $lang['edit_Event_Publish_date']; ?></td>
        <td class="formRight">
      		<input type="text" name="publish_date" id="publish_date" maxlength="25" size="25" value="<?php echo $Event["publish_date"]; ?>" readonly /> <a href="javascript:NewCssCal('publish_date','yyyymmdd','arrow',true,24,false)"><img src="images/cal.gif" width="16" height="16" alt="Pick a date" border="0" ></a>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="formRight">
        	<input name="submit" type="submit" value="<?php echo $lang['edit_Event_Update_button']; ?>" class="submitButton" />
        </td>
      </tr>
  	</table>
	</form>
    
    
<?php 
} elseif ($_REQUEST["act"]=='viewEvent') {
	
	$_REQUEST["id"]= (int) SafetyDB($_REQUEST["id"]);
	
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	mysqli_free_result($sql_result);
	$OptionsVis = unserialize($Options['visual']);
	$OptionsLang = unserialize($Options['language']);
	
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id='".$_REQUEST["id"]."'";
	$editCommand = "editEvent";
	$backLinkValie = "events";
	
	$sql_result = sql_result($sql);
	$Event = mysqli_fetch_assoc($sql_result);
	$capt_width = (str_replace("px","",$Event["imgwidth"]) - 4)."px";
	mysqli_free_result($sql_result);
?>
	<script src="lightbox/js/lightbox.min.js"></script>
	<link href="lightbox/css/lightbox.css" rel="stylesheet" />
    <?php include ("styles/css_front_end.php");?>
    
    
	<div style="clear:both;padding-left:40px;padding-top:10px;padding-bottom:10px;"><a href="admin.php?act=<?php echo $editCommand; ?>&id=<?php echo ReadDB($Event['id']); ?>"><?php echo $lang['Preview_Event_Edit']; ?></a></div>
    
	<div class="front_wrapper">
    
    
	<?php if($OptionsLang["Back_to_home"]!='') { ?>
    <div class="back_link">
    	<a href="admin.php?act=events"><?php echo $OptionsLang["Back_to_home"]; ?></a>
    </div>    
    <div class="back_link_dist"></div>    
    <?php } ?>
    
    <!-- Event title -->
	<div class="news_title">	  
            <?php echo ReadDB($Event["title"]); ?>     
    </div>
    
    <div class="dist_title_date"></div>
    
    
    <?php if($OptionsVis["show_date"]!='no' or $OptionsVis["show_aa"]!='no' or $OptionsVis["showhits"]!='no') { ?>
    <div class="date_style">
		<?php if($OptionsVis["show_date"]!='no') { ?>        
            <?php echo lang_date(date($OptionsVis["date_format"],strtotime($Event["publish_date"]))); ?> 
            <?php if($OptionsVis["showing_time"]!='') echo date($OptionsVis["showing_time"],strtotime($Event["publish_date"])); ?>
        <?php } ?>    
        <?php if($OptionsVis["showhits"]!='no') { ?>        
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $OptionsLang["Article_Hits"]; ?><?php echo $Event["reviews"]; ?>
        <?php } ?>   
    	<?php if($OptionsVis["show_aa"]!='no') { ?>
    	&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:ts('content',+1)">A<sup>+</sup></a> | <a href="javascript:ts('content',-1)">a<sup>-</sup></a>
        <?php } ?>
    </div>
    <?php } ?>
    
    <div class="dist_date_text"></div>
    
    <!-- Event text --> 
    <div class="news_text">
      <?php if(ReadDB($Event["image"])!='') { ?>
      
        <div class="img_left">
        	<a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Event["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($Event["title"]); ?>">
        		<img style="max-width:<?php echo $Event["imgwidth"]; ?>;" class="image_full" src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Event["image"]); ?>" alt="<?php echo ReadHTML($Event["title"]); ?>" />
            </a>
        </div>
        
      <?php } /// end of image if statement /// ?>
      
        <span id="content"><?php echo ReadDB($Event["content"]); ?> </span>
        
    </div>
    
    <div style="clear:both; height: 12px;"></div>
    </div>


<?php 
} elseif ($_REQUEST["act"]=='cats') {
	
	if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
		$pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
		if($pageNum<=0) $pageNum = 1;
	} else { 
		$pageNum = 1;
	}
	
	$orderByArr = array("cat_name");
	if(isset($_REQUEST["orderBy"]) and $_REQUEST["orderBy"]!='' and in_array($_REQUEST["orderBy"], $orderByArr)) { 
		$orderBy = $_REQUEST["orderBy"];
	} else { 
		$orderBy = "cat_name";
	}	
	
    $orderTypeArr = array("DESC", "ASC");	
    if(isset($_REQUEST["orderType"]) and $_REQUEST["orderType"]!='' and in_array($_REQUEST["orderType"], $orderTypeArr)) { 
		$orderType = $_REQUEST["orderType"];
	} else {
		$orderType = "ASC";
	}
	if ($orderType == 'DESC') { $norderType = 'ASC'; } else { $norderType = 'DESC'; }
?>
	<div class="pageDescr"><?php echo $lang['Category_Below_is_a_list']; ?></div>
        
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
  	  <tr>
        <td width="33%" class="headlist"><a href="admin.php?act=cats&orderType=<?php echo $norderType; ?>&orderBy=cat_name"><?php echo $lang['Category_Category']; ?></a></td>
        <td width="33%" class="headlist"><?php echo $lang['Category_Put_this_category']; ?></td>
        <td class="headlist" colspan="2">&nbsp;</td>
  	  </tr>
      
  	<?php 
	$sql   = "SELECT count(*) as total FROM ".$TABLE["Categories"];
	$sql_result = sql_result($sql);
	$row   = mysqli_fetch_array($sql_result);
	$count = $row["total"];
	$pages = ceil($count/100);

	$sql = "SELECT * FROM ".$TABLE["Categories"]."   
			ORDER BY " . $orderBy . " " . $orderType."  
			LIMIT " . ($pageNum-1)*100 . ",100";
	$sql_result = sql_result($sql);
	
	if (mysqli_num_rows($sql_result)>0) {	
		while ($Cat = mysqli_fetch_assoc($sql_result)) {			
	?>
  	  <tr>
        <td class="bodylist"><?php echo ReadDB($Cat["cat_name"]); ?></td>
        <td class="bodylist"><a href='admin.php?act=HTML_Cat&id=<?php echo $Cat["id"]; ?>'><?php echo $lang['Category_Copy_the_code']; ?></a></td>
        <td class="bodylistAct"><a href='admin.php?act=editCat&id=<?php echo $Cat["id"]; ?>' title="Edit"><img class="act" src="images/edit.png" alt="Edit" /></a></td>
        <td class="bodylistAct"><a class="delete" href="admin.php?act=delCat&id=<?php echo $Cat["id"]; ?>" onclick="return confirm('Are you sure you want to delete it?');" title="DELETE"><img class="act" src="images/delete.png" alt="DELETE" /></a></td>
  	  </tr>
  	<?php 
		}
	} else {
	?>
      <tr>
      	<td colspan="8" class="borderBottomList"><?php echo $lang['Category_No_Categories']; ?></td>
      </tr>
    <?php	
	}
	?>
    
	<?php
    if ($pages>1) {
    ?>
  	  <tr>
      	<td colspan="8" class="bottomlist"><div class='paging'><?php echo $lang['Category_Page']; ?> </div>
		<?php
        for($i=1;$i<=$pages;$i++){ 
            if($i == $pageNum ) echo "<div class='paging'>" .$i. "</div>";
            else echo "<a href='admin.php?act=cats&p=".$i."' class='paging'>".$i."</a>"; 
            echo "&nbsp; ";
        }
        ?>
      	</td>
      </tr>
	<?php
    }
    ?>
	</table>


<?php 
} elseif ($_REQUEST["act"]=='newCat') { 
?>
	<form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="addCat" />
        <div class="pageDescr"><?php echo $lang['Category_To_create_Category']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
          <tr>
            <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Create_Category']; ?></td>
          </tr>
          
          <tr>
            <td class="formLeft"><?php echo $lang['Category_Category_name']; ?></td>
            <td class="formRight"><input type="text" name="cat_name" size="40" maxlength="30" /></td>
          </tr>      
                
          <tr>
            <td>&nbsp;</td>
            <td class="formRight"><input name="submit" type="submit" value="<?php echo $lang['Category_Create_Category_but']; ?>" class="submitButton" /></td>
          </tr>
        </table>
	</form>
    
<?php 
} elseif ($_REQUEST["act"]=='editCat') {
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$Cat = mysqli_fetch_assoc($sql_result);	
?>
	<form action="admin.php" method="post" name="form">
        <input type="hidden" name="act" value="updateCat" />
        <input type="hidden" name="id" value="<?php echo $Cat["id"]; ?>" />
        <div class="pageDescr"><?php echo $lang['Category_change_details']; ?></div>
        <table border="0" cellspacing="0" cellpadding="8" class="fieldTables">
          <tr>
            <td colspan="2" valign="top" class="headlist"><?php echo $lang['Category_Edit_Category']; ?></td>
          </tr>
           
          <tr>
            <td class="formLeft"><?php echo $lang['Category_Category_name_edit']; ?></td>
            <td class="formRight"><input type="text" name="cat_name" size="40" maxlength="30" value="<?php echo ReadHTML($Cat["cat_name"]); ?>" /></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td class="formRight">
                <input name="submit" type="submit" value="<?php echo $lang['Category_Update_Category']; ?>" class="submitButton" />
            </td>
          </tr>
        </table>
	</form>


<?php 
} elseif ($_REQUEST["act"]=='HTML_Cat') { 
	$sql = "SELECT * FROM ".$TABLE["Categories"]." WHERE id='".$_REQUEST["id"]."'";
	$sql_result = sql_result($sql);
	$Cat = mysqli_fetch_assoc($sql_result);	
?>
	
    <div style="clear:both; padding-top: 20px;">
    
    <div class="pageDescr">There are two easy ways to put <strong>'<?php echo $Cat['cat_name']; ?>'</strong> category on your webpage.</div> 
        
    <table class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the events to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php?cat_id=<?php echo $_REQUEST["id"]; ?>&amp;hide_cat=yes&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
        
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
    
      <tr>
        <td class="copycode"><strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the events to be.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php $_REQUEST['cat_id']=<?php echo $_REQUEST["id"]; ?>; $_REQUEST['hide_cat']='yes'; include(&quot;<?php echo $CONFIG["server_path"]; ?>events.php&quot;); ?&gt; </div>     
        </td>
      </tr>
            
    </table>
    
    </div>
  
    
    
<?php 
} elseif ($_REQUEST["act"]=='options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsAdmin" />
    <table class="allTables">
      <tr>
        <td colspan="3" class="headlist">Admin options</td>
      </tr>
      <tr>
        <td valign="top" width="33%">Administrator email:<br />
          <div class="font11_em">all new submitted event notifications will be sent to this email address</div></td>
        <td valign="top">
          <input class="input_opt" name="email" type="text" value="<?php echo ReadDB($Options["email"]); ?>" />
        </td>
      </tr>      
      <tr>
        <td class="left_top">Set Default Time Zone:</td>
        <td class="left_top">
          <select name="time_zone"> 
           	<option value=""<?php if ($Options["time_zone"]=='') echo ' selected="selected"'; ?>>Server Time</option>
            <?php
			if(!function_exists('timezone_identifiers_list')){ 
				$o = timezone_list();
			} else {
				$o = get_timezones();
			}
			foreach($o as $timezone => $tz_label) {
			?>	
            	<option value='<?php echo $timezone; ?>'<?php if ($Options["time_zone"]==$timezone) echo ' selected="selected"'; ?>><?php echo $tz_label; ?></option>
            <?php 
			}
			?>  
          </select>
       </td>
      </tr>
      <tr>
        <td class="left_top">Approval:
          <div class="font11_em">check if you want to approve submitted events before having them listed</div></td>
        <td class="left_top"><input name="event_approve" type="checkbox" value="true"<?php if ($Options["event_approve"]=='true') echo ' checked="checked"'; ?> /></td>
      </tr> 
      
      <tr>
        <td class="left_top">Type of the Captcha Verification Code:<br />
          <div class="font11_em">Choose captcha image for 'submit event' page</div>
        </td>
        <td class="left_top">
          <select name="captcha"> 
          	<option value="phpcaptcha"<?php if ($Options["captcha"]=='phpcaptcha') echo ' selected="selected"'; ?>>PHP Captcha</option>
          	<option value="capmath"<?php if ($Options["captcha"]=='capmath') echo ' selected="selected"'; ?>>Mathematical Captcha</option>
          	<option value="cap"<?php if ($Options["captcha"]=='cap') echo ' selected="selected"'; ?>>Simple Captcha</option>
          	<option value="vsc"<?php if ($Options["captcha"]=='vsc') echo ' selected="selected"'; ?>>Very Simple Captcha</option>
            <option value="nocap"<?php if ($Options["captcha"]=='nocap') echo ' selected="selected"'; ?>>No Captcha(unsecured)</option>
          </select>
        </td>
      </tr>     
      
      <tr>
        <td class="left_top">Text Editor image browser:</td>
        <td class="left_top">
          <select name="htmleditor">      
           <option value="ck"<?php if($Options["htmleditor"]=='ck') echo ' selected="selected"'; ?>>classic(recommended)</option>
           <option value="plug"<?php if($Options["htmleditor"]=='plug') echo ' selected="selected"'; ?>>modern</option>  
          </select>
       </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td colspan="3" class="headlist">SMTP Authentication options</td>
      </tr> 
      <tr>
        <td class="left_top" width="40%">Use SMTP Authentication for sending emails: </td>
        <td class="left_top">
          <select name="smtp_auth"> 
            <option value="no"<?php if($Options["smtp_auth"]=='no') echo ' selected="selected"'; ?>>no</option>
            <option value="yes"<?php if($Options["smtp_auth"]=='yes') echo ' selected="selected"'; ?>>yes</option>
          </select>
        </td>
      </tr>             
      <tr>
        <td class="left_top">SMTP server:</td>
        <td class="left_top"><input name="smtp_server" type="text" size="30" value="<?php echo ReadDB($Options["smtp_server"]); ?>" /></td>
      </tr>             
      <tr>
        <td class="left_top">SMTP port:</td>
        <td class="left_top"><input name="smtp_port" type="text" size="5" value="<?php echo ReadDB($Options["smtp_port"]); ?>" /></td>
      </tr> 
                 
      <tr>
        <td class="left_top">SMTP email(SMTP account username):</td>
        <td class="left_top"><input name="smtp_email" type="text" size="30" value="<?php echo ReadDB($Options["smtp_email"]); ?>" /></td>
      </tr>  
                 
      <tr>
        <td class="left_top">SMTP password:</td>
        <td class="left_top"><input name="smtp_pass" type="text" size="30" value="<?php echo ReadDB($Options["smtp_pass"]); ?>" /></td>
      </tr>
      <tr>
        <td class="left_top">Use SMTP secure: </td>
        <td class="left_top">
          <select name="smtp_secure"> 
            <option value=""<?php if($Options["smtp_secure"]=='') echo ' selected="selected"'; ?>>none</option>
            <option value="tls"<?php if($Options["smtp_secure"]=='tls') echo ' selected="selected"'; ?>>tls</option>
            <option value="ssl"<?php if($Options["smtp_secure"]=='ssl') echo ' selected="selected"'; ?>>ssl</option>
          </select>
        </td>
      </tr>        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
       
	</form>


<?php 
} elseif ($_REQUEST["act"]=='event_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
?>
	
    <div class="paddingtop"></div>
    
    <form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsEvents" />
    <table class="allTables">
      <tr>
        <td colspan="3" class="headlist">Event options</td>
      </tr>      
      <tr>
        <td class="left_top" width="33%">Number of events per page: </td>
        <td class="left_top"><input name="per_page" type="text" size="3" value="<?php echo ReadDB($Options["per_page"]); ?>" /></td>
      </tr>  
      
      <tr>
        <td class="left_top">Order events on the front-end by:</td>
        <td class="left_top">
          <select name="orderby"> 
          	<option value="publish_date DESC"<?php if ($Options["orderby"]=='publish_date DESC') echo ' selected="selected"'; ?>>Publish date - descending</option> 
          	<option value="publish_date ASC"<?php if ($Options["orderby"]=='publish_date ASC') echo ' selected="selected"'; ?>>Publish date - ascending</option>      
          	<option value="eventdate DESC"<?php if ($Options["orderby"]=='eventdate DESC') echo ' selected="selected"'; ?>>Event Date - descending</option>
          	<option value="eventdate ASC"<?php if ($Options["orderby"]=='eventdate ASC') echo ' selected="selected"'; ?>>Event Date - ascending</option>
          </select>
        </td>
      </tr>
      
      <tr>
        <td class="left_top">URL of the page where you placed the events on your website:<br />
          <div class="font11_em">Put the url of the page where events list is located. It's useful for the rss feed and some other features.</div></td>
        <td class="left_top">
        	<input class="input_opt" name="items_link" type="text" value="<?php echo ReadDB($Options["items_link"]); ?>" />
            <div class="under_input">for example http://www.yoursite.com/events-page.php</div>

        </td>
      </tr>
      <tr>
        <td class="left_top">Show drop-down menu with categories:</td>
        <td class="left_top">
          <select name="showcategdd"> 
           <option value="yes"<?php if ($Options["showcategdd"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showcategdd"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr> 
      <tr>
        <td class="left_top">Show search box:</td>
        <td class="left_top">
          <select name="showsearch"> 
           <option value="yes"<?php if ($Options["showsearch"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showsearch"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>    
      <tr>
        <td class="left_top">Hide old(expired) events: 
          <div class="font11_em">Choose "yes" if you want to hide the expired events</div></td>
        <td class="left_top">
          <select name="hideold"> 
          	<option value="yes"<?php if ($Options["hideold"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
          	<option value="no"<?php if ($Options["hideold"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
        </td>
      </tr>  
      
      <tr>
        <td class="left_top">Show share buttons underneath each event:</td>
        <td class="left_top">
          <select name="showshare"> 
           <option value="yes"<?php if ($Options["showshare"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["showshare"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>
      
      <tr>
        <td class="left_top">Show google map next to event location:</td>
        <td class="left_top">
          <select name="show_gmap"> 
           <option value="yes"<?php if ($Options["show_gmap"]=='yes') echo ' selected="selected"'; ?>>yes</option>       
           <option value="no"<?php if ($Options["show_gmap"]=='no') echo ' selected="selected"'; ?>>no</option>
          </select>
       </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>    
	</form>



<?php
} elseif ($_REQUEST["act"]=='visual_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsVis = unserialize(ReadDB($Options['visual']));
?>

	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the styles to see the options.</div>
    
    <?php include ("include/form_visual_options.php");?> 
    


<?php
} elseif ($_REQUEST["act"]=='language_options') {
	$sql = "SELECT * FROM ".$TABLE["Options"];
	$sql_result = sql_result($sql);
	$Options = mysqli_fetch_assoc($sql_result);
	$OptionsLang = unserialize($Options['language']);
?>
	<script type="text/javascript">
		Event.observe(window, 'load', loadAccordions, false);
		function loadAccordions() {
			var bottomAccordion = new accordion('accordion_container');	
			// Open first one
			//bottomAccordion.activate($$('#accordion_container .accordion_toggle')[0]);
		}	
	</script>
	
    <div class="pageDescr">Click on any of the line to see the options.</div>
    
    <?php include ("include/form_language_options.php");?>
    

<?php
} elseif ($_REQUEST["act"]=='html') {
?>
	<div class="pageDescr">There are two easy ways to put the events script on your website.</div>

	<table class="allTables">
      <tr>
        <td class="copycode">1) <strong>Using iframe code</strong> - just copy the code below and put it on your web page where you want the events to appear.</td>
      </tr>
      <tr>
      	<td class="putonwebpage">        	
        	<div class="divCode">&lt;iframe src=&quot;<?php echo $CONFIG["full_url"]; ?>preview.php&quot; width=&quot;100%&quot; height=&quot;700px&quot; frameborder=&quot;0&quot; scrolling=&quot;auto&quot;&gt;&lt;/iframe&gt;   </div>     
        </td>
      </tr>
    </table>
    
    <table class="allTables">
    
      <tr>
        <td class="copycode">2) <strong>Using PHP include()</strong> - you can use a PHP include() in any of your PHP pages. Edit your .php page and put the code below where you want the events to be.</td>
      </tr>      
            
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>events.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	At the top of the php page (first line) you should put this line of code too so captcha image verification can work on the submit event form.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php session_start(); ?&gt;</div>     
        </td>
      </tr>
      
      <tr>
      	<td>
        	Optionally in the head section of the php page you could put(or replace your meta tags) this line of code, so meta title and meta description will work for better searching engine optimization.
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;?php include(&quot;<?php echo $CONFIG["server_path"]; ?>meta.php&quot;); ?&gt; </div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div>If you have any problems, please do not hesitate to contact us at info@simplephpscripts.com</div>     
        </td>
      </tr>
            
    </table>
	       
    

<?php
} elseif ($_REQUEST["act"]=='rss') {
?>
    
    <div class="pageDescr">The RSS feed allows other people to keep track of your events using rss readers and to use your events on their websites. <br />
Every time you publish a new event it will appear on your RSS feed and every one using it will be informed about it.</div>
    
    <table class="allTables">
    
      <tr>
        <td class="copycode">You can view the RSS feed <a href="rss.php" target="_blank">here(in php)</a>, <a href="rss.xml" target="_blank">here(in xml)</a> or use one of the codes below to place it on your website as RSS link.</td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.php&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
      
      <tr>
        <td class="putonwebpage">        	
        	<div class="divCode">&lt;a href=&quot;<?php echo $CONFIG["full_url"]; ?>rss.xml&quot; target=&quot;_blank&quot;&gt;RSS feed&lt;/a&gt;</div>     
        </td>
      </tr>
            
    </table>
    
<?php
}
?>
</div>


<?php 
} else { ////// Login Form //////
?>
<div class="admin_wrapper login_wrapper">
    <div class="login_head"><?php echo $lang['ADMIN_LOGIN']; ?></div>
    
    <div class="login_sub"><?php echo $lang['Login_context']; ?> </div>
    <form action="admin.php" method="post">
    <input type="hidden" name="act" value="login">
    <table border="0" cellspacing="0" cellpadding="0" class="loginTable">
      <tr>
        <td class="userpass"><?php echo $lang['Username']; ?> </td>
        <td class="userpassfield"><input name="user" type="text" class="loginfield" style="float:left;" /> <?php if(isset($logMessage) and $logMessage!='') {?><div class="logMessage"><?php echo $logMessage; ?></div><?php } ?></td>
      </tr>
      <tr>
        <td class="userpass"><?php echo $lang['Password']; ?> </td>
        <td class="userpassfield"><input name="pass" type="password" class="loginfield" /></td>
      </tr>
      <tr>
        <td class="userpass">&nbsp;</td>
        <td class="userpassfield"><input type="submit" name="button" value="<?php echo $lang['Login']; ?>" class="loginButon" /></td>
      </tr>
    </table>
    </form>
</div>
<?php 
}
?>

<div class="clearfooter"></div>
<div class="divProfiAnts"> <a class="footerlink" href="http://simplephpscripts.com" target="_blank">Product of SimplePHPscripts.com</a></div>

</body>
</html>