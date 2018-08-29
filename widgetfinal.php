<?php

$url= "https://www.bitstamp.net/api/ticker/"; 
$content = file_get_contents($url);
$json = json_decode($content, true);  
$price = $json["last"]; 
$high = $json["high"]; 
$low = $json["low"]; 
$dt = date("M d, Y - h:i:sa"); 
$open = $json["open"]; 

if($open < $price){ 
//price increases 
	$sign = "+"; 
	$change = $price - $open; 
	$percent = $change / $open; 
	$percent = $percent *100; 
	$pc = $sign.number_format($percent, 2); 	
	$color = "green"; 	 
} 
else{
//price increases 
	$sign = "+"; 
	$change = $open - $price; 
	$percent = $change / $open; 
	$percent = $percent *100; 
	$pc = $sign.number_format($percent, 2); 	
	$color = "red";

} 

?> 

<!---DOCTYPE html css---> 
<html>
<head>
	<title>bitcoin widget</title> 
	<style>
#container{
	width:360px;
	height: 90px;
	border: 1px solid #000;
	background-color: #4C4D48  ;
	overflow:hidden;
	border-radius: 6px; 
	color: white;
	font-family: "Georgia";
} 
#priceTag{
	font-size: 45px;
}
#timeDate{
	color: #999; 
	font-size: 15px; 
} 
	</style>
</head>
<body>
<!---
container is comprised of 2 columns(60/40 width) and 4 rows 
to show price, %change, high and low prices, and the time and date

data sourced from Bitstamp API ticker (converts to USD) 
returns JSON dict:
last-	Last BTC price.
high-	Last 24 hours price high.
low-	Last 24 hours price low.
vwap-	Last 24 hours volume weighted average price.
volume-	Last 24 hours volume.
bid-	Highest buy order.
ask-	Lowest sell order.
timestamp-	Unix timestamp date and time.
open-	First price of the day.

--->
	<div id="container">
 
	<table width="98%">
	
		<tr>
			<td rowspan='3' width="60%" id="priceTag" style="color: white"><?php echo "$$price"; ?></td>
			<td align="right" style="color: <?php echo $color; ?>;"><?php echo "$pc%"; ?></td> 
		</tr> 
		<tr>
			<td align="right" style="color: white"><?php echo "high: ".number_format($high,2); ?></td>
		</tr> 
		<tr>
			<td align="right" style="color: white"><?php echo "low: ".number_format($low,2); ?></td> 
		</tr>
		<tr>			
			<td  colspan='2' align="right" id="timeDate"><?php echo $dt; ?></td> 
		</tr>
	</table> 
	</div>
</body>
</html> 