<?php

if (isset($_POST['user'])){ 
    $user = (int)$_POST['user']; 
} else {$user = 1;} #default user is 1: test;
$user=1;
if (isset($_POST['game'])){ 
    $game = (int)$_POST['game']; 
} else {$game = 1;} #default game is Red;

$link = mysqli_connect("localhost", "test", "test", "poketool");

echo $user;
echo $game;
    foreach ($_POST as $pokemon=>$pid) {
        if (!( ($pokemon == "user") OR ($pokemon == "game"))) {
            $query = "INSERT INTO Pokedex ( dexno, game, uid ) VALUES ('$pid','$game','$user')";    
            if (!mysqli_query($link,$query)) {
                Echo "Query errored or already exists."; 
            }
        }
    }
mysqli_close($link);

header('Location: main.php');
?>