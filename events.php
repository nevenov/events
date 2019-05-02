<?php 
namespace EventScriptPHP20;
use PHPMailer as PHPMailer;
use Securimage as Securimage;

$installed = '';
if(!isset($configs_are_set_ev)) {
	include( dirname(__FILE__). "/configs.php");
}
//$thisPage = $_SERVER['PHP_SELF'];
$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
$thisPage = $phpSelf;

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$OptionsVis = unserialize($Options['visual']);
$OptionsLang = unserialize($Options['language']);

if(trim($Options['time_zone'])!='') {
	date_default_timezone_set(trim($Options['time_zone']));
}
$cur_date = date('Y-m-d H:i:s');

if(!isset($_REQUEST["p"])) $_REQUEST["p"] = ''; 
if(!isset($_REQUEST["search"])) $_REQUEST["search"] = ''; 
if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]!='') { 
	$_REQUEST["cat_id"] = (int) SafetyDB($_REQUEST["cat_id"]);
} else {
	$_REQUEST["cat_id"] = ''; 
}
$message='';

// defining recurring url variables in the events list
if ((isset($_REQUEST["eid"]) and $_REQUEST["eid"]>0) or isset($_REQUEST["act"])) $url_vars = "?p="; else $url_vars = "&amp;p=";
if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') $url_vars .= urlencode($_REQUEST["p"]);
if(isset($_REQUEST["cat_id"]) and $_REQUEST["cat_id"]>0) $url_vars .= "&amp;cat_id=".urlencode($_REQUEST["cat_id"]);
$url_vars .= "&amp;search=";
if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') $url_vars .= urlencode($_REQUEST["search"]);
$url_vars .= "#ontitle";

if(!function_exists(__NAMESPACE__ . '\lang_date')){ 
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
}

/////////////////////////////////////////////////
////// checking for correct captcha starts //////
if (isset($_POST["act"]) and ($_POST["act"]=='post_comment' or $_POST["act"]=='submit_listing')) {

	if($Options['captcha']=='nocap') { // if the option is set to no Captcha
	
		$testvariable = true;	// test variable is set to true
	
	} elseif($Options['captcha']=='phpcaptcha') { // if the option is set to phpcaptcha
		
		//$_SESSION['captcha_error'] = "";
		
		//echo $_POST['captcha_code']." = ".$securimage->check($_POST['captcha_code']);
				
		$testvariable = false;	// test variable is set to false.
		
		//echo $_POST['captcha_code'];
		
		if (isset($_POST['captcha_code']) and $securimage->check($_POST['captcha_code']) == true) { // test variable is set	to true			
			$testvariable = true; // the captcha_code was correct	
		} else {		
			$message =  ReadDB($OptionsLang["Submit_incorrect_verify_code"]); 
			//$_SESSION['captcha_error'] = ReadDB($OptionsLang["Submit_incorrect_verify_code"]); 
			$_REQUEST["act"] = 'new';
		} 
		
	} else { // if is set to math, simple or very simple captcha option
	
		$testvariable = false;	// test variable is set to false.
		
		if (preg_match('/^'.$_SESSION['key'].'$/i', $_REQUEST['string'])) { // test variable is set	to true			
			$testvariable = true;			
		} else {		
			$message =  ReadDB($OptionsLang["Submit_incorrect_verify_code"]); 
			$_REQUEST["act"] = 'new';
		}
		
	}

}
////// checking for correct captcha ends //////
///////////////////////////////////////////////


if (isset($_POST["act"]) and $_POST["act"]=='submit_listing') {
	
	if ($testvariable==true) { // if test variable is set to true, then go to update database and send emails
		
		if ($Options["event_approve"]=='true') {			
			$status = 'Hidden';
		} else {
			$status = 'Published';
		}
		
		// by default the event is not featured, so set to 2 for not features	
		if (!isset($_REQUEST["featured"]) or $_REQUEST["featured"]=='') $_REQUEST["featured"] = '2';
		// set default value of hide_endtime to 'no'	
		if (!isset($_REQUEST["hide_endtime"]) or $_REQUEST["hide_endtime"]=='') $_REQUEST["hide_endtime"] = 'no';
		
		
		if($OptionsVis['eshowing_time']=='g:i a') {
			if(($_REQUEST["sAmPm"] == "am") and ($_REQUEST["starting_h"] > 11)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] - 12;
			if(($_REQUEST["sAmPm"] == "pm") and ($_REQUEST["starting_h"] < 12)) $_REQUEST["starting_h"] = $_REQUEST["starting_h"] + 12;
	
			if(($_REQUEST["eAmPm"] == "am") and ($_REQUEST["ending_h"] > 11)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] - 12;
			if(($_REQUEST["eAmPm"] == "pm") and ($_REQUEST["ending_h"] < 12)) $_REQUEST["ending_h"] = $_REQUEST["ending_h"] + 12;
		} 
		
		
		$starting_t = $_REQUEST["starting_h"].":".$_REQUEST["starting_m"];
		$ending_t	= $_REQUEST["ending_h"].":".$_REQUEST["ending_m"];
		
		if (strtotime($_REQUEST["eventdate"]." ".$starting_t) > strtotime($_REQUEST["end_date"]." ".$ending_t)) {
			$_REQUEST["end_date"] = $_REQUEST["eventdate"];
		} 
			
		$sql = "INSERT INTO ".$TABLE["Events"]." 
				SET `publish_date` 	= '".$cur_date."',
					`status` 		= '".$status."',
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
					`content` 		= '".nl2br(SaveDB($_REQUEST["description"]))."',
					`imgpos` 		= 'left',
					`imgwidth` 		= '320px',  
					`email` 		= '".SaveDB($_REQUEST["email"])."',
					`reviews` 		= '0'";
		$sql_result = sql_result($sql);	
		
		$index_id = mysqli_insert_id($connEV);
		
		// upload photo to the events
		if (is_uploaded_file($_FILES["image"]['tmp_name'])) {
			
			$filexpl = explode(".", $_FILES["image"]['name']);
			$format = end($filexpl);					
			$formats = array("jpg","jpeg","JPG","png","PNG","gif","GIF");			
			if(in_array($format, $formats) and getimagesize($_FILES['image']['tmp_name'])) {
			
				$name = str_file_filter($_FILES['image']['name']);
				$name = $index_id . "_" . $name;
	
				$filePath = $CONFIG["server_path"].$CONFIG["upload_folder"] . $name;
				$thumbPath = $CONFIG["server_path"].$CONFIG["upload_thumbs"] . $name;
				
				if (move_uploaded_file($_FILES["image"]['tmp_name'], $filePath)) {
					chmod($filePath, 0777);
					Resize_File($filePath, $OptionsVis["viewer_width"], 0); 
					Resize_File($filePath, $OptionsVis["summ_img_width"], 0, $thumbPath);
		
					$sql = "UPDATE ".$TABLE["Events"]."  
							SET `image` = '".$name."'  
							WHERE id='".$index_id."'";
					$sql_result = sql_result($sql);
					$message = '';
				} else {
					$message = 'Cannot copy uploaded file to "'.$filePath.'". Try to set the right permissions (CHMOD 777) to "'.$CONFIG["upload_folder"].'" directory! ';  
				}
			} else {
				$message = 'Uploaded file must be in image format! ';    
			}
		} else { 
			//$message = $lang['Message_Image_file_is_not_uploaded']; 
		}
		
		
		$message .= ReadDB($OptionsLang["Event_has_been_submitted"]); 
		if($Options['event_approve']=='true') {
			$message .= ReadDB($OptionsLang["After_approve_will_publish"]);
		}
		
		/*---- SENDING EMAILS ---*/
		
		//adding PHPMailer library
		include( dirname(__FILE__). '/phpmailer/PHPMailerAutoload.php');
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		
		// Body of the email message to administrator
		$Message_body = "Event Title: <strong>".strip_tags(ReadDB($_REQUEST["title"]))."</strong><br>";
		$Message_body .= "Event Email: <strong>".strip_tags(ReadDB($_REQUEST["email"]))."</strong>";
		
		if($Options["smtp_auth"]=="yes") {
			
			
			//$mail->SMTPDebug = 3; // enables SMTP debug information: 1 = errors and messages; 2 = messages only; 3 = Enable verbose debug output
			
			$mail->isSMTP();								// Set mailer to use SMTP
			$mail->Host = $Options["smtp_server"];			// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;							// Enable SMTP authentication
			$mail->Username = $Options["smtp_email"];		// SMTP username
			$mail->Password = $Options["smtp_pass"];		// SMTP password
			$mail->SMTPSecure = $Options["smtp_secure"];	// Enable TLS encryption, `ssl` also accepted
			$mail->Port = (int)$Options["smtp_port"];		// TCP port to connect to
			
			$mail->CharSet = "UTF-8";						// force setting charset UTF-8
			
			
			$mail->SetFrom(ReadDB($Options["email"]), ReadDB($Options["email"])); 		// email from
			$mail->addAddress(ReadDB($Options["email"]), ReadDB($Options["email"]));	// Add a recipient
			$mail->AddReplyTo(ReadDB($Options["email"]), ReadDB($Options["email"]));	// Add reply To email
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			//$mail->addAttachment('/var/tmp/file.tar.gz');         	// Add attachments
			//$mail->isHTML(true);									// Set email format to HTML
			
			$mail->Subject = ReadDB($OptionsLang["New_event_submitted"]); // Set email subject
			
			$mail->Body    = $Message_body;
			$mail->AltBody = $Message_body;
			
			if(!$mail->send()) {
				//$message .= ' Message could not be sent.';
				//$message .= ' Mailer Error: ' . $mail->ErrorInfo;
			} else {
				//$message .= ' Message has been sent to admin!';
			}
			
			// Clear all and ready for next email sending
      		$mail->ClearAddresses();
			$mail->ClearAttachments();
			$mail->ClearReplyTos();
			$mail->ClearAllRecipients();
			//$mail->ClearCustomHeaders();
			
			
			// send message to the email of the person who submit that event 
			$mail->SetFrom(ReadDB($Options["email"]), ReadDB($Options["email"])); 		// email from
			$mail->addAddress(ReadDB($_REQUEST["email"]), ReadDB($_REQUEST["email"]));	// Add a recipient
			$mail->AddReplyTo(ReadDB($Options["email"]), ReadDB($Options["email"]));	// Add reply To email
			//$mail->addAttachment('/var/tmp/file.tar.gz');         	// Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name
			//$mail->isHTML(true);									// Set email format to HTML
			
			$mail->Subject = ReadDB($OptionsLang["Thanks_for_submitting_event"]); // Set email subject
			
			$mail->Body    = ReadDB($OptionsLang["Thanks_email_message"]);
			$mail->AltBody = ReadDB($OptionsLang["Thanks_email_message"]);
			if(!$mail->send()) {
				//$message .= ' Message could not be sent. ';
				//$message .= ' Mailer Error: ' . $mail->ErrorInfo;
			} else {
				//$message .= 'Message has been sent to submitter!';
			}
			
		} else {
			
			// create and send message to admin //
			//Set who the message is to be sent from
			$mail->setFrom(ReadDB($Options["email"]), ReadDB($Options["email"]));
			//Set an alternative reply-to address
			$mail->addReplyTo(ReadDB($Options["email"]), ReadDB($Options["email"]));
			//Set who the message is to be sent to
			$mail->addAddress(ReadDB($Options["email"]), ReadDB($Options["email"]));
			$mail->CharSet = "UTF-8"; // force setting charset UTF-8
			//Set the subject line
			$mail->Subject = ReadDB($OptionsLang["New_event_submitted"]); // Set email subject
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($Message_body);
			//Replace the plain text body with one created manually
			$mail->AltBody = $Message_body;
			//Attach an image file
			//$mail->addAttachment('images/phpmailer_mini.png');
			
			//send the message, check for errors
			if (!$mail->send()) {
				$message .= " Mailer Error: " . $mail->ErrorInfo;
			} else {
				//$message .= " Message sent to admin!";
			}
			
			// Clear all and ready for next email sending
      		$mail->ClearAddresses();
			//$mail->ClearAttachments();
			$mail->ClearReplyTos();
			$mail->ClearAllRecipients();
			//$mail->ClearCustomHeaders();
			
			
			if (trim($_REQUEST["email"])!='') {	
				// CREATE AND SEND MESSAGE TO EVENT SUBMITTER //
				//Set who the message is to be sent from
				$mail->setFrom(ReadDB($Options["email"]), ReadDB($Options["email"]));
				//Set an alternative reply-to address
				$mail->addReplyTo(ReadDB($Options["email"]), ReadDB($Options["email"]));
				//Set who the message is to be sent to
				$mail->addAddress(ReadDB($_REQUEST["email"]), ReadDB($_REQUEST["email"]));
				$mail->CharSet = "UTF-8"; // force setting charset UTF-8
				//Set the subject line
				$mail->Subject = ReadDB($OptionsLang["Thanks_for_submitting_event"]); // Set email subject
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML(ReadDB($OptionsLang["Thanks_email_message"]));
				//Replace the plain text body with one created manually
				$mail->AltBody = ReadDB($OptionsLang["Thanks_email_message"]);
				//Attach an image file
				//$mail->addAttachment('images/phpmailer_mini.png');
				
				//send the message, check for errors
				if (!$mail->send()) {
					//$message .= " Mailer Error: " . $mail->ErrorInfo;
				} else {
					//$message .= " Message sent to event submitter!";
				}
				
				
				// Clear all and ready for next email sending
				$mail->ClearAddresses();
				//$mail->ClearAttachments();
				$mail->ClearReplyTos();
				$mail->ClearAllRecipients();
				//$mail->ClearCustomHeaders();
			}

			//$mailheader = "From: ".ReadDB($Options["email"])."\r\n";
			//$mailheader .= "Reply-To: ".ReadDB($Options["email"])."\r\n";
			//$mailheader .= "Content-type: text/html; charset=UTF-8\r\n";
			//$Message_body = "Event Title: <strong>".strip_tags(ReadDB($_REQUEST["title"]))."</strong>";
			//mail(ReadDB($Options["email"]), ReadDB($OptionsLang["New_event_submitted"]), $Message_body, $mailheader);	
			
			//if (trim($_REQUEST["email"])!='') {	
			//	mail(ReadDB($_REQUEST["email"]), ReadDB($OptionsLang["Thanks_for_submitting_event"]), ReadDB($OptionsLang["Thanks_email_message"]), $mailheader);	
			//} 
		}
		
		unset($_REQUEST["act"]);
		
		echo '<script type="text/javascript">window.location.href="'.$thisPage.'?message='.urlencode($message).'";</script>';
			

	} else {
			# set the error code so that we can display it
			$message =  ReadDB($OptionsLang["Submit_incorrect_verify_code"]); 
			$_REQUEST["act"] = 'new';
	}
}

?>
<!-- Bootstrap core CSS -->
<!--- <link href="<?php echo $CONFIG["full_url"]; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --->

<!-- Custom styles for this template -->
<link rel="stylesheet" href="<?php echo $CONFIG["folder_name"]; ?>styles/font-awesome/css/font-awesome.min.css">
<?php include( dirname(__FILE__). "/styles/css_front_end.php"); ?>
<link href="<?php echo $CONFIG["folder_name"]; ?>styles/style.css" rel='stylesheet' type='text/css' />

<script type="text/javascript">var CalPosOffsetX = -26;</script>
<script type="text/javascript">var CalPosOffsetY = -16;</script>
<script type="text/javascript">var imageFilesPath = "<?php echo $CONFIG["full_url"]."images/"; ?>";</script>
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/datetimepicker_css.js"></script>
<?php if(!isset($jquery_added)) {?>
<script src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo $CONFIG["full_url"]; ?>lightbox/js/lightbox.min.js"></script>
<link href="<?php echo $CONFIG["full_url"]; ?>lightbox/css/lightbox.css" rel="stylesheet" />
<?php 
}
$jquery_added = true; 
?>
<script type="text/javascript" src="<?php echo $CONFIG["full_url"]; ?>include/textsizer.js">
/***********************************************
* Document Text Sizer- Copyright 2003 - Taewook Kang.  All rights reserved.
* Coded by: Taewook Kang (http://www.txkang.com)
***********************************************/
</script>

<div class="background_div">
<div class="front_wrapper_esp">
    <a name="ontitle"></a>
    
    <nav class="navbar navbar-expand-lg navbar-light flex-direction-no">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></i>
</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
          
		<?php if ((isset($_REQUEST["eid"]) and $_REQUEST["eid"]>0) or (isset($_REQUEST["act"]) and $_REQUEST["act"]=='new')) { ?>
          		<!-- back link -->
                <?php if(trim($OptionsLang["Back_to_home"])!='') { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $thisPage; ?><?php echo $url_vars; ?>"><i class="fa fa-caret-left"></i></i> <?php echo ReadDB($OptionsLang["Back_to_home"]);?></a>
                </li>
                <?php } ?>
		<?php } else { ?>
                <!-- submit event link -->
                <?php if(trim($OptionsLang["Submit_an_Event"])!='') { ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo $thisPage; ?>?act=new"><?php echo ReadDB($OptionsLang["Submit_an_Event"]);?></a>
                </li>
                <?php } ?>
          
          
			  <?php		
              if(!isset($_REQUEST['hide_cat']) and $Options['showcategdd']!='no') { 			
                $sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY `cat_name` ASC";
                $sql_result = sql_result($sql);
                if (mysqli_num_rows($sql_result)>0) {
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="?cat_id=0" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $OptionsLang["Category"]; ?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <a class="dropdown-item" href="?cat_id=0"><?php echo $OptionsLang["Category_all"]; ?></a>
                  <?php 
                  while ($Cat = mysqli_fetch_assoc($sql_result)) { ?>
                  <a class="dropdown-item" href="<?php echo $thisPage; ?>?cat_id=<?php echo $Cat["id"]; ?>"><?php echo ReadDB($Cat["cat_name"]); ?></a>
                  <?php } ?>
                </div>
              </li>          
              <?php } 
                }          
              ?>
		<?php } ?>
          
        </ul>
        <?php if($Options['showsearch']!='no') { ?>
        <form class="form-inline" action="<?php echo $thisPage; ?>">
        	<div class="md-form mt-0">
          		<input class="form-control" type="text" placeholder="<?php echo $OptionsLang["Search_button"]; ?>" name="search" value="<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') echo htmlspecialchars(urldecode($_REQUEST["search"]), ENT_QUOTES); ?>">
            </div>
          	<!--- <div class="md-form mt-0">
            	<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div> --->
        </form>
        <?php } ?>
      </div>
    </nav>
    
    <div class="back_link_dist"></div> 

	<?php if(isset($message) and $message!="") { ?>
    <div class="event_message"><?php if(isset($message)) echo $message; ?></div>
    <?php } elseif(isset($_REQUEST['message']) and $_REQUEST['message']!="") { ?>
    <div class="event_message"><?php if(isset($_REQUEST['message'])) echo urldecode($_REQUEST['message']); ?></div>
    <?php } ?>

<?php
if (isset($_REQUEST["eid"]) and $_REQUEST["eid"]>0) {
	$_REQUEST["eid"]= (int) SafetyDB($_REQUEST["eid"]);
?>
	<div class="clearboth"></div>    
	
    <div class="event_details">
		<?php 
        $sql = "SELECT * FROM ".$TABLE["Events"]." WHERE status='Published' AND id='".SafetyDB($_REQUEST["eid"])."'";
        $sql_result = sql_result($sql);
        if(mysqli_num_rows($sql_result)>0) {	
          $Event = mysqli_fetch_assoc($sql_result);
        ?>
        
        <!-- Event title -->
        <div class="event_title">	  
            <?php echo ReadDB($Event["title"]); ?>     
        </div>   
        
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
        <div class="event_text">
        
          <?php if(ReadDB($Event["image"])!='') { ?>
            <div class="img_left">
                <a href="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Event["image"]); ?>" rel="lightbox[]" title="<?php echo ReadHTML($Event["title"]); ?>">
                    <img style="max-width:<?php echo $Event["imgwidth"]; ?>" class="image_full" src="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Event["image"]); ?>" alt="<?php echo ReadHTML($Event["title"]); ?>" />
                </a>
            </div>
          <?php } /// end of image if statement for images left, right and top /// ?>
            
            <?php 
            $start_dt = $Event["eventdate"]." ".$Event["starting_t"];
            $end_time = $Event["eventdate"]." ".$Event["ending_t"];
            
            if($Event["end_date"]>$Event["eventdate"]) {
                $end_day = $Event["end_date"]." ".$Event["starting_t"];
            }		
            ?>
            <p class="cont_edate">
            <?php echo $OptionsLang["Event_Date"]; ?> 
            <?php 
            echo lang_date(date($OptionsVis["edate_format"],strtotime($start_dt))); 
            
            if($Event["end_date"]>$Event["eventdate"]) { 
                echo " - ". lang_date(date($OptionsVis["edate_format"],strtotime($end_day))); 
            }  
            ?>
            </p>
            
            <?php if($OptionsVis["eshowhide_time"]!="no") { ?>
            <p class="cont_etime">
                <?php echo $OptionsLang["Event_Time"]; ?> <?php echo date($OptionsVis["eshowing_time"],strtotime($start_dt)); if($Event['hide_endtime']!="yes") { echo "&nbsp;-&nbsp;".date($OptionsVis["eshowing_time"],strtotime($end_time)); } ?>
            </p>
            <?php } ?>
            
            
            <?php if(trim($Event["location"])!="") { ?>
                <p class="cont_loc">
                <?php echo $OptionsLang["Location"]; ?> 
                <?php if($Options["show_gmap"]!="no") {?>
                    <a class="cont_loc_a" href="#popup1"><?php echo ReadHTML($Event["location"]); ?></a> 
                    <a class="buttonmap" href="#popup1"><img src="<?php echo $CONFIG["full_url"]; ?>images/gmaps-marker.png" width="20" alt="google maps marker"></a>
                <?php } else { ?>
                    <?php echo ReadHTML($Event["location"]); ?>
                <?php } ?>
                </p>
                
                <!-- google map popup ovelay starts here -->
                <style type="text/css">
                #map_canvas {
                  height: 400px;
                  width: 100%;
                  margin: 0px;
                  padding: 0px
                }
                </style>
                <div id="popup1" class="overlay">
                    <div class="popupGMAP">
                        <a class="close" href="#">&times;</a>
                        <div class="contentGMAP">
                            <script>
                            function initialize() {
                              var address = '<?php echo ReadDB($Event["location"]); ?>';
                            
                              var geocoder = new google.maps.Geocoder();
                              geocoder.geocode({
                                'address': address
                              }, function(results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                  var Lat = results[0].geometry.location.lat();
                                  var Lng = results[0].geometry.location.lng();
                                  
                                  //alert("Latitude: " + Lat + ", Longitute: " + Lng);
                                  var EventCoordinates = "Latitude: " + Lat + ", Longitute: " + Lng;
                                  document.getElementById('EventCoordinates').innerHTML = EventCoordinates;
                                  
                                  var myOptions = {
                                    zoom: 12,
                                    center: new google.maps.LatLng(Lat, Lng)
                                  };
                                  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                  
                                  var marker = new google.maps.Marker({
                                      map: map,
                                      position: results[0].geometry.location
                                  });
                                  
                                } else {
                                  // alert("Something got wrong " + status); // alert status, uncomment for debugging
								  document.getElementById("map_canvas").innerHTML = "Please, use correct event location! ";
                                }
                              });
                            }
                            </script>
                            
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyC1UMly9-ahAkJ8wubQl7299A7IQk1CGAs&callback=initialize">
                            </script>
                            <div id="EventCoordinates"></div>
                            <div id="map_canvas"></div>
                        </div>
                    </div>
                </div>
                <!-- google map popup ovelay ends here -->
            <?php } ?>
            
            <p class="cont_pric">
            <?php if(trim($Event["price"])!="") { ?>
                <?php echo $OptionsLang["Price"]; ?> <?php echo ReadHTML($Event["price"]); ?> 
            <?php } ?>
            </p> 
            
            <span id="content"><?php echo ReadDB($Event["content"]); ?> </span>
        </div>
        
        <div class="clearboth"></div> 
        
        <?php 
        $sql = "UPDATE ".$TABLE["Events"]." 
                SET reviews = reviews + 1 
                WHERE `id`='".$Event["id"]."'";
        $sql_result = sql_result($sql);
        ?>
        
        <?php if($OptionsVis["show_share_this"]=='yes') { 
			$share_font_size = (int)($OptionsVis["share_font_size"]);
			if($share_font_size<9) $share_font_size = 9; 
		?>
        <div class="share_buttons">
            <!-- AddToAny BEGIN -->
            <div class="a2a_kit a2a_kit_size_<?php echo $share_font_size; ?> a2a_default_style">
            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_google_plus"></a>
            <a class="a2a_button_pinterest"></a>
            </div>
            <script>
            var a2a_config = a2a_config || {};
            a2a_config.locale = "bg";
            a2a_config.num_services = 6;
            a2a_config.color_main = "D7E5ED";
            a2a_config.color_border = "AECADB";
            a2a_config.color_link_text = "333333";
            a2a_config.color_link_text_hover = "333333";
            a2a_config.prioritize = ["facebook", "twitter", "pinterest", "google_plus", "email"];
            </script>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
            <!-- AddToAny END -->     
        </div>
        <?php } ?>
        <div class="clearboth"></div> 
        
        <?php 
        } // end if event item mysql num rows 
        ?>
	</div>

<?php
} elseif(isset($_REQUEST["act"]) and $_REQUEST["act"]=='new') {
?>
    <script type="text/javascript"> 	
	function limitText(limitField, limitNum) {
		if (limitField.value.length > limitNum) {
			limitField.value = limitField.value.substring(0, limitNum);
		} 
	}
	
	function checkForm(form){
        var chekmail = /([0-9a-zA-Z\.-_]+)@([0-9a-zA-Z\.-_]+)/;
    
       var title, location, email, string, isOk = true;
		<?php if($Options['captcha']!='phpcaptcha' and $Options['captcha']!='nocap') { // if the option is NOT set to phpcaptcha or no Captcha ?>
		var string;
		<?php } ?>
        var message = "";
        
        message ="<?php echo $OptionsLang["Submit_Fill_the_required_fields"]; ?>";
        
        title		= form.title.value;
        location	= form.location.value;
        email		= form.email.value;
		<?php if($Options['captcha']!='phpcaptcha' and $Options['captcha']!='nocap') { // if the option is NOT set to phpcaptcha or no Captcha ?>
		string		= form.string.value;
		<?php } ?>
    
        if (title.length==0){
            form.title.focus();
            isOk=false;
        }
		else if (location.length==0){
            form.location.focus();
            isOk=false;
        }
        else if (email.length<5){
            form.email.focus();
            isOk=false;
        }	
        else if (email.length>=5 && email.match(chekmail)==null){
            message ="<?php echo $OptionsLang["Submit_incorrect_email"]; ?>";
            form.email.focus();
            isOk=false;
        }
		<?php if($Options['captcha']!='phpcaptcha' and $Options['captcha']!='nocap') { // if the option is NOT set to phpcaptcha or no Captcha ?>
		else if (string.length==0){
			message ="<?php echo $OptionsLang["field_code"]; ?>";
			form.string.focus();
			isOk=false;
		}
		<?php } ?>
    
        if (!isOk){			  
            alert(message);
            return isOk;
        } else {
            return isOk;
        }
    }
	</script>    
	<div class="clearboth"></div>    
    
    <div id="submit_event_form">
        <form action="<?php echo $thisPage; ?>" method="post" name="form1" id="esf" enctype="multipart/form-data">
        <input type="hidden" name="act" value="submit_listing" />
        <h1 class="h1_submit_heading"><?php echo ReadDB($OptionsLang["Submit_Event_head"]);?></h1>
        	
            <!-- Event Start Date -->
            <label class="edates">
            <span><?php echo ReadDB($OptionsLang["Submit_Date_Start"]);?></span>
            <a href="javascript:NewCssCal('eventdate','yyyyMMdd','arrow')"><input type="text" name="eventdate" id="eventdate" maxlength="10" value="<?php if(isset($_REQUEST['eventdate']) and $_REQUEST['eventdate']!='') { echo $_REQUEST['eventdate']; } else { echo date("Y-m-d"); } ?>" readonly required autofocus class="submit_field_edate" /></a>            
            </label>
            <!-- Event End Date -->
            <label class="edates">
            <span><?php echo ReadDB($OptionsLang["Submit_Date_End"]);?></span>
            <a href="javascript:NewCssCal('end_date','yyyyMMdd','arrow')"><input type="text" name="end_date" id="end_date" maxlength="10" value="<?php if(isset($_REQUEST['end_date']) and $_REQUEST['end_date']!='') { echo $_REQUEST['end_date']; } else { echo date("Y-m-d"); } ?>" readonly required autofocus class="submit_field_edate" /></a>            
            </label>
            
            <div class="clearboth"></div>
            
            <!-- Event Start Time -->
            <?php 			
			if($OptionsVis['eshowing_time']=='g:i a') {
				$startAt = 0;
				$endAt = 12;
			} else {
				$startAt = 0;
				$endAt = 23;
			}			
			?> 
            <label class="etimes">
            <?php echo ReadDB($OptionsLang["Submit_Time_Start"]);?> 
            <div class="clearboth"></div>
            <select name="starting_h" class="submit_field_etime">
				<?php for($i=$startAt; $i<=$endAt; $i++) {?>
                <option value="<?php echo $i; ?>"<?php if(isset($_REQUEST['starting_h']) and $_REQUEST['starting_h']==$i){ echo ' selected="selected"'; } ?>><?php echo $i; ?>h</option>
                <?php } ?>
            </select>
            <select name="starting_m" class="submit_field_etime">
                <?php for($i=0; $i<=59; $i+=5) {?>
                <option value="<?php echo $i; ?>"<?php if(isset($_REQUEST['starting_m']) and $_REQUEST['starting_m']==$i){ echo ' selected="selected"'; } ?>><?php echo $i; ?>m</option>
                <?php } ?>
            </select>
            <?php
            if($OptionsVis['eshowing_time']=='g:i a') {
            ?>
            <select name="sAmPm" class="submit_field_etime">
                <option value="am"<?php if(isset($_REQUEST['sAmPm']) and $_REQUEST['sAmPm']=="am") { echo ' selected="selected"'; } ?>>AM</option>
                <option value="pm"<?php if(isset($_REQUEST['sAmPm']) and $_REQUEST['sAmPm']=="pm") { echo ' selected="selected"'; } ?>>PM</option>
            </select>
            <?php
            }
            ?>           
            </label>            
            <!-- Event End Date -->
            <label class="etimes_end">
            <?php echo ReadDB($OptionsLang["Submit_Time_End"]); ?> 
            <div class="clearboth"></div>
            <select name="ending_h" class="submit_field_etime">
				<?php for($i=$startAt; $i<=$endAt; $i++) {?>
                <option value="<?php echo $i; ?>"<?php if(isset($_REQUEST['ending_h']) and $_REQUEST['ending_h']==$i){ echo ' selected="selected"'; } ?>><?php echo $i; ?>h</option>
                <?php } ?>
            </select>
            <select name="ending_m" class="submit_field_etime">
                <?php for($i=0; $i<=59; $i+=5) {?>
                <option value="<?php echo $i; ?>"<?php if(isset($_REQUEST['ending_m']) and $_REQUEST['ending_m']==$i){ echo ' selected="selected"'; } ?>><?php echo $i; ?>m</option>
                <?php } ?>
            </select>
            <?php
            if($OptionsVis['eshowing_time']=='g:i a') {
            ?>
            <select name="eAmPm" class="submit_field_etime">
                <option value="am"<?php if(isset($_REQUEST['eAmPm']) and $_REQUEST['sAmPm']=="am") { echo ' selected="selected"'; } ?>>AM</option>
                <option value="pm"<?php if(isset($_REQUEST['eAmPm']) and $_REQUEST['sAmPm']=="pm") { echo ' selected="selected"'; } ?>>PM</option>
            </select>
            <?php
            }
            ?>           
            </label>
            
            <label class="hide_time">
            <input name="hide_endtime" type="checkbox" value="yes" <?php if(isset($_REQUEST['hide_endtime']) and $_REQUEST['hide_endtime']=="yes"){ echo ' checked="checked"'; } ?> /> <?php echo ReadDB($OptionsLang["Submit_Hide"]); ?> 
            </label>
            
                
            <div class="clearboth"></div>
        
            <label>
            <span><?php echo ReadDB($OptionsLang["Submit_Title"]); ?></span>
            <input type="text" placeholder="" name="title" id="title" value="<?php if(isset($_REQUEST["title"])) echo $_REQUEST["title"]; ?>" required autofocus class="submit_field">
            </label>
            
            <div class="clearboth"></div>
            
            <label>
            <span><?php echo ReadDB($OptionsLang["Description"]); ?></span>
            <textarea name="description" id="description" rows="10" onKeyDown="limitText(this,3000);" onKeyUp="limitText(this,3000);" onclick="limitText(this,3000);" onmousemove="limitText(this,3000);" class="submit_field"><?php if(isset($_REQUEST["description"])) echo $_REQUEST["description"]; ?></textarea>
            </label>
            
            
            
            <?php
			$sql = "SELECT * FROM ".$TABLE["Categories"]." ORDER BY `cat_name` ASC";
			$sql_result = sql_result($sql);
			if (mysqli_num_rows($sql_result)>0) {
			  
			?>
            <div class="clearboth"></div>            
            <label>
            <span><?php echo ReadDB($OptionsLang["Category"]); ?></span>
            <select name="cat_id" class="submit_field_categ">
            	<?php
				while ($Cat = mysqli_fetch_assoc($sql_result)) {
				?>
                <option value="<?php echo $Cat["id"]; ?>"<?php if($Cat["id"]==$_REQUEST["cat_id"]) echo ' selected="selected"'; ?>><?php echo ReadDB($Cat["cat_name"]); ?></option>
				<?php
                }
                ?>      
            </select>          
            </label>
            <?php
			} else {
			?>
			<input name="cat_id" type="hidden" value="0">
            <?php
			}
			?>
            
            <div class="clearboth"></div>
            
            <label>
            <span><?php echo ReadDB($OptionsLang["Submit_Price"]); ?> <span class="addit_info"><?php echo ReadDB($OptionsLang["Submit_Price_info"]); ?></span></span>
            <input type="text" placeholder="" name="price" id="price" value="<?php if(isset($_REQUEST["price"])) echo $_REQUEST["price"]; ?>" class="submit_field">
            </label>
            
            <div class="clearboth"></div>
            
            <label>
            <span><?php echo ReadDB($OptionsLang["Submit_Location"]); ?> <span class="addit_info"><?php echo ReadDB($OptionsLang["Submit_Location_info"]); ?></span></span>
            <input type="text" placeholder="" name="location" id="location" value="<?php if(isset($_REQUEST["location"])) echo $_REQUEST["location"]; ?>" required autofocus class="submit_field">
            </label>
            
            <div class="clearboth"></div>
            
            <label>
            <span><?php echo ReadDB($OptionsLang["Submit_Image"]); ?> <span class="addit_info"><?php echo ReadDB($OptionsLang["Submit_Image_info"]); ?></span></span>
            <input type="file" name="image" id="image" autofocus class="submit_field">
            </label>
            
            <div class="clearboth"></div>
            
            <label>
            <span><?php echo ReadDB($OptionsLang["Submit_Email"]); ?> <span class="addit_info"><?php echo ReadDB($OptionsLang["Submit_Email_Info"]); ?></span></span>
            <input type="text" placeholder="" name="email" id="email" value="<?php if(isset($_REQUEST["email"])) echo $_REQUEST["email"]; ?>" required autofocus class="submit_field">
            </label>
            
            
            
			<?php 
			if($Options['captcha']!='nocap') { // if the option is set to no Captcha
			?>
			<label>
            	<div><?php echo $OptionsLang["Enter_verify_code"]; ?></div>
				<?php if($Options['captcha']=='phpcaptcha') { // if the option is set to phpcaptcha
                 	$options = array();
                    $options['input_text'] = $OptionsLang["verify_placeholder"]; // change placeholder
					//$options['securimage_path'] = $CONFIG["full_url"]."securimage"; // securimage path
					//$options['namespace']  = 'EventScriptPHP20';
					//$options['show_text_input'] = false; // change placeholder
					//$options['disable_flash_fallback'] = false; // allow flash fallback
					
                    echo "<div id='captcha_container_1'>\n";
                    echo Securimage::getCaptchaHtml($options);
                    echo "\n</div>\n"; 

				} elseif($Options['captcha']=='capmath') { ?>            
				<img src="<?php echo $CONFIG["folder_name"]; ?>captchamath.php" id="captcha" class="form_captcha_img" alt="Mathematical catpcha image" />
				<div class="form_captcha_eq"> = </div><input type="text" name="string" maxlength="3" class="submit_field form_captcha_math" placeholder="" required />  	
				
				<?php } elseif($Options['captcha']=='cap') {  ?>
					<input type="text" name="string" class="submit_field form_captcha_s" placeholder="Captcha" required /> 
					<img src="<?php echo $CONFIG["folder_name"]; ?>captcha.php" class="form_captcha_img" alt="Simple catpcha image"/>
				<?php 
				} else { ?>
					<input type="text" name="string" class="submit_field form_captcha_s" placeholder="Captcha" required /> 
					<img src="<?php echo $CONFIG["folder_name"]; ?>captchasimple.php" class="form_captcha_img" alt="Very catpcha image" />
				<?php } ?>        
			</label>
			<?php 
			}
			?>
            
            
            <div class="clearboth"></div>
            
            <div class="required_fields">* - <?php echo ReadDB($OptionsLang["Submit_Required_fields"]); ?></div>
            
            <input class="btn_esf" type="submit" name="Submit" value="Submit Event" onclick="return checkForm(this.form)">   
            
        </form>
    </div>
    
    <div class="clearboth"></div>
    
<?php
} else {
?>  
     	
	<?php 
    if(isset($_REQUEST["p"]) and $_REQUEST["p"]!='') { 
        $pageNum = (int) SafetyDB(urldecode($_REQUEST["p"]));
        if($pageNum<=0) $pageNum = 1;
    } else { 
        $pageNum = 1;
    }
    
    $search = "";
	
	if ($_REQUEST["cat_id"]>0) $search .= " AND cat_id='".SafetyDB($_REQUEST["cat_id"])."'";
    
    if(isset($_REQUEST["search"]) and ($_REQUEST["search"]!="")) {
        $find = SafetyDB(urldecode($_REQUEST["search"]));
        $search .= " AND (title LIKE '%".$find."%' OR location LIKE '%".$find."%' OR summary LIKE '%".$find."%' OR content LIKE '%".$find."%')";
    }
    
    if($Options["hideold"]=="yes") {
        //$search .= " AND CONCAT_WS(' ',CAST(eventdate AS CHAR),CAST(starting_t AS CHAR)) >= '".date("Y-m-") . (date("d")-1) . " ".date("H:i:s")."'";
        //$search .= " AND CONCAT('eventdate','ending_t') >= '".date("Y-m-d").date("H:i:s")."'";
        //$search .= " AND eventdate > '".date("Y-m-") . (date("d")-1)."'";			
        $search .= " AND end_date >= '".date("Y-m-d")."'";
        //$search .= " AND ending_t >= '".date("H:i:s")."'";
    } 
    
    if($Options["orderby"]=="publish_date DESC") {
        $orderby = " publish_date DESC ";
    } elseif($Options["orderby"]=="publish_date ASC") {
        $orderby = " publish_date DESC ";
    } elseif($Options["orderby"]=="eventdate DESC") {
        $orderby = " eventdate DESC ";
    } else {
        $orderby = " eventdate ASC ";
    }
    
            
    $sql = "SELECT count(*) as total FROM ".$TABLE["Events"]." WHERE status='Published' ".$search;
    $sql_result = sql_result($sql);
    $row  = mysqli_fetch_array($sql_result);
    mysqli_free_result($sql_result);
    $total_pages = $row["total"];
    $adjacents = 2; // the adjacents to the current page digid when some pages are hidden
    $limit = $Options["per_page"];  //how many items to show per page
    $page = (int) SafetyDB(urldecode($_REQUEST["p"]));
    
    if($page) { 
        $start = ($page - 1) * $limit;  //first item to display on this page
    } else {
        $start = 0;	 //if no page var is given, set start to 0
    }
    
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;					//if no page var is given, default to 1.
    $prev = $page - 1;							//previous page is page - 1
    $next = $page + 1;							//next page is page + 1
    $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;						//last page minus 1
    
    // pagination query and variables ends

    $sql = "SELECT * FROM ".$TABLE["Events"]."  
            WHERE status='Published' ".$search." 
            ORDER BY featured ASC, ".$orderby." 
            LIMIT " . ($pageNum-1)*$Options["per_page"] . "," . $Options["per_page"];	
    $sql_result = sql_result($sql);
    
    if (mysqli_num_rows($sql_result)>0) {	
      while ($Event = mysqli_fetch_assoc($sql_result)) {
		// fetch event category
		$sqlCat   = "SELECT * FROM ".$TABLE["Categories"]." WHERE `id`='".$Event["cat_id"]."'";
		$sql_resultCat = sql_result($sqlCat);
		$Cat = mysqli_fetch_array($sql_resultCat);
    ?>
           
    <div class="summary_wrap"> 
        
        <?php if(ReadDB($Event["image"])!='') { ?>
        <div class="summary_img_wrap" onClick="parent.location='<?php echo
$thisPage; ?>?eid=<?php echo $Event['id']; ?><?php echo $url_vars; ?>'" style="background-image:url('<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadDB($Event["image"]); ?>');">
        </div>
        <?php } else { ?>
        <div class="summary_img_wrap" onClick="parent.location='<?php echo
$thisPage; ?>?eid=<?php echo $Event['id']; ?><?php echo $url_vars; ?>'" style="background-image:url('<?php echo $CONFIG["full_url"]; ?>images/placeholder.png');">
        </div>
        <?php } ?>
                    
        <div class="summary_text_wrap">     
			<?php 
            $start_dt = $Event["eventdate"]." ".$Event["starting_t"];
            $end_time = $Event["eventdate"]." ".$Event["ending_t"];
            
            if($Event["end_date"]>$Event["eventdate"]) {
                $end_day = $Event["end_date"]." ".$Event["starting_t"];
            }	
            ?>
            <p class="summ_edate">
            <?php 
            echo lang_date(date($OptionsVis["summ_edate_format"],strtotime($start_dt))); 
            
            if($Event["end_date"]>$Event["eventdate"]) { 
                echo " - ". lang_date(date($OptionsVis["summ_edate_format"],strtotime($end_day))); 
            }  
            
			if($OptionsVis["summ_eshowing_time"]!="") { echo ",&nbsp;&nbsp;".strtoupper(date($OptionsVis["summ_eshowing_time"],strtotime($start_dt))); if($Event['hide_endtime']!="yes") { echo "&nbsp;-&nbsp;".strtoupper(date($OptionsVis["summ_eshowing_time"],strtotime($end_time))); } ?>
            </p>
            <?php } ?>
            
            
            <!-- events list title -->
            <div class="event_title_summ">
                <a href="<?php echo $thisPage; ?>?eid=<?php echo $Event['id']; ?><?php echo $url_vars; ?>">
                    <?php echo ReadDB($Event["title"]); ?>
                </a>
            </div>
            
            
            <p class="summ_loc">
            <?php if(trim($Event["location"])!="") { ?>
                <?php echo $OptionsLang["Location"]; ?><?php echo ReadHTML($Event["location"]); ?>
            <?php } else { ?>&nbsp;<?php } ?>
            </p>
            
            <p class="summ_pric">
            <?php if(trim($Event["price"])!="") { ?>
                <?php echo $OptionsLang["Price"]; ?><?php echo ReadHTML($Event["price"]); ?> 
            <?php } else { ?>&nbsp;<?php } ?>
            </p>         
            
        
    
            <div>
                <span class="cat_name"><?php echo ReadDB($Cat['cat_name']); ?></span>        
                <a class="readmore" href="<?php echo $thisPage; ?>?eid=<?php echo $Event['id']; ?><?php echo $url_vars; ?>"><?php echo $OptionsLang['Read_more']; ?> <div class="arrow-right"></div></a>  
            </div>      
          
            <div class="clearboth"></div>
        </div>
        <div class="clearboth"></div>
    </div>  
     
    <div class="dist_btw_events"></div>
    
    <?php 
      } 
    } else {
    ?>
    <div class="No_events_published"><?php echo $OptionsLang['No_events_published'] ?></div>
    <?php	
    }
    mysqli_free_result($sql_result);
    ?>   
        
    
    <!-- Pagination start here --> 
	<?php 
    // pagination starts. It can be shown wherever we need
    if($lastpage > 1) {	
        // defining recurring url variables
        $paging_vars = "&amp;cat_id=".urlencode($_REQUEST["cat_id"])."&amp;search=".urlencode($_REQUEST["search"]);
    ?>
    <nav class="esp_pagination">
        <ul class="pager-esp">
        
        <?php //previous button starts
        if ($page > 1) {
        ?>	
            <li>
                <a href="<?php echo $thisPage."?p=".$prev;?><?php echo $paging_vars; ?>" title="previous">
                    <i class="fa fa-angle-left"></i>
                </a>
            </li>
        <?php } ?>               
            
            
        <?php //pages	start
        if ($lastpage < 7 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
          for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page) { 
        ?>
            <li class="active"><span class="active"><?php echo AddZero($counter); ?></span></li>
        <?php 
            } else { 
        ?>
            <li class="mobPag"><a href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo AddZero($counter); ?></a></li>
        <?php 
            } 				
          }
        }
        elseif($lastpage > 5 + ($adjacents * 2)) {	//enough pages to hide some		
          //close to beginning; only hide later pages
          if($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
              if ($counter == $page) { 
        ?>
            <li class="active"><span class="active"><?php echo AddZero($counter); ?></span></li>
        <?php } else { ?>
            <li class="mobPag"><a href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo AddZero($counter); ?></a></li>
        <?php } 				
            } 
        ?>
            <a class="mobPag" href="<?php echo $thisPage."?p=".$lastpage; ?><?php echo $paging_vars; ?>">...</a>                
          <?php   
          } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { //in middle; hide some front and some back ?>
            <a class="mobPag" href="<?php echo $thisPage; ?>?p=1<?php echo $paging_vars; ?>">...</a>                
            <?php 
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
              if ($counter == $page) { ?>
            <li class="active"><span class="active"><?php echo AddZero($counter); ?></span></li>
              <?php 
              } else { 
              ?>
            <li class="mobPag"><a href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo AddZero($counter); ?></a></li>
            <?php 
              }                                         
            } 
            ?>
            <a class="mobPag" href="<?php echo $thisPage."?p=".$lastpage; ?><?php echo $paging_vars; ?>">...</a>
          <?php     		
          } else { //close to end; only hide early pages  ?>
            <a class="mobPag" href="<?php echo $thisPage; ?>?p=1<?php echo $paging_vars; ?>">...</a>
            <?php 
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
              if ($counter == $page) { ?>
            <li class="active"><span class="active"><?php echo AddZero($counter); ?></span></li>
              <?php 
              } else { 
              ?>
            <li class="mobPag"><a href="<?php echo $thisPage."?p=".$counter; ?><?php echo $paging_vars; ?>"><?php echo AddZero($counter); ?></a></li>
              <?php 
              } 					
            }
          }
        }
        ?>            
            
        <?php //next button
        if ($page < $counter - 1) { ?>
            <li>
                <a href="<?php echo $thisPage."?p=".$next; ?><?php echo $paging_vars; ?>" title="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        <?php } ?>
        
        </ul>
    </nav>
    <!-- Pagination end here -->         	
    <?php 
    } // pagination ends	
    ?> 

<?php
}
?>
</div>
</div>
<!-- Bootstrap core JavaScript -->
<script src="<?php echo $CONFIG["full_url"]; ?>bootstrap/dist/js/bootstrap.min.js"></script>
    