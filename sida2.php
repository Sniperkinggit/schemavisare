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
    session_start();
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
    $step = -1;
    $_SESSION['infocush'] = isset($_SESSION['infocush']) ? $_SESSION['infocush'] : null;
    $_SESSION['infocusm'] = isset($_SESSION['infocusm']) ? $_SESSION['infocusm'] : null;
    function donamestep($h, $m) {
        global $step;
        global $_SESSION;
        global $infocush;
        global $infocusm;
        global $datehour;
        global $dateminute;
        if ($h == $datehour && $m == $dateminute) {
            $_SESSION['infocush'] = $h;
            $_SESSION['infocusm'] = $m;
        }
        if ($h == $_SESSION['infocush'] && $m == $_SESSION['infocusm']) {
            return "objektfocus2";
        } elseif ($step % 2 == 0) {
            return "objekteven2";
        } else {
            return "objektodd2";
        }
    }
    function isfocus($h, $m) {
        if(donamestep($h, $m) == "objektfocus2") { return "Aktiv nu"; } 
    }
    ?>
    <div class="topbar">
        <h1><?php echo $dateday . ' ' . sprintf('%02d:%02d:%02d', $datehour, $dateminute, $datesecond); ?></h1>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(13,23); ?>>
        <h2>
            test for stuff <?php echo isfocus(13,23); ?><br>
            13:23 Stockholm C
        </h2>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(15,0); ?>>
        <h2>
            test for stuff <?php echo isfocus(15,0); ?><br>
            15:00 Stockholm C
        </h2>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(15,1); ?>>
        <h2>
            test for stuff <?php echo isfocus(15,1); ?><br>
            15:01 Stockholm C
        </h2>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(16,1); ?>>
        <h2 >
            test for stuff <?php echo isfocus(16,1); ?><br>
            16:01 Stockholm C
        </h2>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(17,1); ?>>
        <h2 >
            test for stuff <?php echo isfocus(17,1); ?><br>
            17:01 Stockholm C
        </h2>
    </div>
    <?php $step += 1; ?>
    <div class=<?php echo donamestep(18,1); ?>>
        <h2 >
            test for stuff <?php echo isfocus(18,1); ?><br>
            18:01 Stockholm C
        </h2>
    </div>
</body>
</html>