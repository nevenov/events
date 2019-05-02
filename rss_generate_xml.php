<?php
namespace EventScriptPHP20;
//include("configs.php");

$sql = "SELECT * FROM ".$TABLE["Options"];
$sql_result = sql_result($sql);
$Options = mysqli_fetch_assoc($sql_result);

$rss = '<?xml version="1.0" encoding="utf-8"?>
';
$rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
';
$rss .= ' <channel>
';
$rss .= '  <title>Events RSS</title>
';
$rss .= '  <description>Latest 10 Events</description>
';

if(trim($Options["items_link"])!=''){ $LinkChannel = ReadDB($Options["items_link"]); } else { $LinkChannel = $CONFIG["full_url"]."preview.php"; }

$rss .= '  <link>'.$LinkChannel.'</link>
';
$rss .= '  <atom:link href="'.$CONFIG["full_url"].'rss.xml" rel="self" type="application/rss+xml" />
';

$sql = "SELECT * FROM ".$TABLE["Events"]." WHERE status='Published' ORDER BY publish_date DESC LIMIT 0,10";
$sql_result = sql_result($sql);
while ($Event = mysqli_fetch_assoc($sql_result)) {
	$isPermaLink = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFG1234567890'), 0, 20);

	$rss .= '  
	<item>
	';
	$rss .= '	<guid isPermaLink="false">'.$isPermaLink.$Event["id"].'</guid>
	';
	$rss .= '	<title><![CDATA['.ReadDB($Event["title"]).']]></title>
	';
	$rss .= '	<link>';
	if(trim($Options["items_link"])!=''){ 
		$rss .= ReadDB($Options["items_link"]).'?id='.$Event['id']; 
	} else { 
		$rss .= $CONFIG["full_url"].'preview.php?id='.$Event["id"]; 
	}
	$rss .= '</link>
	';
	$rss .= '	<description><![CDATA['.ReadDB($Event["summary"]).']]></description>
	';
	$rss .= '	<pubDate>'.date("D, d M Y H:i:s O",strtotime(@$Event["publish_date"])).'</pubDate>
	';
	if($Event["image"]!='') { 
	$rss .= '	<enclosure url="'.$CONFIG["full_url"].$CONFIG["upload_folder"].$Event["image"].'" length="'.filesize($CONFIG["server_path"].$CONFIG["upload_thumbs"].$Event["image"]).'" type="image/jpeg" />';
	} 
	$rss .= '  
	</item>
	';
} 
$rss .= ' 
 </channel>
';
$rss .= '</rss>';

$handle = fopen("rss.xml", "w");

fwrite($handle, $rss);

fclose($handle);