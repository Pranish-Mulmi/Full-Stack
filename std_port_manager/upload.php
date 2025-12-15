<?php
include 'header.php';
include 'functions.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['portfolio'])) {
    try {
        $success = uploadPortfolioFile($_FILES['portfolio']);
    } catch (Exception $e) {
        $errors['upload'] = $e->getMessage();
    }
}
?>

<h2>Upload Portfolio File</h2>
<?php if ($success): ?><p style="color:green;"><?= $success ?></p><?php endif; ?>
<?php if (!empty($errors['upload'])): ?><p style="color:red;"><?= $errors['upload'] ?></p><?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <input type="file" name="portfolio">
  <button type="submit">Upload</button>
</form>

<?php include 'footer.php'; ?>
