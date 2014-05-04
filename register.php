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
    <h1>Welcome, <? $_SESSION['name']?>!</h1>
</center>
<!-- currently this connection is to localhost for testing purposes with dummy user.-->
<?  $link = mysqli_connect("localhost", "test", "test", "poketool"); ?>

<div id="formpage_1" style="visibility:visible; display: block">
<h3>In what game do you want to fill the Pokédex?</h3>
<?
    $query = "select * from Game";
    $result = mysqli_query($link, $query);
    while ($game = mysqli_fetch_array($result)) {
        ?>
        <input type="radio" name="game" value="<? echo $game['gid'] ?>" onclick=<? $selected_game=$game['gid'];?> />
        <? echo $game['name'] ?> (<? echo $game['plat'] ?>)<br>
        <?
    }
?>
<input type="submit" onclick="pagechange(1,2)">
</div>
<div id="formpage_2" style="visibility: hidden; display: none;">
<h3>Which Pokémon have you caught already?</h3>
<form action="add.php" method="post">
<input type="hidden" name="user" value=<? echo $_SESSION['name'] ?> />
<input type="hidden" name="game" value=<? echo $selected_game ?> />
<?
    $query = "select DISTINCT Pokemon.dexno, Pokemon.name from Pokemon JOIN Capture ON Pokemon.dexno=Capture.pid WHERE Capture.gid=1";
    $result = mysqli_query($link, $query);
    while ($pokemon = mysqli_fetch_array($result)) {
        ?>
        <input type="checkbox" name="pokemon" value=<? echo $pokemon['dexno'] ?> />
        <? echo $pokemon['dexno'] ?> - <? echo $pokemon['name'] ?><br>
        <?
    }
?>
<input type="submit"></form>
</div>

<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</body>
</html>