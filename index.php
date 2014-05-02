<?php
// Poketool v0.1
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <title>Pokétool - Welcome!</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script type="text/javascript" src="script.js" ></script>
</head>
<body>
<center>
    <h1>The Pokétool</h1>
    <div class="account">
        <div class="login">
        <form action="login.php" method="post">
            <h3>Log In</h3>
            <div class="fieldnames">
                Email: <br />
                Password: 
            </div>
            <div class="fields">
                <input type="text" name="email" /><br>
                <input type="password" name="passwd" />
            </div>
            <input type="submit" value="Log In" />
        </form>
        </div>

        <div class="register">
        <form action="register.php" method="post">
            <h3>Create account</h3>
            <div class="fieldnames">
                Email: <br />
                Name: <br />
                Password: 
            </div>
            <div class="fields">
                <input type="text" name="email" /><br>
                <input type="text" name="name" /><br>
                <input type="password" name="passwd" />
            </div>
            <input type="submit" value="Register" />
        </form>
        </div>
    </div>
</center>
<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</body>
</html>