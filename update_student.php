<?php
include 'db_connect.php';

//bring student data to edit
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
}

//update student info
if(isset($_POST['update_student'])) {
    $old_id = $_POST['old_id'];  
    $new_id = $_POST['id'];      
    $name = $_POST['name'];
    $group = $_POST['group'];

    $sql = "UPDATE students SET id='$new_id', name='$name', group_id='$group' WHERE id='$old_id'";
    if(mysqli_query($conn, $sql)) {
        header("Location: attendence.php");
        exit;
    } else {
        echo "Error updating student!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Student infos</title>

<style>

form {
  margin-top: 15px;
  background: #54699A;
  padding: 12px;
  border-radius: 8px;
}
h2 { text-align: center; color: #2c3e50; font-size: 18px; }
label { display: block; margin-top: 8px; font-size: 13px; color: white; }
input[type="text"], input[type="submit"] { width: 100%; padding: 7px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; font-size: 13px; }
input[type="submit"] { background-color: #e3e9f0; color: rgb(6, 5, 5); border: none; border-radius: 5px; cursor: pointer; font-size: 14px; margin-top: 12px; padding: 10px; }
input[type="submit"]:hover { background-color: #3c5e8b; color: white; }
@media (min-width: 1024px) { form { width: 60%; margin: 25px auto; } h2 { font-size: 22px; } }
</style>
</head>
<body>
<h2>Update Students infos</h2>
<form method="post">

<input type="hidden" name="old_id" value="<?= $student['id'] ?>">
    
    <label>ID:</label>
    <input type="text" name="id" value="<?= $student['id'] ?>" required>
    
    <label>Name:</label>
    <input type="text" name="name" value="<?= $student['name'] ?>" required>
    
    <label>Group:</label>
    <input type="text" name="group" value="<?= $student['group_id'] ?>" required>
    
    <input type="submit" name="update_student" value="Update">
</form>
</body>
</html>
