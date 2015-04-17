<?php

$nationalData=file_get_contents("national.json");
$fgwData=file_get_contents("fgw.json");

$national=json_decode($nationalData);
$fgw=json_decode($fgwData);

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


$currentPPM = $national->PPM->text;
$rollingPPM = $national->RollingPPM->text;
$totalTrains = $national->Total;
$totalOnTime = $national->OnTime;
$totalLate = $national->Late;
$totalCancel = $national->CancelVeryLate;

$description = "Total Trains : $totalTrains<br />Trains : $totalOnTime<br />Late : $totalLate<br/>Cancel / Very Late : $totalCancel";

echo "<item>\n";
echo "<title>National PPM - Current $currentPPM% (last 2 hours $rollingPPM%)</title>\n";
echo "<description>".htmlspecialchars($description)."</description>\n";
echo "</item>\n";

$FGWPPM = $fgw->PPM->text;
$FGWrollingPPM = $fgw->RollingPPM->text;
$FGWtotalTrains = $fgw->Total;
$FGWtotalOnTime = $fgw->OnTime;
$FGWtotalLate = $fgw->Late;
$FGWtotalCancel = $fgw->CancelVeryLate;

$FGWdescription = "Total Trains : $FGWtotalTrains<br />Trains : $FGWtotalOnTime<br />Late : $FGWtotalLate<br/>Cancel / Very Late : $FGWtotalCancel";

echo "<item>\n";
echo "<title>FGW PPM - Current $FGWPPM% (last 2 hours $FGWrollingPPM%)</title>\n";
echo "<description>".htmlspecialchars($FGWdescription)."</description>\n";
echo "</item>\n";

echo "</channel>";
echo "</rss>";


