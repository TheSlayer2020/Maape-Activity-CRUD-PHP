<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Home</title>
</head>

<body class="bdy">

    <div class="b1">
        <div class="b2">
            LAB ACTIVITY
        </div>

        <div class="b3">
            <nav class="nav1">
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : ''; ?>" href="?page=home"><i class="fas fa-home"></i> Home</a>
                <a class="<?php echo isset($_GET['page']) && $_GET['page'] == 'contact' ? 'active' : ''; ?>" href="?page=contact"><i class="fas fa-book"></i> Contact</a>
            </nav>
        </div>
    </div>

    <div class="Read">
        Read Contacts
    </div>

    <div class="Create">
        <hr class="hr1">
        <a href="create.php">Create Contact</a>
    </div>

    <div class="Table">

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Title</th>
                <th>Created</th>
                <th></th> <!-- New column for actions -->
                <!-- Add more columns as needed -->
            </tr>
            </thead>
            <tbody>
            <?php
            // Include your database connection file
            include('db_connection.php');

            // Fetch data from the database
            $sql = "SELECT * FROM contacts";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($contact = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $contact['id'] . '</td>';
                    echo '<td>' . $contact['name'] . '</td>';
                    echo '<td>' . $contact['email'] . '</td>';
                    echo '<td>' . $contact['phone'] . '</td>';
                    echo '<td>' . $contact['title'] . '</td>';
                    echo '<td>' . $contact['created'] . '</td>';
                    echo '<td>';
                    echo '<a href="update.php?id=' . $contact['id'] . '"><i class="fas fa-edit"></i></a>';
                    echo '<a href="delete.php?id=' . $contact['id'] . '&redirect=home" onclick="return confirm(\'Are you sure you want to delete this contact?\');"><i class="fas fa-trash-alt"></i></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>

</body>

</html>
