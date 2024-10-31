<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit();
}

include 'db_connection.php';

// Fetch registrations with 'Pending' status
$query = "SELECT * FROM registrations WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);

$gallery = mysqli_query($conn, "SELECT * FROM gallery");
$important_dates = mysqli_query($conn, "SELECT * FROM important_dates");
$sponsors = mysqli_query($conn, "SELECT * FROM sponsors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
    <title>Admin Dashboard</title>
    <style>
        html {
            height: 100%;
            background-color: linear-gradient(#8e44ad, #3498db );
        }

        header {
            text-align: center;
            padding: 20px 0;
            color: white;
            position: relative;
            z-index: 1;
        }

        header h1 {
            font-family: "Open Sans", sans-serif;
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        nav {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px 0;
            position: relative;
            z-index: 1;
        }

        nav ul {
            
            text-align: center;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 25%, rgba(255, 255, 255, 0.2) 75%, rgba(255, 255, 255, 0) 100%);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            transition: background 0.5s ease;
        }

        nav ul li {
            display: inline-block;
           
        }

        nav ul li a {
            padding: 18px;
            font-family: "Open Sans", sans-serif;
            text-transform: uppercase;
            color: white;
            font-size: 18px;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease, background 0.3s ease;
        }

        nav ul li a:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.1);
            color: rgba(0, 35, 122, 0.7);
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="logout.php">Logout</a></li> <!-- Logout button -->
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Registrations</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <form action="approve_registration.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="approve">Approve</button>
                                <button type="submit" name="action" value="decline">Decline</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Manage Gallery</h2>
<form action="manage_gallery.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="media_file" accept="image/*,video/*" required>
    <input type="text" name="description" placeholder="Description" required>
    <button type="submit">Add Media</button>
</form>
<ul>
    <?php while ($row = mysqli_fetch_assoc($gallery)) : ?>
        
            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['description']); ?>" width="100">
            <form action="delete_gallery.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Delete</button>
            </form>
      
    <?php endwhile; ?>
</ul>

        <h2>Manage Important Dates</h2>
        <form action="manage_dates.php" method="POST">
            <input type="text" name="event_name" placeholder="Event Name" required>
            <input type="date" name="event_date" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit">Add Date</button>
        </form>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($important_dates)) : ?>
                <li>
                    <?php echo htmlspecialchars($row['event_name']); ?> - <?php echo htmlspecialchars($row['event_date']); ?>
                    <form action="delete_date.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>

        <h2>Manage Sponsors</h2>
<form action="manage_sponsors.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Sponsor Name" required>
    <input type="url" name="website_url" placeholder="Website URL" required>
    <input type="file" name="logo_file" accept="image/*" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Sponsor</button>
</form>

<ul>
    <?php while ($row = mysqli_fetch_assoc($sponsors)) : ?>
        
            <img src="<?php echo htmlspecialchars($row['logo_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="100">
            
                <?php echo htmlspecialchars($row['name']); ?>
           
            <form action="delete_sponsor.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Delete</button>
            </form>
        
    <?php endwhile; ?>
</ul>
    
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>