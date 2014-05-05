<?php


if (!isset($_POST)){
 header('Location: main.php');}
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
<h3>Below are a few reasonable places to look for pokemon. Happy Hunting!</h3>
<?
$link = mysqli_connect("localhost", "test", "test", "poketool");
?> <table> <tr> <th>#</th> <th>Pokemon</th> <th> Area </th> <th> Method </th> <th> Time of Day </th> </tr> <?
    foreach ($_POST as $var=>$key) {
        if (!(($var == "user") OR ($var == "game"))){
        $query = "SELECT p.dexno, p.name, c.mid, c.tid, a.name as areaname
                  FROM Pokemon p
                  JOIN Capture c ON p.dexno = c.pid
                  JOIN Area a ON a.aid = c.aid
                  WHERE p.dexno = '$key'";    
        $result = mysqli_query($link, $query);
        while ($pokemon = mysqli_fetch_array($result)) { 
        ?> <tr><td><? echo $pokemon['dexno'] ?></td>
             <td><? echo $pokemon['name'] ?></td>
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
                    }?></td> </tr> <?
        }}
    }  ?></table> <?
mysqli_close($link);
?>
<div class="footer">
    <a href="https://github.com/RenanGreca/poke-tool">Created by Renan Greca and Mari Bennett in 2014</a><br />
    Pokémon and all related content is owned by The Pokémon Company, Nintendo and GameFreak<br />
</div>
</center>
</body>
</html>