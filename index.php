<!DOCTYPE html>
<?php require_once("asset.php"); 
$_SESSION['admin'] = false;
if (isset($_POST['date'])) {
    $selectedDate = $_POST['date'];
} else {
    $selectedDate = date("Y-m-d");
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
        <form method="POST" action="index.php">
            <input type="date" name="date" value="<?=date("Y-m-d", strtotime($selectedDate))?>">
            <input type="submit" value="visa">
            <a href="admin.php" class="viewlink">Admin</a>
            <a href="sida2.php" class="viewlink">schemavisare</a>
        </form>
    </div>
    <div class="topbar">
        <h1><?php echo $dateday; ?></h1>
        
        <?php
        $sql = "SELECT * FROM `dagstema` WHERE `begin` = '$selectedDate'";
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
