<?php
if($Consignee == "ATKINS") {
$positionY='5';
$positionX='10';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/ATKINS.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,200,'JPG');
}


if($Consignee == "MEATPLUS") {
//header
$positionY='12';
$positionX='17';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/MEATPLUS.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,39,'JPG');
//footer
$positionY2='248';
$positionX2='35';
$letterhead_image2 = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/MEATPLUS_foot.jpg';
$pdf->image($letterhead_image2,$positionX2,$positionY2,143,'JPG');

}

if($Consignee == "DYNOMACK")   {
$positionY='5';
$positionX='20';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/DYNOMACK.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,183,'JPG');
}
if($Consignee == "DYNOMACK2")   {
$positionY='9';
$positionX='25';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/DYNOMACK.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,163,'JPG');
}

if($Consignee == "LYNDON")   {
$positionY='9';
$positionX='22';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/LYNDON.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,170,'JPG');
}


if($Consignee == "MONEYPOT") {
$positionY='12';
$positionX='65';
$letterhead_image = '/home/wpxgrynlfqu1/public_html/betty/letterhead_images/MONEYPOT.jpg';
$pdf->image($letterhead_image,$positionX,$positionY,85,'JPG');
}



?>
