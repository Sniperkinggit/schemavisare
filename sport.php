<!DOCTYPE html>
<?php require_once("asset.php"); 
$_SESSION['admin'] = false; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schemavisare<?=date("Y")?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php    
    $datehour = intval(date("H"));
    $dateminute = intval(date("i"));
    $datesecond = intval(date("s"));
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
    <div class="topbar">
        <h1>Sport</h1>
        
        <?php
        $date = date("Y-m-d");
        $sql = "SELECT * FROM `dagstema` WHERE `begin` = '$date'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>" . $row['tema'] . "</h1>";
        } ?> 
    </div>
    <?php
    $sql = "SELECT * FROM `sport` ORDER BY `begin` ASC";
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
            window.location.href = "index.php";
        }
    });
</script>