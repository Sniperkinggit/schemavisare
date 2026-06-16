<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1">
    <title>Chemavisare<?=date("Y")?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $weekday = date("l");
    if ($weekday == "Monday") {
        $dateday = "Måndag";
    } elseif ($weekday == "Tuesday") {
        $dateday = "Tisdag";
    } elseif ($weekday == "Wednesday") {
        $dateday = "Onsdag";
    } elseif ($weekday == "Thursday") {
        $dateday = "Torsdag";
    } elseif ($weekday == "Friday") {
        $dateday = "Fredag";
    } elseif ($weekday == "Saturday") {
        $dateday = "Lördag";
    } elseif ($weekday == "Sunday") {
        $dateday = "Söndag";
    }
    $datehour = intval(date("H"));
    $dateminute = intval(date("i"));
    $datesecond = intval(date("s"));
    function getpositionforitemswithdate($datehourf, $dateminutef, $datesecondf) {
        $secondsSinceMidnight = $datehourf * 3600 + $dateminutef * 60 + $datesecondf;
        $fixedtime = ($secondsSinceMidnight / 86400) * 100;
        return number_format($fixedtime,4);
    }
    
    ?>
    <div class="topbar">
        <h1><?php echo $dateday . ' ' . sprintf('%02d:%02d:%02d', $datehour, $dateminute, $datesecond); ?></h1>
    </div>
    <div class="line" style="margin-top:<?php echo getpositionforitemswithdate($datehour, $dateminute, $datesecond); ?>%;"></div>
    <div class="objekteven" style="margin-top:<?php echo getpositionforitemswithdate(8, 30, 00); ?>%;">
        <h1>
            test for stuff<br>
            08:30 Stockholm C
        </h1>
    </div>
    <div class="objektodd" style="margin-top:<?php echo getpositionforitemswithdate(9, 15, 00); ?>%;">
        <h1>
            test for stuff<br>
            09:15 Stockholm C
        </h1>
    </div>
    <div class="objektfocus" style="margin-top:<?php echo getpositionforitemswithdate(10, 0, 0); ?>%;">
        <h1>
            test for stuff Aktiv nu<br>
            10:00 Stockholm C
        </h1>
    </div>
</body>
</html>
