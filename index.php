<?php
date_default_timezone_set('UTC');

function getFirstSundayOfAdvent($year)
{
	$christmasDay = strtotime("December 25, $year");
	$firstSunday = strtotime("-4 weeks sunday", $christmasDay);
	return date("F j, Y",$firstSunday);
}

function newLiturgicalYearAD($year, $month, $day)
{
	//are we before the earliest first sunday of advent? if so, return current $year
	if(strtotime("$month/$day/$year") < strtotime("11/27/$year"))
		return false;

	//are we after the latest first sunday of advent? if so, return next year
	if(strtotime("$month/$day/$year") > strtotime("12/3/$year"))
		return true;

	// we're between the two, figure it out!
	$adventSunday = getFirstSundayOfAdvent($year);
	if(strtotime($adventSunday) <= strtotime("$month/$day/$year"))
		return true;
	else
		return false;
}

function getLiturgicalYearNumbers($year, $month, $day)
{
	$newLitYear = newLiturgicalYearAD($year, $month, $day);
	if($newLitYear)
		$litYear = ++$year;
	else
		$litYear = $year;

	// odd years are year one, even years are year two
	if ($litYear % 2)
		$daily = "1";
	else
		$daily = "2";

	//If the sum of the digits of the year are
	// divisible by three, it's year C
	$yearMod = array_sum(str_split($litYear));
	if ($yearMod % 3 == 0) {
		$weekend = "C";
	} elseif (($yearMod+1) % 3 == 0) {
		//if not, add a year and see it next year is year C
		//if it is, it's year B
		$weekend = "B";
	} elseif (($yearMod-1) % 3 == 0) {
		//if not, subtract a year and see it last year was year C
		//if it was, it's year A
		$weekend = "A";
	}

	return "$weekend.$daily";
}


 ?><!DOCTYPE html>
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
