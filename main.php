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
$result = mysqli_query($link, $query);
?>
<div style="max-height: 500px; overflow: scroll;">
<h3> Your Pokedex Currently Looks Like This: </h3>
<table> <tr> <th>#</th> <th>Pokémon</th> <th> P.Type </th> <th> S.Type </th> </tr> <?  
    while ($pokemon = mysqli_fetch_array($result)) { 
    ?> <tr><td><? echo $pokemon['dexno'] ?></td>
            <td><? echo $pokemon['name'] ?></td>
            <td><? switch ($pokemon['type1']) {
                case 1:  echo "Normal";   break;
                case 2:  echo "Fighting"; break;
                case 3:  echo "Flying";   break;
                case 4:  echo "Poison";   break;
                case 5:  echo "Ground";   break;
                case 6:  echo "Rock";     break;
                case 7:  echo "Bug";      break;
                case 8:  echo "Ghost";    break;
                case 9:  echo "Steel";    break;
                case 10: echo "Fire";     break;
                case 11: echo "Water";    break;
                case 12: echo "Grass";    break;
                case 13: echo "Electric"; break;
                case 14: echo "Psychic";  break;
                case 15: echo "Ice";      break;
                case 16: echo "Dragon";   break;
                case 17: echo "Dark";     break;
                case 18: echo "Fairy";    break;
                default: echo "";
                } ?></td>
            <td><? switch ($pokemon['type2']) {
                case 1:  echo "Normal";   break;
                case 2:  echo "Fighting"; break;
                case 3:  echo "Flying";   break;
                case 4:  echo "Poison";   break;
                case 5:  echo "Ground";   break;
                case 6:  echo "Rock";     break;
                case 7:  echo "Bug";      break;
                case 8:  echo "Ghost";    break;
                case 9:  echo "Steel";    break;
                case 10: echo "Fire";     break;
                case 11: echo "Water";    break;
                case 12: echo "Grass";    break;
                case 13: echo "Electric"; break;
                case 14: echo "Psychic";  break;
                case 15: echo "Ice";      break;
                case 16: echo "Dragon";   break;
                case 17: echo "Dark";     break;
                case 18: echo "Fairy";    break;
                default: echo "";
                } ?></td></tr> <?
    }  ?></table>
</div>
  <? } elseif($task == "find") { ?>
<h3> Select Which Pokémon You'd like Help Finding!</h3>
<form action="find.php" method="post">
<div style="max-height: 500px; overflow: scroll;">
<input type="hidden" name="user" value=<? echo $_SESSION['logged_user'] ?> />
<input type="hidden" name="game" value=<? echo $selected_game ?> />
<?
    $query = "select DISTINCT Pokemon.dexno, Pokemon.name from Pokemon JOIN Capture ON Pokemon.dexno = Capture.pid WHERE Capture.gid = '$selected_game' AND Capture.pid NOT IN (SELECT dexno FROM Pokedex WHERE uid=1)";
    $result = mysqli_query($link, $query); 
    while ($pokemon = mysqli_fetch_array($result)) {
        ?>
        <input type="checkbox" name="<? echo $pokemon['dexno'] ?>" value=<? echo $pokemon['dexno'] ?> />
        <? echo $pokemon['dexno'] ?> - <? echo $pokemon['name'] ?><br>
        <?
    } ?></div><input type="submit" value="Find them all!"/></form><?
} 
else { Echo "Something is wrong. You should not see this."; }
?>
<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</body>
</html>