<?php
session_start();
include 'db_connect.php';
$error ='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'chef') {
                    header("Location: home.html");
                    exit();
                } else {
                    header("Location: home.html");
                    echo "<script>window.location.href='home.html';</script>";
                    exit();
                }
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Email not found.";
        }
    } else {
        $error = "Database error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login - Desilicious</title>
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

      .login-form {
        background-color: #fff;
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }

      .login-form h2 {
        margin-bottom: 20px;
        color: #990000;
      }

      .login-form input {
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
        font-size: 16px;
      }

      .login-form button {
        padding: 12px;
        background-color: #990000;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
      }

      .login-form button:hover {
        background-color: #cc0000;
      }

      .login-form .options {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #555;
        margin-top: 10px;
      }

      .image-side {
        flex: 1;
        background-image: url("login.jpg"); 
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
      <div class="login-form">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
  <div style="color: red; margin-bottom: 10px; font-size: 14px;">
    <?= $error ?>
  </div>
<?php endif; ?>
        <form action="login.php" method="post">
          <input type="email" name="email" placeholder="email" required />
          <input
            type="password"
            name="password"
            placeholder="Password"
            required
          />
          <button type="submit">Login</button>
          <div class="options">
            <a
              href="#"
              style="text-decoration: none; font-family: cursive; color: #000"
              >Forgot Password?</a
            >
            <a
              href="signup.php"
              style="text-decoration: none; font-family: cursive; color: #000"
              >Signup</a
            >
          </div>
        </form>
      </div>
      <div class="image-side"></div>
    </div>
  </body>
</html>
