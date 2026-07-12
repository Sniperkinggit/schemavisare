<!DOCTYPE html>
<?php require_once("asset.php");
if (isset($_POST['password'])) {
    if (md5($_POST['password']) === "b3b4d2dbedc99fe843fd3dedb02f086f") {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    }
}
if (isset($_POST['logout'])) {
    $_SESSION['admin'] = false;
    header("Location: admin.php");
    exit();
}
if (isset($_POST['sort'])) {
    $sort_date = $_POST['sort_date'];
    header("Location: admin.php?sort_date=" . $sort_date);
    exit();
}
if (isset($_GET['sort_date'])) {
    $sort_date = $_GET['sort_date'];
    $ownlink = "admin.php?sort_date=" . $sort_date;
    $issort = true;
}else{
    $ownlink = "admin.php";
    $issort = false;
}

if (isset($_SESSION['admin']) || $_SESSION['admin'] == true){

if(isset($_POST['shift'])){
    $shift_date = date("Y-m-d", strtotime($_POST['shift_date']));
    $shift_time = date("H:i", strtotime($_POST['shift_time']));
    $shift_amount = date("H:i", strtotime($_POST['shift_amount']));
    $sql = "UPDATE activiteter SET begin = DATE_ADD(begin, INTERVAL '$shift_amount' HOUR_MINUTE) WHERE DATE(begin) = '$shift_date' AND TIME(begin) >= '$shift_time'";
    mysqli_query($conn, $sql);
    header("Location: " . $ownlink);
    exit();

}
if(isset($_POST['shift_back'])){
    $shift_date = date("Y-m-d", strtotime($_POST['shift_date']));
    $shift_time = date("H:i", strtotime($_POST['shift_time']));
    $shift_amount = date("H:i", strtotime($_POST['shift_amount']));
    $sql = "UPDATE activiteter SET begin = DATE_SUB(begin, INTERVAL '$shift_amount' HOUR_MINUTE) WHERE DATE(begin) = '$shift_date' AND TIME(begin) >= '$shift_time'";
    mysqli_query($conn, $sql);
    header("Location: " . $ownlink);
    exit();
}

if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $sql = "DELETE FROM activiteter WHERE id='$delete_id'";
    mysqli_query($conn, $sql);
    header("Location: " . $ownlink);
    exit();
}
if (isset($_POST['edit_id'])) {
    $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $sql = "SELECT * FROM activiteter WHERE id='$edit_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $begin = date("Y-m-d\TH:i", strtotime($row['begin']));
    $info = $row['info'];
    ?>
    <h1>Redigera aktivitet</h1>
    <form action="<?php echo $ownlink; ?>" method="post">
        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <input type="text" name="name" placeholder="Namn" value="<?php echo $name; ?>" required><br>
        <input type="datetime-local" name="begin" value="<?php echo $begin; ?>" required><br>
        <input type="text" name="info" placeholder="Info" value="<?php echo $info; ?>"><br>
        <input type="submit" value="Spara ändringar">
    </form>
    <?php
    if (isset($_POST['name']) && isset($_POST['begin']) && isset($_POST['edit_id'])) {
        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        $begin = mysqli_real_escape_string($conn, $_POST['begin']);
        $info = mysqli_real_escape_string($conn, htmlspecialchars($_POST['info']));
        $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
        $sql = "UPDATE activiteter SET name='$name', begin='$begin', info='$info' WHERE id='$edit_id'";
        mysqli_query($conn, $sql);
        header("Location: " . $ownlink);
        exit();
    }
}
if (isset($_POST['daytheme']) && isset($_POST['daytheme_date'])) {
    $daytheme = mysqli_real_escape_string($conn, htmlspecialchars($_POST['daytheme']));
    $daytheme_date = mysqli_real_escape_string($conn, $_POST['daytheme_date']);
    $sql = "INSERT INTO dagstema (begin, tema) VALUES ('$daytheme_date', '$daytheme')";
    mysqli_query($conn, $sql);
    header("Location: " . $ownlink);
    exit();
}
if (isset($_POST['delete_theme'])) {
    $delete_theme_id = mysqli_real_escape_string($conn, $_POST['delete_theme_id']);
    $sql = "DELETE FROM dagstema WHERE id='$delete_theme_id'";
    mysqli_query($conn, $sql);
    header("Location: " . $ownlink);
    exit();
}
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schemavisare admin <?=date("Y")?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {?>
        <h1>Admin login</h1>
        <form action="admin.php" method="post">
            <input type="password" name="password" placeholder="Lösenord" required><br>
            <input type="submit" value="Logga in">
        </form>
        <form action="index.php" method="post">
        <input type="submit" value="tillbaka till Schemat">
    </form>
    <?php }else{?>
    <h1>Admin</h1>
    <form action="<?php echo $ownlink; ?>" method="post">
        <input type="submit" name="logout" value="Logga ut">
    </form>
    <form action="index.php" method="post">
        <input type="submit" value="tillbaka till Schemat">
    </form>
    <form action="sida2.php" method="post">
        <input type="submit" value="till datumsschemavisare">
    </form>
    <form action="sport.php" method="post">
        <input type="submit" value="till sportsschemavisare">
    </form>
    <form action="<?php echo $ownlink; ?>" method="post">
        <input type="text" name="name" placeholder="Namn" required><br>
        <input type="datetime-local" name="begin" required><br>
        <input type="text" name="info" placeholder="Info"><br>
        <input type="submit" value="Lägg till">
    </form>
    <?php
    if (isset($_POST['name']) && isset($_POST['begin'])) {
        $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
        $begin = mysqli_real_escape_string($conn, $_POST['begin']);
        $info = mysqli_real_escape_string($conn, htmlspecialchars($_POST['info']));
        $sql = "INSERT INTO activiteter (name, begin, info) VALUES ('$name', '$begin', '$info')";
        mysqli_query($conn, $sql);
        header("Location:" . $ownlink);
        exit();
    }?>
    <h2>Dagstema</h2>
    <div class="line"></div>
    <form action="admin.php" method="post">
        <input type="text" name="daytheme" placeholder="Dagstema" required><br>
        <input type="date" name="daytheme_date" required><br>
        <input type="submit" value="Spara">
    </form>
        <div class="dropdown-content">
            <?php
            $sql = "SELECT * FROM dagstema ORDER BY begin DESC";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) { ?>
                <p> <?php echo $row['begin'] ?> -  <?php echo $row['tema'] ?> </p>
                <form action="admin.php" method="post">
                    <input type="hidden" name="delete_theme_id" value="<?php echo $row['id'] ?>">
                    <input type="submit" name="delete_theme" value="Ta bort">
                </form>
            <?php
            } ?>
        </div>
    <div class="line"></div>
    <h2>Aktiviteter <?php if (isset($sort_date)) { echo " Sorterade efter " . $sort_date; } ?></h2>
    <form action="admin.php" method="post" class="shift-form">
        <h3>Förskjut aktiviteter</h3>
        <p>datum och tid:</p>
        <input type="date" name="shift_date" required>
        <input type="time" name="shift_time" required> <br>
        <p>förskjutning:</p>
        <input type="time" name="shift_amount" required value="00:00">  <br>
        <input type="submit" name="shift" value="Förskjut framåt">
        <input type="submit" name="shift_back" value="Förskjut bakåt">
    </form>
    <?php if ($issort == false){ ?>
    <form action="admin.php" method="post">
        <input type="date" name="sort_date" required>
        <input type="submit" name="sort" value="Sortera efter datum">
    </form>
    <?php }else{ ?>
    <form action="admin.php" method="post">
        <input type="submit" name="ojsort" value="Sortera ej efter datum">
    </form>
    <?php }
    echo "<div class='line'></div>";
    if ($issort == true) {
        $sql = "SELECT * FROM activiteter WHERE DATE(begin) = '$sort_date' ORDER BY begin ASC";
    } else {
    $sql = "SELECT * FROM activiteter ORDER BY begin ASC";
    }
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<p>" . $row['name'] . " - " . $row['begin'] . " - " . $row['info'] . "</p>";
        echo "<form action=" . $ownlink . " method='post'><input type='hidden' name='delete_id' value='" . $row['id'] . "'><input type='submit' value='Ta bort'></form>";
        echo "<form action=" . $ownlink . " method='post'><input type='hidden' name='edit_id' value='" . $row['id'] . "'><input type='submit' value='Redigera'></form>";
        echo "<div class='line'></div>";
    }
    }?>
</body>
</html>