<?php
$jsonFile = 'users.json';
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8 || !preg_match("/[!@#$%^&*]/", $password)) {
        $errors['password'] = "Password must be at least 8 characters and include a special character.";
    }
    if ($password !== $confirmPassword) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        try {
            if (!file_exists($jsonFile)) {
                file_put_contents($jsonFile, json_encode([]));
            }

            $usersData = file_get_contents($jsonFile);
            $users = json_decode($usersData, true);

            if (!is_array($users)) {
                $users = [];
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $newUser = [
                "name" => $name,
                "email" => $email,
                "password" => $hashedPassword
            ];

            $users[] = $newUser;

            if (file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT))) {
                $success = "Registration successful!";
            } else {
                $errors['file'] = "Error writing to users.json.";
            }
        } catch (Exception $e) {
            $errors['exception'] = "Unexpected error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
          min-height: 100vh;
          display: flex;
          flex-direction: column;
          align-items: center;
          padding-top: 40px;
        }

        .header {
          text-align: center;
          margin-bottom: 20px;
        }

        .success {
          background: #d4edda;
          color: #155724;
          padding: 10px 20px;
          border-radius: 6px;
          margin-top: 10px;
          font-weight: 600;
          display: inline-block;
        }

        .container {
          background: #fff;
          padding: 30px;
          border-radius: 12px;
          box-shadow: 0 8px 20px rgba(0,0,0,0.15);
          width: 100%;
          max-width: 420px;
        }
        form label {
          display: block;
          margin-bottom: 6px;
          font-weight: 600;
          color: #444;
        }

        form input {
          width: 100%;
          padding: 10px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 6px;
          font-size: 14px;
          transition: border-color 0.3s;
        }

        form input:focus {
          border-color: #6c63ff;
          outline: none;
        }

        button {
          width: 100%;
          padding: 12px;
          background: #6c63ff;
          color: #fff;
          border: none;
          border-radius: 6px;
          font-size: 16px;
          font-weight: bold;
          cursor: pointer;
          transition: background 0.3s;
        }

        button:hover {
          background: #574fd6;
        }

        .error {
          color: #d9534f;
          font-size: 13px;
          margin-top: -10px;
          margin-bottom: 10px;
          display: block;
        }

    </style>
</head>
<body>
    <h1 style="text-align: center;">User Registration</h1>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Name:
            <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            <span class="error"><?= $errors['name'] ?? '' ?></span>
        </label>

        <label>Email:
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            <span class="error"><?= $errors['email'] ?? '' ?></span>
        </label>

        <label>Password:
            <input type="password" name="password">
            <span class="error"><?= $errors['password'] ?? '' ?></span>
        </label>

        <label>Confirm Password:
            <input type="password" name="confirm_password">
            <span class="error"><?= $errors['confirm_password'] ?? '' ?></span>
        </label>

        <button type="submit">Register</button>
    </form>
</body>
</html>