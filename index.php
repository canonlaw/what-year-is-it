<?php
require_once 'app.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=400, initial-scale=1">
<title>WhatYear.is/it/</title>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZRBMZ21RZV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZRBMZ21RZV');
</script>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="notyear"><?php
		//do we need to subtract a year to get last liturgical year
		if(newLiturgicalYearAD(date("Y"), date("m"), date("d")))
		{
			echo getLiturgicalYearNumbers(date("Y"), date("6"), date("1"));
		} else {
			echo getLiturgicalYearNumbers(date("Y")-1, date("6"), date("1"));
		}
	?></div><br />
	<div class="notyearinfo">ended on<br /><?php
		//do we need to subtract a year to get last liturgical year
		if(newLiturgicalYearAD(date("Y"), date("m"), date("d")))
		{
			echo date('F j, Y', strtotime('-1 day', strtotime(getFirstSundayOfAdvent(date("Y")))));
		} else {
			echo date('F j, Y', strtotime('-1 day', strtotime(getFirstSundayOfAdvent(date("Y")-1))));
		}
	?></div><br /><br /><br />


	<div class="year"><?php echo getLiturgicalYearNumbers(date("Y"), date("m"), date("d")); ?></div><br />
	<div class="yearinfo">started on<br /><?php
		//do we need to subtract a year to get last liturgical year
		if(newLiturgicalYearAD(date("Y"), date("m"), date("d")))
		{
			echo getFirstSundayOfAdvent(date("Y"));
		} else {
			echo getFirstSundayOfAdvent(date("Y")-1);
		}
	?></div><br /><br /><br />

	<div class="notyear"><?php
		//do we need to add a year to get last liturgical year
		if(newLiturgicalYearAD(date("Y"), date("m"), date("d")))
		{
			echo getLiturgicalYearNumbers(date("Y")+2, date("6"), date("1"));
		} else {
			echo getLiturgicalYearNumbers(date("Y")+1, date("6"), date("1"));
		}
	?></div><br />
	<div class="notyearinfo">will start on<br /><?php
		//do we need to subtract a year to get last liturgical year
		if(newLiturgicalYearAD(date("Y"), date("m"), date("d")))
		{
			echo getFirstSundayOfAdvent(date("Y")+1);
		} else {
			echo getFirstSundayOfAdvent(date("Y"));
		}
	?></div><br />

</body>
</html>
<!-- site by Rev. Paul Hedman, paulhedman.com -->
