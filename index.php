<!DOCTYPE html>
<?php require_once("asset.php"); 
$_SESSION['admin'] = false;?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1">
    <title>Schemavisare<?=date("Y")?></title>
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
    $_SESSION['dateday'] = isset($_SESSION['dateday']) ? $_SESSION['dateday'] : null;
    if ($dateday != $_SESSION['dateday']) {
        $_SESSION['dateday'] = $dateday;
        $_SESSION['infocush'] = null;
        $_SESSION['infocusm'] = null;
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
        
        <?php
        $sql = "SELECT * FROM `dagstema` WHERE `begin` = CURDATE()";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>" . $row['tema'] . "</h1>";
        } ?> 
    </div>
    <?php
    $sql = "SELECT * FROM `activiteter` ORDER BY `begin` ASC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $begin = new DateTime($row['begin']);
        $timedate = $begin->format('Y-m-d');
        if ($timedate != date("Y-m-d")) {
            continue;
        }
        $timehour = intval($begin->format('H'));
        $timemin = intval($begin->format('i'));
        $name = $row['name'];
        $info = $row['info'];
    $step += 1; ?>
    <div class=<?php echo donamestep($timehour, $timemin); ?> >
        <h2 class="activity">
            <div class="time"><?php echo $begin->format('H:i'); ?></div> 
            <div class="nameninfo"> 
                <div class="name">
                    <?php echo $name; ?>
                </div>
                <?php if ($info) { ?>
                     <div class="info">
                        <?php echo $info; ?>
                     </div>
                <?php } ?>
            </div>
        </h2>
    </div>
        <?php } ?>
</body>
</html>
<script>
    addEventListener("keydown", function(event) {
        if (event.key === ".") {
            window.location.href = "admin.php";
        }
    });
    addEventListener("keydown", function(event) {
        if (event.key === ",") {
            window.location.href = "sida2.php";
        }
    });
    addEventListener("keydown", function(event) {
        if (event.key === "-") {
            window.location.href = "sport.php";
        }
    });
</script>