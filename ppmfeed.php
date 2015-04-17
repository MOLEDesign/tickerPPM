<?php

//get the json file
$json = file_get_contents("output.json");

//decode the files into usable form
$jsonIterator = json_decode($json);

//start the count
$thecount = 0;
$continueCount = TRUE;
$currentOperator = '';

$date = date("D, j M Y G:i:s O");

header('Content-type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<rss version=\"2.0\">\n";
echo "<channel>\n";
echo "<lastBuildDate>$date</lastBuildDate>\n";
echo "<pubDate>$date</pubDate>\n";
echo "<title>PPM Feed</title>\n";
echo "<description><![CDATA[[A PPM data chart for UK TOC's]]]></description>\n";
echo "<link>http://selfservice/feeds/rss3.php</link>\n";
echo "<language>English</language>\n";
echo "<managingEditor>morgan.leecy@firstgroup.com</managingEditor>\n";
echo "<webMaster>morgan.leecy@firstgroup.com</webMaster>\n";

do {
	if ($currentOperator = @$jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->name) {
		$currentOperator = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->name;
		$currentcode = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->code;
		$currentTotal = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->Total;
		$currentkeySymbol = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->keySymbol;
		$currentPPMtext = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->PPM->text;
		$currentPPMrag = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->PPM->rag;
		$currentRollingPPMtrendInd = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->RollingPPM->trendInd;
		$currentRollingPPMtext = $jsonIterator->RTPPMDataMsgV1->RTPPMData->NationalPage->Operator[$thecount]->RollingPPM->text;
		
		echo "<item>\n";
		echo "<title>$currentOperator - Current PPM $currentPPMtext (last 2 hours $currentRollingPPMtext)</title>\n";
		echo "</item>\n";

	} else {
		$continueCount = FALSE;
	}
		$thecount ++;
		$currentOperator = '';
} while( $continueCount == TRUE );

echo "</channel>";
echo "</rss>";

?>
