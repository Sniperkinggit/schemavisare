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
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $begin = mysqli_real_escape_string($conn, $_POST['begin']);
        $info = mysqli_real_escape_string($conn, $_POST['info']);
        $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
        $sql = "UPDATE activiteter SET name='$name', begin='$begin', info='$info' WHERE id='$edit_id'";
        mysqli_query($conn, $sql);
        header("Location: " . $ownlink);
        exit();
    }
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
    <form action="<?php echo $ownlink; ?>" method="post">
        <input type="text" name="name" placeholder="Namn" required><br>
        <input type="datetime-local" name="begin" required><br>
        <input type="text" name="info" placeholder="Info"><br>
        <input type="submit" value="Lägg till">
    </form>
    <?php
    if (isset($_POST['name']) && isset($_POST['begin'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $begin = mysqli_real_escape_string($conn, $_POST['begin']);
        $info = mysqli_real_escape_string($conn, $_POST['info']);
        $sql = "INSERT INTO activiteter (name, begin, info) VALUES ('$name', '$begin', '$info')";
        mysqli_query($conn, $sql);
        header("Location:" . $ownlink);
        exit();
    }?>
    <h2>Aktiviteter <?php if (isset($sort_date)) { echo " Sorterade efter " . $sort_date; } ?></h2>
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
    } }?>
</body>
</html>