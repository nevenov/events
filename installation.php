<?php
namespace EventScriptPHP20;
//error_reporting(E_ALL & ~E_WARNING);
$installed = 'yes';
include("configs.php");

if (isset($_GET["install"]) and $_GET["install"]==1) {
	$message = '';
	$connEV = mysqli_connect($_REQUEST["hostname"], $_REQUEST["mysql_user"], $_REQUEST["mysql_password"]);
	if (mysqli_connect_errno()) {
		$message = "MySQL database details are incorrect. Please, check the database details(MySQL server, username and password) and/or contact your hosting company to verify them. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.
		<br /> Error message: " . mysqli_connect_error();
	} else {
		if (!mysqli_select_db($connEV, $_REQUEST["mysql_database"])) {
			$message = "Unable to select database. Database name is incorrect or is not created. Please check database details - MySQL server, Database name, Username and Password and try again. If you have troubles just send us login details for your hosting account control panel and we will do the installation of the script for you for free.";
		} else {
					
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Events"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Events"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `publish_date` datetime default NULL,
					  `status` varchar(50) default NULL,
					  `cat_id` varchar(10) default NULL,
					  `featured` varchar(10) default NULL,
					  `eventdate` date default NULL,
					  `end_date` date default NULL,
					  `starting_t` time default NULL,
					  `ending_t` time default NULL,
					  `hide_endtime` varchar(10) default NULL,
					  `location` varchar(250) default NULL,
					  `price` varchar(250) default NULL,
					  `title` varchar(250) default NULL,
					  `summary` text,
					  `content` text,
					  `image` varchar(250) default NULL,
					  `caption` varchar(250) default NULL,
					  `imgpos` varchar(10) default NULL,
					  `imgwidth` varchar(10) default NULL,
					  `email` varchar(250) default NULL,
					  `reviews` int(11) default NULL, 
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
			
						
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Categories"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Categories"]."` (
					  `id` int(11) NOT NULL auto_increment,
					  `cat_name` varchar(250) default NULL,
					  PRIMARY KEY  (`id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
									
									
			
			$sql = "DROP TABLE IF EXISTS `".$TABLE["Options"]."`;";
			$sql_result = sql_result($sql);
			
			$sql = "CREATE TABLE `".$TABLE["Options"]."` (
					  `options_id` int(11) NOT NULL auto_increment,
					  `email` varchar(250) default NULL,
					  `time_zone` varchar(250), 
					  `event_approve` varchar(10) default NULL,
					  `captcha` varchar(10) default NULL,
					  `captcha_theme` varchar(20) default NULL,
					  `htmleditor` varchar(20),
					  `smtp_auth` varchar(20),
					  `smtp_server` varchar(250),
					  `smtp_port` varchar(20),
					  `smtp_email` varchar(250),
					  `smtp_pass` varchar(250),
					  `smtp_secure` varchar(20),
					  `per_page` varchar(10),
					  `orderby` varchar(50),
					  `items_link` varchar(250),
					  `showitem` varchar(20),
					  `showcategdd` varchar(10),
					  `hideold` varchar(10),
					  `hideexpadm` varchar(10),
					  `showshare` varchar(10),
					  `showsearch` varchar(10),
					  `show_gmap` varchar(10) default NULL,
					  `visual` text,
					  `language` text,
					  PRIMARY KEY  (`options_id`))
					  CHARACTER SET utf8 COLLATE utf8_unicode_ci";
  			$sql_result = sql_result($sql);
			
			$sql = 'INSERT INTO `'.$TABLE["Options"].'` 
					SET `email`="admin@email.com",  
						`time_zone`="", 
						`event_approve`="true",
						`captcha`="cap", 
						`captcha_theme`="white", 
						`htmleditor`="ck",  
						`smtp_auth`="no",  
						`smtp_server`="smtp.server.com",  
						`smtp_port`=587,  
						`smtp_email`="test@server.com",  
						`smtp_pass`="password",  
						`smtp_secure`="",
						`per_page`="10", 	 
						`showitem`="TitleAndSummary", 	 
						`showcategdd`="yes", 		
						`items_link`="http://www.yourwebsite.com/events-page.php", 		
						`hideold`="yes", 
						`hideexpadm`="no", 
						`orderby`="publish_date DESC",
						`show_gmap`="yes", 			 
						
						`visual`=\'a:164:{s:15:"gen_font_family";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:13:"gen_font_size";s:4:"14px";s:14:"gen_font_color";s:7:"#000000";s:13:"gen_bgr_color";s:7:"#FFFFFF";s:15:"gen_line_height";s:3:"1.4";s:9:"gen_width";s:3:"800";s:13:"gen_width_dim";s:2:"px";s:10:"link_color";s:7:"#7F7F7F";s:16:"link_color_hover";s:7:"#4C4C4C";s:13:"main_menu_bgr";s:7:"#F8F9FA";s:9:"link_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:14:"link_font_size";s:4:"14px";s:16:"link_font_weight";s:6:"normal";s:20:"link_text_decoration";s:4:"none";s:26:"link_text_decoration_hover";s:4:"none";s:12:"cat_dd_color";s:7:"#212529";s:16:"cat_dd_bgr_color";s:7:"#FFFFFF";s:22:"cat_dd_bgr_color_hover";s:7:"#F8F9FA";s:13:"cat_dd_family";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:16:"cat_dd_font_size";s:4:"14px";s:17:"cat_dd_font_style";s:6:"normal";s:18:"cat_dd_font_weight";s:6:"normal";s:12:"cat_dd_align";s:4:"left";s:14:"summ_img_width";s:2:"35";s:15:"summ_img_propor";s:6:"0.5625";s:16:"summ_title_color";s:7:"#6B6B6B";s:22:"summ_title_color_hover";s:7:"#00365F";s:15:"summ_title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:15:"summ_title_size";s:4:"20px";s:22:"summ_title_font_weight";s:6:"normal";s:21:"summ_title_font_style";s:6:"normal";s:21:"summ_title_text_align";s:4:"left";s:22:"summ_title_line_height";s:5:"1.3em";s:16:"summ_title_decor";s:4:"none";s:22:"summ_title_decor_hover";s:4:"none";s:16:"summ_edate_color";s:7:"#ABABAB";s:15:"summ_edate_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:15:"summ_edate_size";s:4:"13px";s:21:"summ_edate_font_style";s:6:"normal";s:17:"summ_edate_format";s:6:"l, F j";s:18:"summ_eshowing_time";s:5:"g:i a";s:13:"summ_loc_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:14:"summ_loc_color";s:7:"#DE935F";s:13:"summ_loc_size";s:4:"14px";s:20:"summ_loc_font_weight";s:6:"normal";s:19:"summ_loc_font_style";s:6:"normal";s:14:"summ_pric_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:15:"summ_pric_color";s:7:"#DE935F";s:14:"summ_pric_size";s:4:"13px";s:21:"summ_pric_font_weight";s:6:"normal";s:20:"summ_pric_font_style";s:6:"normal";s:8:"cat_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:9:"cat_color";s:7:"#000000";s:13:"cat_font_size";s:4:"14px";s:15:"cat_font_weight";s:6:"normal";s:9:"more_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:10:"more_color";s:7:"#41C1F2";s:16:"more_color_hover";s:7:"#0056B3";s:14:"more_font_size";s:4:"14px";s:16:"more_font_weight";s:6:"normal";s:20:"more_text_decoration";s:4:"none";s:26:"more_text_decoration_hover";s:4:"none";s:15:"pag_font_family";s:54:"Montserrat-Regular,Helvetica Neue,Helvetica,sans-serif";s:14:"pag_font_color";s:7:"#333333";s:20:"pag_font_color_hover";s:7:"#FFFFFF";s:18:"pag_font_color_sel";s:7:"#FFFFFF";s:18:"pag_font_color_prn";s:7:"#26C9F4";s:19:"pag_color_prn_hover";s:7:"#EEEEEE";s:18:"pag_font_color_ina";s:7:"#BDBDBD";s:13:"pag_font_size";s:3:"1em";s:15:"pag_font_weight";s:6:"normal";s:14:"pag_font_style";s:6:"normal";s:12:"pag_align_to";s:6:"center";s:11:"title_color";s:7:"#6B6B6B";s:10:"title_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:10:"title_size";s:4:"20px";s:17:"title_font_weight";s:6:"normal";s:16:"title_font_style";s:6:"normal";s:16:"title_text_align";s:4:"left";s:17:"title_line_height";s:4:"31px";s:11:"edate_color";s:7:"#ABABAB";s:10:"edate_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:10:"edate_size";s:4:"14px";s:17:"edate_font_weight";s:6:"normal";s:16:"edate_font_style";s:6:"normal";s:12:"edate_format";s:6:"F j, Y";s:14:"eshowhide_time";s:3:"yes";s:13:"eshowing_time";s:5:"g:i a";s:7:"show_aa";s:3:"yes";s:8:"showhits";s:3:"yes";s:9:"show_date";s:3:"yes";s:10:"date_color";s:7:"#666666";s:9:"date_font";s:7:"inherit";s:9:"date_size";s:4:"11px";s:16:"date_font_weight";s:6:"normal";s:15:"date_font_style";s:6:"normal";s:11:"date_format";s:6:"F j, Y";s:12:"showing_time";s:5:"g:i a";s:15:"show_text_align";s:4:"left";s:8:"loc_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:9:"loc_color";s:7:"#DE935F";s:8:"loc_size";s:4:"14px";s:15:"loc_font_weight";s:6:"normal";s:14:"loc_font_style";s:6:"normal";s:9:"pric_font";s:41:"Helvetica Neue,Helvetica,Arial,sans-serif";s:10:"pric_color";s:7:"#DE935F";s:9:"pric_size";s:4:"16px";s:16:"pric_font_weight";s:4:"bold";s:15:"pric_font_style";s:6:"normal";s:10:"cont_color";s:7:"#292B2C";s:9:"cont_font";s:44:"Segoe-UI,Helvetica Neue,Helvetica,sans-serif";s:9:"cont_size";s:4:"15px";s:15:"cont_font_style";s:6:"normal";s:15:"cont_text_align";s:7:"justify";s:16:"cont_line_height";s:5:"1.5em";s:12:"viewer_width";s:3:"800";s:16:"links_font_color";s:7:"#666666";s:22:"links_font_color_hover";s:7:"#000000";s:21:"links_text_decoration";s:9:"underline";s:27:"links_text_decoration_hover";s:4:"none";s:15:"links_font_size";s:7:"inherit";s:16:"links_font_style";s:6:"italic";s:17:"links_font_weight";s:6:"normal";s:15:"show_share_this";s:3:"yes";s:16:"share_this_align";s:5:"right";s:15:"share_font_size";s:2:"20";s:14:"subm_bkg_color";s:7:"#FFFFFF";s:13:"subm_lab_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:14:"subm_lab_color";s:7:"#4285F4";s:13:"subm_lab_size";s:4:"15px";s:15:"subm_lab_weight";s:3:"700";s:14:"subm_lab_style";s:6:"normal";s:15:"subm_field_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:16:"subm_field_color";s:7:"#2F2F2F";s:18:"subm_field_bkg_col";s:7:"#F7F7F7";s:15:"subm_field_size";s:4:"14px";s:19:"subm_field_bord_rad";s:3:"0px";s:19:"subm_field_bord_col";s:7:"#F1F1F1";s:15:"subm_field_padd";s:4:"10px";s:14:"subm_head_font";s:41:"Arial,Helvetica Neue,Helvetica,sans-serif";s:15:"subm_head_color";s:7:"#2F2F2F";s:14:"subm_head_size";s:4:"20px";s:16:"subm_head_weight";s:4:"bold";s:15:"subm_head_style";s:6:"normal";s:15:"subm_head_align";s:4:"left";s:16:"subm_head_height";s:4:"26px";s:14:"subm_butt_font";s:50:"Oswald-Regular,Helvetica Neue,Helvetica,sans-serif";s:15:"subm_butt_color";s:7:"#FFFFFF";s:19:"subm_butt_color_hov";s:7:"#FFFFFF";s:17:"subm_butt_bkg_col";s:7:"#4285F4";s:21:"subm_butt_bkg_col_hov";s:7:"#4285F4";s:14:"subm_butt_size";s:5:"0.9em";s:15:"dist_title_date";s:3:"6px";s:20:"summ_dist_title_date";s:3:"6px";s:14:"dist_date_text";s:4:"10px";s:16:"dist_edate_etime";s:3:"6px";s:21:"summ_dist_edate_etime";s:3:"5px";s:14:"dist_etime_loc";s:4:"10px";s:14:"dist_loc_price";s:3:"6px";s:19:"summ_dist_loc_price";s:3:"3px";s:16:"dist_price_descr";s:3:"6px";s:21:"summ_dist_price_descr";s:4:"10px";s:15:"dist_btw_events";s:4:"36px";s:15:"dist_link_title";s:4:"36px";}\',
						 
						`language`=\'a:63:{s:12:"Back_to_home";s:4:"BACK";s:13:"Search_button";s:6:"Search";s:15:"Submit_an_Event";s:15:"SUBMIT AN EVENT";s:10:"Event_Date";s:12:"Event Date: ";s:10:"Event_Time";s:12:"Event Time: ";s:8:"Category";s:8:"CATEGORY";s:12:"Category_all";s:9:"-- ALL --";s:8:"Location";s:10:"Location: ";s:5:"Price";s:7:"Price: ";s:9:"Read_more";s:4:"MORE";s:8:"Previous";s:4:"Prev";s:4:"Next";s:4:"Next";s:19:"No_events_published";s:21:"No events published! ";s:12:"Article_Hits";s:13:"Article Hits:";s:6:"Monday";s:3:"Mon";s:7:"Tuesday";s:3:"Tue";s:9:"Wednesday";s:3:"Wed";s:8:"Thursday";s:3:"Thu";s:6:"Friday";s:3:"Fri";s:8:"Saturday";s:3:"Sat";s:6:"Sunday";s:3:"Sun";s:7:"January";s:3:"Jan";s:8:"February";s:3:"Feb";s:5:"March";s:3:"Mar";s:5:"April";s:3:"Apr";s:3:"May";s:3:"May";s:4:"June";s:3:"Jun";s:4:"July";s:3:"Jul";s:6:"August";s:3:"Aug";s:9:"September";s:3:"Sep";s:7:"October";s:3:"Oct";s:8:"November";s:3:"Nov";s:8:"December";s:3:"Dec";s:9:"metatitle";s:16:"Event Script PHP";s:15:"metadescription";s:164:"This is Event Script PHP. You can enter admin area and see how to manage(create/edit/delete/approve) events, set options and and how to put events on your webpage. ";s:17:"Submit_Event_head";s:15:"Submit an Event";s:17:"Submit_Date_Start";s:16:"Event Date Start";s:15:"Submit_Date_End";s:15:" Event Date End";s:17:"Submit_Time_Start";s:16:"Event Time Start";s:15:"Submit_Time_End";s:14:"Event Time End";s:11:"Submit_Hide";s:15:"- Hide End Time";s:12:"Submit_Title";s:14:"Event Title * ";s:11:"Description";s:11:"Description";s:12:"Submit_Price";s:5:"Price";s:17:"Submit_Price_info";s:10:"(i.e. $50)";s:15:"Submit_Location";s:11:"Location * ";s:20:"Submit_Location_info";s:49:" (it is importand to put event location and city)";s:12:"Submit_Image";s:12:"Upload Image";s:17:"Submit_Image_info";s:11:"(limit 2Mb)";s:12:"Submit_Email";s:8:"Email * ";s:17:"Submit_Email_Info";s:29:" (will be hidden from public)";s:17:"Enter_verify_code";s:25:"Enter verification code *";s:18:"verify_placeholder";s:16:"Type the captcha";s:22:"Submit_Required_fields";s:15:"Required fields";s:28:"Submit_incorrect_verify_code";s:29:"Incorrect verification code! ";s:31:"Submit_Fill_the_required_fields";s:34:"Please, fill the required fields! ";s:22:"Submit_incorrect_email";s:25:"Incorrect email address! ";s:10:"field_code";s:37:"Please, enter the verification code! ";s:24:"Event_has_been_submitted";s:26:"Event has been submitted! ";s:26:"After_approve_will_publish";s:43:"After moderator approve it will published! ";s:19:"New_event_submitted";s:21:"New Event submitted! ";s:27:"Thanks_for_submitting_event";s:36:"Thank you for submitting your event!";s:20:"Thanks_email_message";s:37:"Thank you for submitting your event! ";}\'';
			
			$sql_result = sql_result($sql);
			
					
			
			
			
			$ConfigFile = "allinfo.php";
			$CONFIG='$CONFIG';
			
			$handle = @fopen($ConfigFile, "r");
			
			if ($handle) {
				$buffer = fgets($handle, 4096);
	  			$buffer .=fgets($handle, 4096);	
				$buffer .=fgets($handle, 4096);	
				
				$buffer .=$CONFIG."[\"hostname\"]='".$_REQUEST["hostname"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_user\"]='".$_REQUEST["mysql_user"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_password\"]='".$_REQUEST["mysql_password"]."';\n";
				
				$buffer .=$CONFIG."[\"mysql_database\"]='".addslashes($_REQUEST["mysql_database"])."';\n";
				
				$buffer .=$CONFIG."[\"server_path\"]='".$_REQUEST["server_path"]."';\n";
				
				$buffer .=$CONFIG."[\"full_url\"]='".addslashes($_REQUEST["full_url"])."';\n";
								
				$buffer .=$CONFIG."[\"folder_name\"]='".addslashes($_REQUEST["folder_name"])."';\n";
				
				$buffer .=$CONFIG."[\"admin_user\"]='".$_REQUEST["admin_user"]."';\n";
				
				$buffer .=$CONFIG."[\"admin_pass\"]='".$_REQUEST["admin_pass"]."';\n";
				
				while (!feof($handle)) {
					$buffer .= fgets($handle, 4096);
				}
				
				fclose($handle);
				
				$handle = @fopen($ConfigFile, "w");
				
				if (!$handle) {
					echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				if (!fwrite($handle,$buffer)) {
				  	echo "Configuration file $ConfigFile is missing or the permissions does not allow to be changed. Please upload the file and/or set the right permissions (CHMOD 777).";
					exit();
				}
				
				fclose($handle);
				
			} else {
				echo "Error opening file.";
				exit();
			}
			
			$message = 'Script successfully installed';	
?>
		<script type="text/javascript">
			window.document.location.href='installation.php?install=2'
		</script>           		
<?php		
		}
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Script installation</title>
<link href="styles/installation.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="install_wrap">

<?php if (isset($_GET["install"]) && $_GET["install"]==2) { ?>
	<table border="0" class="form_table" align="center" cellpadding="4">
	  <tr>
      	<td>
			Script successfully installed. <a href='admin.php'>Login here</a>.
        </td>
      </tr>
    </table>
<?php } else {?>

	<form action="installation.php" method="get" name="installform">
    <input name="install" type="hidden" value="1" />
	<table border="0" class="form_table" align="center" cellpadding="4">
      
      
      <tr>
      	<td colspan="3">
        	<?php 
			if (isset($message) and $message!='') { 
				echo "<span class='alerts'>".$message."</span>";
			} else {
				echo 'These are the details that script will use to install and run: ';
			}
			?>
	  	</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Minimum version required (PHP <?php echo $php_version_min; ?>, MySQL <?php echo $mysql_version_min; ?>): </td>
      </tr>
      
      	<?php 
		
		$error_msg = "";
		
		//////////////// CHECKING FOR PHP VERSION REQUIRED //////////////////
		
		$curr_php_version = phpversion();
		$check_php_version=true;
		
		
		if (version_compare($curr_php_version, $php_version_min, "<")) {
			//echo 'I am using PHP 5.4, my version: ' . phpversion() . "\n. Minimum is ".$php_version_min;
			$check_php_version=false;
		}
		
		if($check_php_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "PHP requirement checks failed and the script may not work properly. You have version ".$curr_php_version." but the required version is ".$php_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} else {
			$not = "";
		}
		?>
        
      <tr>
        <td width="30%" align="left">PHP: </td>
        <td><?php echo "Server version of PHP '".$curr_php_version."' is ".$not." ok!"; ?> </td>
      </tr>
      
      
      	<?php 	
	  	//////////////// CHECKING FOR MYSQL VERSION REQUIRED //////////////////	
		$curr_mysql_version = '-.-.--';
		$not = "";		
		
		$check_mysql_version=true;		
		
		ob_start(); 
		phpinfo(INFO_MODULES); 
		$info = ob_get_contents(); 
		ob_end_clean(); 
		$info = stristr($info, 'Client API version'); 
		preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
		$gd = $match[0]; 
		//echo '</br>MySQL:  '.$gd.' <br />';
		$curr_mysql_version = $gd;
		
		
		if (version_compare($curr_mysql_version, $mysql_version_min, "<")) {
			$check_mysql_version=false;
			$not = "<span style='color:red;'>not</span>";
		} else if(trim($curr_mysql_version)=="-.-.--") {
			$error_msg .= "Information about MySQL version is missing or is incomplete. Please ask your hosting company or system administrator for the version. The minimum required version of MySQL is ".$mysql_version_min.". <br />";
			$not = "<span style='color:red;'>not</span>";
		}
		
		if($check_mysql_version==false) {
			$not = "<span style='color:red;'>not</span>";
			$error_msg .= "MySQL requirement checks failed and the script may not work properly. You have version ".$curr_mysql_version." but the required version is ".$mysql_version_min.". Please contact your hosting company or system administrator for assistance. <br />";
		} 
		?>
        
      <tr>
        <td align="left">MySQL: </td>
        <td><?php echo "Server version of MySQL '".$curr_mysql_version."' is ".$not." ok!"; ?></td>
      </tr> 
      
      <?php if(isset($error_msg) and $error_msg!='') {?>
      <tr>
        <td colspan="2" style="color:#FF0000;"><?php echo $error_msg; ?></td>
      </tr>       
      <?php } ?>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">MySQL login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(In case you don't have database yet, you should enter your hosting control panel and create it)</span></td>
      </tr>
      
      <tr>
        <td align="left">MySQL Server:</td>
        <td align="left"><input type="text" name="hostname" value="<?php if(isset($_REQUEST['hostname'])) echo $_REQUEST['hostname']; else echo 'localhost'; ?>" size="30" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Username: </td>
        <td align="left"><input name="mysql_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_user'])) echo $_REQUEST['mysql_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">MySQL Password: </td>
        <td align="left"><input name="mysql_password" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_password'])) echo $_REQUEST['mysql_password']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Database name:</td>
        <td align="left"><input name="mysql_database" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['mysql_database'])) echo $_REQUEST['mysql_database']; ?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="left" colspan="3" class="head_row">Installation paths to script directory: </td>
      </tr>
      
      	<?php 
	  	$server_path=$_SERVER['SCRIPT_FILENAME'];
		if (preg_match("/(.*)\//",$server_path,$matches)) {
			$server_path=$matches[0];
		}
		
		$server_path = str_replace("\\","/",$server_path);
		$server_path = str_replace("installation.php","",$server_path);
			
	  	?>
      <tr>
        <td align="left" valign="top">Server path to script directory:</td>
        <td align="left" colspan="2">
        	<input name="server_path" type="text" value="<?php echo $server_path; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: /home/server/public_html/SCRIPTFOLDER/ -  for Linux host</span><br />
            <span style="font-size:11px;font-style:italic;">Example: D:/server/www/websitedir/SCRIPTFOLDER/ -  for Windows host</span>
        </td>
      </tr>
      
      <?php 
	  	$full_url = 'http';
		if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$full_url .= "s";}
		$full_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$full_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$full_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		if (preg_match("/(.*)\//",$full_url,$matches)) {
			$full_url=$matches[0];
		}
		//$full_url = str_replace("installation.php","",$full_url);
		?>
      <tr>
        <td align="left" valign="top">Full URL to script directory:</td>
        <td align="left" colspan="2">
        	<input name="full_url" type="text" value="<?php echo $full_url; ?>" style="width:95%" /><br />
        	<span style="font-size:11px;font-style:italic;">Example: http://yourdomain.com/SCRIPTFOLDER/</span>
        </td>
      </tr>      
      
      	<?php 
	  	$url = $_SERVER['PHP_SELF']; 
		if (preg_match("/(.*)\//",$url,$matches)) {
			$folder_name=$matches[0];
		}
	  	?>
      <tr>
        <td align="left" valign="top">Script directory name:</td>
        <td align="left" colspan="2">
        	<input name="folder_name" type="text" value="<?php echo $folder_name; ?>" style="width:95%" /><br />
            <span style="font-size:11px;font-style:italic;">Example: /SCRIPTFOLDER/</span>
        </td>
      </tr>
      
      	
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" colspan="3" class="head_row">Administrator login details: <span style="font-weight:normal; font-size:11px; font-style:italic;">(Choose Username and Password you should use later when log in admin area)</span></td>
      </tr>
      <tr>
        <td align="left">Admin Username:</td>
        <td align="left"><input name="admin_user" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_user'])) echo $_REQUEST['admin_user']; ?>" /></td>
      </tr>
      <tr>
        <td align="left">Admin Password:</td>
        <td align="left"><input name="admin_pass" type="text" size="30" maxlength="50" value="<?php if(isset($_REQUEST['admin_pass'])) echo $_REQUEST['admin_pass']; ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="installScript" type="submit" value="Install Script"></td>
      </tr>
    </table>
	</form>
<?php } ?>    

</div>

</body>
</html>
