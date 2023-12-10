<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'contact_id' is set in the POST data
    if (isset($_POST['contact_id'])) {
        $contact_id = mysqli_real_escape_string($conn, $_POST['contact_id']);

        // Your SQL query to delete the contact
        $sql = "DELETE FROM contacts WHERE id = '$contact_id'";
        
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Check if 'redirect' parameter is present and redirect accordingly
            if (isset($_GET['redirect']) && $_GET['redirect'] == 'home') {
                header("Location: home.php?page=home");
                exit();
            } else {
                // Redirect to a default page if 'redirect' is not specified
                header("Location: default_page.php");
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DeleteCSS.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Delete</title>
</head>

<body class="bdy">

    <div class="b1">
        <div class="b2">
            LAB ACTIVITY
        </div>

        <div class="b3">
            <nav class="nav1">
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : ''; ?>"
                    href="home.php?page=home"><i class="fas fa-home"></i> Home</a>
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'contact' ? 'active' : ''; ?>"
                    href="?page=contact"><i class="fas fa-book"></i> Contact</a>
            </nav>
        </div>
    </div>

    <div class="Read">
        Delete Contacts #1
    </div>
    <hr class="hr1">

    <div class="txt1">
        Are you sure you want to delete contact
    </div>

    <body class="bdy">

        <div class="CreateContact">

            <!-- Form for Yes button -->
            <form action="delete.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>&redirect=home" method="post">
                <input type="hidden" name="contact_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <div class="form-btn">
                    <button type="submit" class="btnCreate">Yes</button>
                </div>
            </form>

            <!-- Form for No button -->
            <form action="home.php?page=home" method="get">
                <div class="form-btn">
                    <button type="submit" class="btnCreate">No</button>
                </div>
            </form>
        </div>
    </body>

</html>
