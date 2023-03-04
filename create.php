<?php include 'inc/header.php'; ?>

<?php
$name = $email = $phone = $address = '';
$nameErr = $emailErr = $phoneErr = $addressErr = '';

if (isset($_POST['submit'])) {
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
        $sql = "INSERT INTO clients(name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

        if (mysqli_query($connection, $sql)) {
            header("Location : index.php");
        } else {
            echo mysqli_error($connection);
        }
    }
}
?>

<h2 class="text-center mb-5">Add new student</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" name="name" id="name"
                placeholder="Enter your name">
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
                id="email" placeholder="Enter your email">
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
                id="phone" placeholder="Enter your phone number">
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
                id="address" placeholder="Enter your address">
        </div>

        <?php if (!empty($addressErr)) : ?>
        <div class="col-sm-6 invalid-feedback">
            <?php echo $addressErr; ?>
        </div>
        <?php endif; ?>

    </div>

    <div class="row mb-3">
        <input type="submit" name="submit" value="Create new student" class="btn btn-primary w-50 mt-2 mb-3 mx-auto" />
    </div>
</form>

<a class="btn btn-primary" href="/school-management/index.php" role="button">Back to Home</a>


<?php include 'inc/footer.php'; ?>