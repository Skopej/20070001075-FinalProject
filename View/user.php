<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="874318790387-8l407u3nlrb1d282ddpeg3k8r3q5oo7q.apps.googleusercontent.com">
    <script>
        function onSignIn(googleUser) {
            const profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());
            window.location.href = "index.php";
        }

        function onRegister() {
            // Handle registration
            alert("Registration successful!");
            window.location.href = "index.php";
        }

        function goToHomePage() {
            window.location.href = 'index.php';
        }
    </script>
</head>
<body>
<div class="user-container">
    <div class="left-side">
        <div class="google-sign-in">
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        <div class="registration-form">
            <h2>Login</h2>
            <form action="user.php" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <div class="right-side">
        <div class="registration-form">
            <h2>Register</h2>
            <form action="user.php" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <label for="country">Country</label>
                <input type="text" id="country" name="country">
                <label for="city">City</label>
                <input type="text" id="city" name="city">
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</div>
<div class="return-home-container">
    <button class="return-home-button" onclick="goToHomePage()">Return to Home</button>
</div>
</body>
</html>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Services/userServices.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        addUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['country'], $_POST['city']);
    } else {
        $isValid = checkUser($_POST['email'], $_POST['password']);
        if ($isValid) {
            header("Location: index.php");
        }
    }
}
?>
