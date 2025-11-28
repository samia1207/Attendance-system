<?php
include 'db_connect.php';

// handle add student form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $group = mysqli_real_escape_string($conn, $_POST['group']);

    if (!empty($id) && !empty($name)  && !empty($group)) {
        $sql = "INSERT INTO students (id, name, group_id) VALUES ('$id', '$name', '$group')";
        mysqli_query($conn, $sql);
    }
}

// fetch all students for table
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance</title>
<link rel="stylesheet" href="attendence.css">
<link rel="stylesheet" href="home.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
<nav class="nav">
<img src="img/Group.png" alt="">
<div class="logo">StudAdd</div>
<ul class="links">
<li><a href="home.html">Home</a></li>
<li><a href="attendence.php">Attendance list</a></li>
<li><a href="add_student.php">Add Student</a></li>
<li><a href="rapport.html">Rapport</a></li>
<li><a href="home.html">Logout</a></li>
</ul>
</nav>

<!-- exo 6 -->
<button id="highlightExcellent" class="extra-btn">Highlight Excellent Students</button>
<button id="resetColors" class="extra-btn">Reset Colors</button>

<br><br>

<!-- exo 7 -->
<input type="text" id="searchName" placeholder="Search by Name" />

<button id="sortAbsences" class="extra-btn">Sort by Absences (Ascending)</button>
<button id="sortParticipation" class="extra-btn">Sort by Participation (Descending)</button>


<h1>Attendance Table</h1>
<div class="table-container">
<table id="attendanceTable">
    <thead>
        <tr>
            <th rowspan="2">Student ID</th>
            
            <th rowspan="2">First Name</th>
            <th colspan="2">Session 1</th>
            <th colspan="2">Session 2</th>
            <th colspan="2">Session 3</th>
            <th colspan="2">Session 4</th>
            <th colspan="2">Session 5</th>
            <th colspan="2">Session 6</th>
            <th rowspan="2">Update</th>
            <th rowspan="2">Delete</th>
            <th rowspan="2">Absences</th>




        </tr>
        <tr>
            <th>Present</th><th>Participated</th>
            <th>Present</th><th>Participated</th>
            <th>Present</th><th>Participated</th>
            <th>Present</th><th>Participated</th>
            <th>Present</th><th>Participated</th>
            <th>Present</th><th>Participated</th>
        </tr>
    </thead>
    <tbody>
<?php while($student = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $student['id']; ?></td>
    <td><?= $student['name']; ?></td>

    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>

    <!-- update -->
<td>
    <a href="update_student.php?id=<?= $student['id']; ?>">✏</a>
</td>

<!-- delete -->
<td>
    <a href="delete_student.php?id=<?= $student['id']; ?>"
       onclick="return confirm('Are you sure?')">
       ❌
    </a>
</td>

<!-- absences -->
<td class="center">0</td>

</tr>
<?php endwhile; ?>
</tbody>

</table>
</div>

<script src="attendence.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
