<?php


if (!isset($_POST)){
 header('Location: main.php');}
else {
 $game = $_POST['game'];
}
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
<h3>Below are a few reasonable places to look for Pokémon. Happy Hunting!</h3>
<div style="max-height: 550px; overflow: scroll;">
<?
$link = mysqli_connect("localhost", "test", "test", "poketool");
$query = "SELECT g.gen FROM Game g WHERE g.gid = '$game'";
$gen = mysqli_fetch_array(mysqli_query($link, $query));
$gen = $gen['gen'];
?> <table> <tr> <th>#</th> <th>Pokemon</th> <th> Location </th> <th> Area </th> <th> Method </th> <th> Time of Day </th> <th> Game </th> </tr> <?
    foreach ($_POST as $var=>$key) {
        if (!(($var == "user") OR ($var == "game"))){
        $query = "SELECT p.dexno, p.name, c.mid, c.tid, a.name as areaname, g.name as gamename, l.name as locationname
                  FROM Pokemon p
                  JOIN Capture c ON p.dexno = c.pid
                  JOIN Area a ON a.aid = c.aid
                  JOIN Location l ON l.lid = a.lid
                  JOIN Game g ON c.gid = g.gid
                  WHERE p.dexno = '$key' AND c.gid IN (SELECT g.gid From Game g WHERE g.gen = $gen)";
        //echo $query;
        $result = mysqli_query($link, $query);
        while ($pokemon = mysqli_fetch_array($result)) { 
        ?> <tr><td><? echo $pokemon['dexno'] ?></td>
             <td><? echo $pokemon['name'] ?></td>
             <td><? echo $pokemon['locationname'] ?></td>
             <td><? echo $pokemon['areaname'] ?></td>
             <td><? switch ($pokemon['mid']) {
                    case 1:
                        echo "Walk";
                        break;
                    case 2:
                        echo "Fish";
                        break;
                    default: 
                        echo "Magic";
                    } ?></td>
             <td><? switch ($pokemon['tid']) {
                    case 1:
                        echo "Day";
                        break;
                    case 2:
                        echo "Night";
                        break;
                    default:
                        echo "Always";
                    }?></td>

              <td><? echo $pokemon['gamename'] ?></td></tr> <?
        }}
    }  ?></table> <?
mysqli_close($link);
?>
</div>
<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</center>
</body>
</html>