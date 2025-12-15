<!DOCTYPE html>
<html>
<head>
  <title>Student Portfolio Manager</title>
  <style>
    /* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 20px;
}

/* Navigation */
nav {
  background: #6c63ff;
  padding: 12px 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

nav a {
  color: #fff;
  text-decoration: none;
  margin: 0 12px;
  font-weight: 600;
  transition: color 0.3s;
}

nav a:hover {
  color: #ffd700;
}

/* Container */
.container {
  background: #fff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  width: 100%;
  max-width: 600px;
  margin-bottom: 20px;
}

/* Headings */
h1, h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

/* Forms */
form label {
  display: block;
  margin-bottom: 6px;
  font-weight: 600;
  color: #444;
}

form input, form textarea, form select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  transition: border-color 0.3s;
}

form input:focus, form textarea:focus {
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

/* Messages */
.success {
  background: #d4edda;
  color: #155724;
  padding: 10px 20px;
  border-radius: 6px;
  margin-bottom: 15px;
  text-align: center;
  font-weight: 600;
}

.error {
  color: #d9534f;
  font-size: 13px;
  margin-top: -10px;
  margin-bottom: 10px;
  display: block;
}

/* Student List */
ul {
  list-style: none;
  padding: 0;
}

ul li {
  background: #f9f9f9;
  border: 1px solid #ddd;
  padding: 12px;
  margin-bottom: 10px;
  border-radius: 6px;
}

ul li strong {
  color: #6c63ff;
}
  </style>
</head>
<body>
<nav>
  <a href="index.php">Home</a> |
  <a href="add_student.php">Add Student</a> |
  <a href="upload.php">Upload Portfolio</a> |
  <a href="students.php">View Students</a>
</nav>
</body>
</html>