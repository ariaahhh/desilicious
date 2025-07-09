<?php
session_start();
include 'db_connect.php'; // Make sure this connects successfully

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check for duplicate email
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered. <a href='login.php'>Login here</a>.";
        } else {
            // Insert new user
            $stmt->close();

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Signup failed: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        font-family: Arial, sans-serif;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #000000;
      }

      .container {
        width: 800px;
        height: 500px;
        display: flex;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      }

      .signup-form {
        background-color: #fff;
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .signup-form h2 {
        margin-bottom: 20px;
        color: #990000;
      }

      .signup-form input,
      .signup-form select {
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
        font-size: 16px;
      }

      .signup-form button {
        padding: 12px;
        background-color: #990000;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
      }

      .signup-form button:hover {
        background-color: #cc0000;
      }

      .signup-form p {
        margin-top: 20px;
        font-size: 14px;
        color: #333;
      }

      .signup-form a {
        color: #990000;
        text-decoration: none;
        font-weight: bold;
        font-family: cursive;
      }

      .signup-form a:hover {
        text-decoration: underline;
      }

      .image-side {
        flex: 1;
        background-image: url("signup.jpg");
        background-size: cover;
        background-position: center;
        position: relative;
      }

      .image-side::after {
        content: "Welcome to Desilicious";
        position: absolute;
        bottom: 20px;
        left: 20px;
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-shadow: 1px 1px 4px #000;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="signup-form">
        <h2>Sign Up</h2>
        <?php if (!empty($error)): ?>
  <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>
<?php if (!empty($success)): ?>
  <p style="color:green;"><?php echo $success; ?></p>
<?php endif; ?>
        <form action="signup.php" method="post">
          <input type="text" name="name" placeholder="name" required />
          <input
            type="email"
            name="email"
            placeholder="username@gmail.com"
            required
          />
          <input
            type="password"
            name="password"
            placeholder="Password"
            required
          />
          <input
            type="password"
            name="confirm_password"
            placeholder="Confirm Password"
            required
          />

          <select name="role" required style="color: rgba(0, 0, 0, 0.5)">
            <option value="" disabled selected hidden>User or Chef?</option>
            <option value="user" style="color: black">User</option>
            <option value="chef" style="color: black">Chef</option>
          </select>

          <button type="submit">Signup</button>
        </form>

        <p>Already a member? <a href="login.php">Login</a></p>
      </div>
      <div class="image-side"></div>
    </div>
  </body>
</html>
