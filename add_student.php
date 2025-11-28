<?php
include 'db_connect.php';

//
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $group = mysqli_real_escape_string($conn, $_POST['group']);

    if (empty($id) || empty($name) || empty($group)) {
        $message = "Please fill all fields.";
    } else {
        try {
            $sql = "INSERT INTO students (id, name, group_id) VALUES ('$id', '$name', '$group')";
            mysqli_query($conn, $sql);
            $message = "✅ Student added successfully!";
            header("Refresh:1; url=attendence.php"); // redirect after 1s

        } catch (mysqli_sql_exception $e) {
            //if duplicate entry error
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $message = "❌ This Student ID already exists!";
            } else {
                $message = "❌ Error: " . $e->getMessage();
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>
<link rel="stylesheet" href="addStud.css">
<link rel="stylesheet" href="home.css">
</head>
<body>

<!-- navbar -->
<nav class="nav">
    <img src="img/Group.png" alt="">
    <div class="logo">StudAdd</div>
    <ul class="links">
        <li><a href="home.html">home</a></li>
        <li><a href="attendence.php">Attendance list</a></li>
        <li><a href="add_student.php">add Student</a></li>
        <li><a href="rapport.html">rapport</a></li>
        <li><a href="home.html">logout</a></li>
        <button>log in</button>
        <button>sign in</button>
    </ul>
</nav>

<!-- form -->
<div class="form-container">
    <h1>Add Student</h1>

    <?php if(isset($message)) echo "<p>$message</p>"; ?>

    <form method="post" action="">
        ID: <input type="text" name="id"><br>
        Name: <input type="text" name="name"><br>
        Group ID: <input type="text" name="group"><br>
        <input type="submit" value="Add Student">
    </form>

    <br>
    <a href="list_students.php">View Students</a> | <a href="home.html">Home</a>
</div>

<script src="addStud.js"></script>
</body>
</html>
