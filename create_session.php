<?php
include 'db_connect.php';

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $opened_by = mysqli_real_escape_string($conn, $_POST['opened_by']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);



    if (empty($id) || empty($course_id) || empty($group_id) || empty($opened_by) || empty($status) || empty($date)) {
        $message = "Please fill all fields.";
    } else {
        $sql = "INSERT INTO attendance_sessions (id , group_id , date ,opened_by , status, course_id) 
                                         VALUES ('$id', '$group_id', '$date','$opened_by','$status','$course_id')";
        if (mysqli_query($conn, $sql)) {
            //header("Location: attendence.php");
            
            $message = "✅ session regestred succecfully!";
        } else {
            $message = "❌ Error: " . mysqli_error($conn);
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

<!-- Navbar -->
<nav class="nav">
    <img src="img/Group.png" alt="">
    <div class="logo">StudAdd</div>
    <ul class="links">
        <li><a href="home.html">home</a></li>
        <li><a href="attendence.php">Attendance list</a></li>
        <li><a href="add_student.php">add Student</a></li>
        <li><a href="rapport.html">rapport</a></li>
        <li><a href="home.html">logout</a></li>
        <a href="home.html">
            <button>log in</button>
        <button>sign in</button>
        </a>
        
    </ul>
</nav>

<!-- Form -->
<div class="form-container">
    <h1>CREATE SESSION</h1>

    <?php if(isset($message)) echo "<p>$message</p>"; ?>

    <form method="post" action="">
        ID: <input type="text" name="id"><br>
        LE COUR DE: <input type="text" name="course_id"><br>
        Group ID: <input type="text" name="group_id"><br>
        PROFESSOR: <input type="text" name="opened_by"><br>
        STATUS: <input type="text" name="status"><br>

        Date: <input type="date" name="date"><br>
        <input type="submit" value="Add Session">
    </form>

    <br>
   <!-- <a href="list_students.php">View Students</a> | <a href="home.html">Home</a>-->
</div>

<script src="addStud.js"></script>
</body>
</html>
