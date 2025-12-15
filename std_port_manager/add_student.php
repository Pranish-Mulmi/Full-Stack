<?php
include 'header.php';
include 'functions.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = formatName(trim($_POST['name']));
    $email = trim($_POST['email']);
    $skillsString = trim($_POST['skills']);

    try {
        if (empty($name)) $errors['name'] = "Name is required.";
        if (!validateEmail($email)) $errors['email'] = "Invalid email format.";
        if (empty($skillsString)) $errors['skills'] = "Skills are required.";

        if (empty($errors)) {
            $skillsArray = cleanSkills($skillsString);
            saveStudent($name, $email, $skillsArray);
            $success = "Student info saved successfully!";
        }
    } catch (Exception $e) {
        $errors['exception'] = "Error: " . $e->getMessage();
    }
}
?>

<h2>Add Student Info</h2>
<?php if ($success): ?><p style="color:green;"><?= $success ?></p><?php endif; ?>

<form method="POST">
  <label>Name: <input type="text" name="name"></label><br>
  <span style="color:red;"><?= $errors['name'] ?? '' ?></span><br>

  <label>Email: <input type="email" name="email"></label><br>
  <span style="color:red;"><?= $errors['email'] ?? '' ?></span><br>

  <label>Skills (comma-separated): <input type="text" name="skills"></label><br>
  <span style="color:red;"><?= $errors['skills'] ?? '' ?></span><br>

  <button type="submit">Save</button>
</form>

<?php include 'footer.php'; ?>