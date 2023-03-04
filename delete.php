<?php include 'inc/header.php'; ?>

<?php
$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM clients WHERE id=$id";

    mysqli_query($connection, $sql);
}

header("Location : index.php");

?>

<?php include 'inc/footer.php'; ?>