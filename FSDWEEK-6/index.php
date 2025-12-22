<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        form input {
            width: 95%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
        }
        form button:hover {
            background: #218838;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background: #007bff;
            color: white;
        }
        a {
            padding: 6px 12px;
            margin: 2px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            background: #007bff;
            color: white;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

        <h2>Student List Application</h2>
        <form method="POST" action="">
            <h3>Add New Student</h3>
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="text" name="course" placeholder="Enter Course" required>
            <button type="submit" name="add">Add Student</button>
        </form>

        <?php
        // Handle Add Student
        if(isset($_POST['add'])){
            $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['course']]);
            echo "<p style='text-align:center;color:green;'>✅ Student added successfully!</p>";
        }
        ?>

        <!-- Display Students -->
        <h3>All Students</h3>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
            </tr>
            <?php
            $stmt = $conn->query("SELECT * FROM students");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['course']}</td>
                        <td>
                            <a href='index.php?edit={$row['id']}'>Edit</a>
                            <a href='index.php?delete={$row['id']}'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </table>

        <?php
        // Handles Delete Action
        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
            $stmt->execute([$id]);
            echo "<p style='text-align:center;color:red;'>❌ Student deleted!</p>";
            header("Refresh:0; url=index.php"); // refresh page
        }

        // Handles Edit Action
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
            $stmt->execute([$id]);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<form method='POST' action='' style='margin-top:20px;'>
                    <h3>Edit Student</h3>
                    <input type='text' name='name' value='{$student['name']}' required>
                    <input type='email' name='email' value='{$student['email']}' required>
                    <input type='text' name='course' value='{$student['course']}' required>
                    <button type='submit' name='update'>Update Student</button>
                  </form>";
            // Handels Edit Action
            if(isset($_POST['update'])){
            $stmt = $conn->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['course'], $id]);
            echo "<p style='text-align:center;color:blue;'> Student updated!</p>";
            exit;
        }
            }

        ?>

</body>
</html>