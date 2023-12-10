<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $created = mysqli_real_escape_string($conn, $_POST['created']);

    // Your SQL query to insert data into the database
    $sql = "INSERT INTO contacts (name, email, phone, title, created) VALUES ('$name', '$email', '$phone', '$title', '$created')";

   // Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Record saved successfully";
    // Redirect to the home page
    header("Location: http://localhost/Maape%20Crude%20PHP/home.php?page=home");
    exit(); // Ensure that no further code is executed after the redirect
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Create</title>
</head>

<body class="bdy">

    <div class="b1">
        <div class="b2">
            LAB ACTIVITY
        </div>

        <div class="b3">
            <nav class="nav1">
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : ''; ?>" href="home.php?page=home"><i class="fas fa-home"></i> Home</a>
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'contact' ? 'active' : ''; ?>" href="?page=contact"><i class="fas fa-book"></i> Contact</a>
            </nav>
        </div>
    </div>

    <div class="Read">
        Create Contacts
    </div>
    <hr class="hr1">

    <div class="CreateContact">

    <form action="create.php" method="post">
        <div class="form-row">
            <div class="form-column">
                <label for="id">ID</label>
                <input type="text" id="id" name="id" value="auto" disabled>
            </div>

            <div class="form-column">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="" placeholder="Name">
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="" placeholder="Email" required>
            </div>

            <div class="form-column">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="" placeholder="Title">
            </div>

            <div class="form-column">
                <label for="created">Created</label>
                <input type="date" id="created" name="created" value="">
            </div>
        </div>

        <div class="form-btn">
            <button type="submit" class="btnCreate">Create</button>
        </div>
    </form>
    </div>
</body>

</html>
