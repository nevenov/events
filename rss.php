<?php
namespace EventScriptPHP20;
header("Content-type: text/xml"); 
$installed = '';
include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);

echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<atom:link href="<?php echo $CONFIG["full_url"]; ?>rss.php" rel="self" type="application/rss+xml" />
	<title>Events RSS</title>
	<description>Latest 10 Events</description>
	<link><?php if(trim($Options["items_link"])!=''){ echo ReadDB($Options["items_link"]); } else { echo $CONFIG["full_url"]."preview.php"; } ?></link>
    <atom:link href="<?php echo $CONFIG["full_url"]; ?>rss.php" rel="self" type="application/rss+xml" />
<?php
	$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE status='Published' ORDER BY publish_date DESC LIMIT 0,10";
	$sql_result = sql_result($sql);
	while ($Event = mysqli_fetch_assoc($sql_result)) {
		$isPermaLink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFG1234567890'), 0, 20);
?>
	<item>
		<guid isPermaLink='false'><?php echo $isPermaLink.$Event["id"]; ?></guid>
		<title><![CDATA[<?php echo ReadDB($Event["title"]); ?>]]></title>
        <link><?php if(trim($Options["items_link"])!=''){ echo ReadDB($Options["items_link"])."?id=".$Event['id']; } else { echo $CONFIG["full_url"]."preview.php?id=".$Event["id"]; } ?></link>
		<description><![CDATA[<?php echo ReadDB($Event["content"]); ?>]]></description>
        <pubDate><?php echo date("D, d M Y H:i:s O",strtotime($Event["publish_date"])); ?></pubDate>
        <?php if($Event["image"]!='') { ?>
        <enclosure url="<?php echo $CONFIG["full_url"].$CONFIG["upload_thumbs"].$Event["image"]; ?>" length="<?php echo filesize($CONFIG["server_path"].$CONFIG["upload_thumbs"].$Event["image"]); ?>" type="image/jpeg" />
        <?php } ?>
	</item>
<?php } ?>
</channel>
</rss>