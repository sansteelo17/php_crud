<?php include 'inc/header.php'; ?>

<?php
$sql = "SELECT * FROM clients";
$result = mysqli_query($connection, $sql);
$clients = mysqli_fetch_all($result,  MYSQLI_ASSOC);
?>

<h2>List of Students</h2>
<a class="btn btn-primary" href="/school-management/create.php" role="button">New Student</a>
<br>
<?php if (empty($clients)) : ?>

<p class='lead mt-5 text-center'>There are no students available.</p>

<?php endif; ?>

<?php if (!empty($clients)) : ?>
<table class="table">
    <thead>
        <tr>
            <th>
                NO.
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Phone
            </th>
            <th>
                Address
            </th>
            <th>
                Created at
            </th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($clients as $client) : ?>

        <tr>
            <td>
                <?php echo $client['id']; ?>
            </td>
            <td>
                <?php echo $client['name']; ?>
            </td>
            <td>
                <?php echo $client['email']; ?>
            </td>
            <td>
                <?php echo $client['phone']; ?>
            </td>
            <td>
                <?php echo $client['address']; ?>
            </td>
            <td>
                <?php echo $client['created_at']; ?>
            </td>
            <td>
                <a class="btn btn-primary btn-sm"
                    href="/school-management/edit.php?id=<?php echo $client['id']; ?>">Edit</a>
                <a class="btn btn-danger btn-sm"
                    href="/school-management/delete.php?id=<?php echo $client['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<?php include 'inc/footer.php'; ?>