<?php
function formatName($name) {
    return ucwords(strtolower($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map('trim', $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . "\n";
    if (!file_put_contents("students.txt", $line, FILE_APPEND)) {
        throw new Exception("Unable to save student info.");
    }
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload error.");
    }
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Invalid file type. Only PDF, JPG, PNG allowed.");
    }
    if ($file['size'] > $maxSize) {
        throw new Exception("File too large. Max 2MB.");
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "portfolio_" . time() . "." . $ext;
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0777, true)) {
            throw new Exception("Failed to create uploads directory.");
        }
    }

    $targetPath = $targetDir . $newName;
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return "File uploaded successfully as $newName";
    } else {
        throw new Exception("Failed to move uploaded file.");
    }
}
?>