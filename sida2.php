<!DOCTYPE html>
<?php require_once("asset.php"); 
$_SESSION['admin'] = false;
if (isset($_POST['date'])) {
    $selectedDate = $_POST['date'];
    if (isset($_POST["sportchema"])) {
        $sport=1;
    } else {
        $sport=0;
    }
} else {
    $selectedDate = date("Y-m-d");
    $sport=0;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schemavisare<?=date("Y", strtotime($selectedDate))?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    $weekday = date("l", strtotime($selectedDate));
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
    
    $datehour = intval(date("H", strtotime($selectedDate)));
    $dateminute = intval(date("i", strtotime($selectedDate)));
    $datesecond = intval(date("s", strtotime($selectedDate)));
    $step = -1;
    
    function donamestep($h, $m) {
        global $step;
        global $datehour;
        global $dateminute;
        if ($step % 2 == 0) {
            return "objekteven2";
        } else {
            return "objektodd2";
        }
    }
    ?>
    <div class="higherbar">
        <form method="POST" action="sida2.php">
            <input type="date" name="date" value="<?=date("Y-m-d", strtotime($selectedDate))?>">
            <label for="sportchema">Sportchema:</label>
            <input type="checkbox" name="sportchema" value="1" <?php if($sport==1) echo "checked"; ?>>
            <input type="submit" value="visa">
            <a href="admin.php" class="viewlink">Admin</a>
            <a href="index.php" class="viewlink">schemavisare</a>
            <a href="sport.php" class="viewlink">Sport</a>
        </form>
    </div>
    <div class="topbar">
        <h1><?php if($sport==0) { echo $dateday; } else { echo "Sport"; } ?></h1>
        
        <?php
        $sql = "SELECT * FROM `dagstema` WHERE `begin` = '$selectedDate'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>" . $row['tema'] . "</h1>";
        } ?> 
    </div>
    <?php
    if ($sport == 0) {
        $sql = "SELECT * FROM `activiteter` ORDER BY `begin` ASC";
    } else {
        $sql = "SELECT * FROM `sport` ORDER BY `begin` ASC";
    }
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $begin = new DateTime($row['begin']);
        $timedate = $begin->format('Y-m-d');
        if ($timedate != date("Y-m-d", strtotime($selectedDate))) {
            continue;
        }
        $timehour = intval($begin->format('H'));
        $timemin = intval($begin->format('i'));
        $name = $row['name'];
        $info = $row['info'];
    $step += 1; ?>
    <div class=<?php echo donamestep($timehour, $timemin); ?> >
        <h2 class="activity">
            <?php if ($sport == 0) { ?>
                <div class="time"><?php echo $begin->format('H:i'); ?></div>
            <?php } ?>
            <div class="nameninfo"> 
                <?php if ($sport == 1) { ?>
                    <div class="name">
                        <?php echo $name; ?>
                    </div>
                <?php } else { ?>
                    <h1>
                        <?php echo $name; ?>
                    </h1>
                <?php } ?>
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
