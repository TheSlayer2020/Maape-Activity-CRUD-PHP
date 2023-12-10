<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $contact_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM contacts WHERE id = '$contact_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $contact = mysqli_fetch_assoc($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $created = mysqli_real_escape_string($conn, $_POST['created']);

            $updateSql = "UPDATE contacts SET name = '$name', email = '$email', phone = '$phone', title = '$title', created = '$created' WHERE id = '$contact_id'";

            if (mysqli_query($conn, $updateSql)) {
                // Redirect to home.php after successful update
                header("Location: home.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        $success = isset($_GET['success']) && $_GET['success'] == 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Update</title>
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
        Update Contacts #1
    </div>
    <hr class="hr1">

    <div class="CreateContact">
        <form action="update.php?id=<?php echo $contact_id; ?>" method="post">
            <div class="form-row">
                <div class="form-column">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id" value="<?php echo $contact['id']; ?>" disabled>
                </div>
                <div class="form-column">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $contact['name']; ?>" placeholder="Jenalyn">
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $contact['email']; ?>" placeholder="Jenalyn@gmail.com" required>
                </div>
                <div class="form-column">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $contact['phone']; ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo $contact['title']; ?>" placeholder="Employee">
                </div>
                <div class="form-column">
                    <label for="created">Created</label>
                    <input type="date" id="created" name="created" value="<?php echo $contact['created']; ?>">
                </div>
            </div>

            <div class="form-btn">
                <button type="submit" class="btnCreate">Update</button>
            </div>
        </form>
    </div>

</body>

</html>
<?php
    } else {
        echo "Contact not found";
    }
} else {
    echo "Contact ID not provided";
}
?>
