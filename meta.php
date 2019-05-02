<?php 
namespace EventScriptPHP20;
$installed = '';
if(!isset($configs_are_set_ev)) {
	include( dirname(__FILE__). "/configs.php");
}

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);
mysqli_free_result($sql_result);
$OptionsLang = unserialize($Options['language']);

if (isset($_REQUEST["eid"]) and $_REQUEST["eid"]>0) {
	$_REQUEST["eid"]= (int) SafetyDB($_REQUEST["eid"]);
	?>
	<?php 
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE id='".SafetyDB($_REQUEST["eid"])."' and status='Published'";
	$sql_result = sql_result($sql);
	if(mysqli_num_rows($sql_result)>0) {	
	  $Meta = mysqli_fetch_assoc($sql_result);
	?>
	<title><?php echo ReadHTML($Meta["title"]); ?></title>
	<meta name="description" content="<?php echo cutText(ReadHTML(strip_tags($Meta["content"])), 180); ?>" />
    <meta property="og:title" content="<?php echo ReadHTML($Meta["title"]); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?php echo $CONFIG["full_url"].$CONFIG["upload_folder"].ReadHTML($Meta["image"]);?>" />
    <meta property="og:description" content="<?php echo cutText(ReadHTML(strip_tags($Meta["content"])), 300); ?>" />
	<?php 
	} 
} else {
?>
	<title><?php echo ReadHTML($OptionsLang["metatitle"]); ?></title>
	<meta name="description" content="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" />
<?php 
}
?>