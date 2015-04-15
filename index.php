<?php


$timeStamp=file_get_contents("http://52.16.172.160:3000/ppm/timestamp");
$nationalData=file_get_contents("http://52.16.172.160:3000/ppm/national/summary");


$timeStamp=json_decode($timeStamp);
$nationalData=json_decode($nationalData);

$date = date("D, j M Y G:i:s O");

header('Content-type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<rss version=\"2.0\">\n";
echo "<channel>\n";
echo "<lastBuildDate>$date</lastBuildDate>\n";
echo "<pubDate>$date</pubDate>\n";
echo "<title>National PPM</title>\n";
echo "<description><![CDATA[[National UK PPM Summary]]]></description>\n";
echo "<link>http://apps.gwtrains.co.uk/uksummary</link>\n";
echo "<language>English</language>\n";
echo "<managingEditor>morgan.leecy@firstgroup.com</managingEditor>\n";
echo "<webMaster>morgan.leecy@firstgroup.com</webMaster>\n";

$currentPPMtext = $nationalData->NationalPPM->PPM->text;
$currentRollingPPMtext = $nationalData->NationalPPM->RollingPPM->text;

echo "<item>\n";
echo "<title>National - Current PPM $currentPPMtext (last 2 hours $currentRollingPPMtext)</title>\n";
echo "</item>\n";

echo "</channel>";
echo "</rss>";