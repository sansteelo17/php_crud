<?php include 'inc/header.php'; ?>

<?php
$id = $name = $email = $address = $phone = '';
$nameErr = $emailErr = $phoneErr = $addressErr = '';

//GET METHOD: Show client data

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location : index.php");
    }

    $id = $_GET['id'];

    // read client data
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    $client = mysqli_fetch_assoc($result);

    if (!$client) {
        header("Location : index.php");
    }

    $name = $client['name'];
    $email = $client['email'];
    $phone = $client['phone'];
    $address = $client['address'];
} else {
    // if it is a POST method
    $id = $_POST['id'];

    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['phone'])) {
        $phoneErr = 'Number is required';
    } else {
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST['address'])) {
        $addressErr = 'Address is required';
    } else {
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($nameErr) && empty($emailErr) && empty($phoneErr && empty($addressErr))) {
        $sql = "UPDATE clients " . "SET name = '$name', email = '$email', phone = '$phone', address = '$address' " . "WHERE id = $id";

        if (mysqli_query($connection, $sql)) {
            header("Location : index.php");
        } else {
            var_dump(mysqli_error($connection));
        }
    }
}
?>

<h2 class="text-center mb-5">Edit <?php echo $name ?>'s account</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" name="name" id="name"
                value="<?php echo $name ?>">
        </div>

        <?php if (!empty($nameErr)) : ?>
        <div class="col-sm-6 invalid-feedback">
            <?php echo $nameErr; ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ?>" name="email"
                id="email" value="<?php echo $email ?>">
        </div>

        <?php if (!empty($emailErr)) : ?>
        <div class="col-sm-6 invalid-feedback">
            <?php echo $emailErr; ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="row mb-3">
        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-6">
            <input type="text" class="form-control <?php echo $phoneErr ? 'is-invalid' : null ?>" name="phone"
                id="phone" value="<?php echo $phone ?>">
        </div>

        <?php if (!empty($phoneErr)) : ?>
        <div class="col-sm-6 invalid-feedback">
            <?php echo $phoneErr; ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="row mb-3">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" class="form-control <?php echo $addressErr ? 'is-invalid' : null ?>" name="address"
                id="address" value="<?php echo $address ?>">
        </div>

        <?php if (!empty($addressErr)) : ?>
        <div class="col-sm-6 invalid-feedback">
            <?php echo $addressErr; ?>
        </div>
        <?php endif; ?>

    </div>

    <div class="row mb-3">
        <input type="submit" name="submit" value="Save changes" class="btn btn-success w-50 mt-2 mb-3 mx-auto" />
    </div>
</form>

<a class="btn btn-success" href="/school-management/index.php" role="button">Back to Home</a>




<?php include 'inc/footer.php'; ?>