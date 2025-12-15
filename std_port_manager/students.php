<?php
include 'header.php';
include 'functions.php';

$students = [];

if (file_exists("students.txt")) {
    $students = file("students.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}
?>

<h2>Registered Students</h2>

<?php if (empty($students)): ?>
    <p>No students found.</p>
<?php else: ?>
    <ul>
    <?php foreach ($students as $student): 
        $data = explode("|", $student);
        $name = $data[0] ?? '';
        $email = $data[1] ?? '';
        $skills = isset($data[2]) ? explode(",", $data[2]) : [];
        $filePath = $data[3] ?? '';
        echo "<li><strong>$name</strong> ($email)<br>";
        echo "Skills: " . implode(", ", $skills) . "<br>";
        if (!empty($filePath)) {
            echo "Portfolio: <a href='uploads/$filePath' target='_blank'>View File</a>";
        }
        echo "</li>";

    ?>
        <li>
            <strong><?= htmlspecialchars($name) ?></strong> (<?= htmlspecialchars($email) ?>) <br>
            Skills: <?= htmlspecialchars(implode(", ", $skills)) ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include 'footer.php'; ?>