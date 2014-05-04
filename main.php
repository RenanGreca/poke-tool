<?php


if (isset($_POST)){
 $selected_game = $_POST['game'];
 $task = $_POST['task'];}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <title>Pokétool</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script type="text/javascript" src="script.js" ></script>
</head>
<body>
<center>
    <h1>Welcome, <? $_SESSION['name']?>!</h1>
</center>
<!-- currently this connection is to localhost for testing purposes with dummy user.-->
<?  $link = mysqli_connect("localhost", "test", "test", "poketool"); 
if(!$selected_game){ ?>
<h3>What would you like to do?</h3>
    <form action="#" method="POST">
    <select name="game"> 
    <option value="">Select Game..</option> 
   <?
    $query = "select * from Game";
    $result = mysqli_query($link, $query);
    while ($game = mysqli_fetch_array($result)) {
        ?>
        <option value="<? echo $game['gid'] ?>"><? echo $game['name']?> </option></br>
        <?
    }
    ?></select>
    <select name="task"> 
    <option value="">....</option> 
    <option value="pokedex">See my pokedex</option>
    <option value="find">Help me find pokemon</option>
    </select>
<input type="submit" value="Go!"></form>

<? } elseif($task == "pokedex"){ 
$query = "select * from Pokemon JOIN Pokedex ON Pokemon.dexno = Pokedex.dexno WHERE Pokedex.game='$selected_game'";
?>
<div>
<?
    $result = mysqli_query($link, $query); 
    while ($pokemon = mysqli_fetch_array($result)) {
         echo $pokemon['name']; ?> <br>
        <?
    } ?>
</div>
  <? } elseif($task == "find") { ?>
<div>
<?
    $query = "select * from Pokemon JOIN Capture ON Pokemon.dexno = Capture.pid WHERE Capture.gid = '$selected_game' AND Capture.pid NOT IN (SELECT dexno FROM Pokedex WHERE uid=1)";
    $result = mysqli_query($link, $query); 
    while ($pokemon = mysqli_fetch_array($result)) {
         echo $pokemon['name']; ?> <br>
        <?
    } ?></div><?
} 
else { Echo $_POST['task']; }
?>
<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</body>
</html>