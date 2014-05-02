<?php
    session_start();

    $email = $_POST['email'];
    $name = $_POST['name'];
    $passwd = $_POST['passwd'];

    $query = "insert into USER (
                name,
                email,
                password
              ) values (
                '$email',
                '$name',
                '$passwd'
              )";

    $_SESSION['logged_user'] = $name;

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
    <h1>Welcome, <? $_SESSION['name'] ?>!</h1>
</center>
<h3>In what game do you want to fill the Pokédex?</h3>
<?
    while ($game = mysqli_fetch_array($results)) {
        ?>
        <input type="radio" name="game" value="<? echo $game['id'] ?>" />
        <? echo $game['name'] ?> (<? echo $game['system'] ?>)<br>
        <?
    }
?>
<h3>Which Pokémon have you caught already?</h3>
<?
    while ($pokemon = mysqli_fetch_array($results)) {
        ?>
        <input type="checkbox" name="pokemon" value="<? echo $pokemon['dexno'] ?>" />
        <? echo $pokemon['dexno'] ?> - <? echo $pokemon['name'] ?><br>
        <?
    }
?>

<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</body>
</html>