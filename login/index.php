<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register</h1>
      <form method="post" action="register.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signUpButton">Sign Up</button> <br>
          <p>Admin?</p>
          <button id="adminLoginButton">Admin Login</button> <br>
        </div>
      </div>
      <div class="container" id="adminLogin" style="display:none;">
        <h1 class="form-title">Admin Login</h1>
        <form method="post" action="../admin/adminlogin.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="adminEmail" id="adminEmail" placeholder="Admin Email" required>
              <label for="adminEmail">Admin Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="adminPassword" id="adminPassword" placeholder="Admin Password" required>
              <label for="adminPassword">Admin Password</label>
          </div>
         <input type="submit" class="btn" value="Admin Login" name="adminLogin"> <br>
        </form>
        <div class="links">
          <button id="backToSignInButton">Back to Sign In</button> <br>
        </div>
    </div>
      <script src="scripts.js"></script>
</body>
</html>