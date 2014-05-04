<?php

/*Currently, grabbing data detroys the query: datatype? 

if (isset($_POST['user'])){ 
    $user = $_POST['user']; 
} else {$user = 1;}

if (isset($_POST['game'])){ 
    $game = $_POST['game']; 
} else {$game = 1;}

*/
$user = 1;
$game = 1;

$link = mysqli_connect("localhost", "test", "test", "poketool");

    #This should be adding a tuple per pokemon in the checkbox list. It currently
    # seems to be misbehaving? Why?
    foreach ($_POST as $pokemon => $pid) {
            if ($pokemon == "pokemon"){
                $query = "INSERT INTO Pokedex ( dexno, game, uid ) VALUES ('$pid', '$user', '$game')";    
                if (!mysqli_query($link,$query)) {
                    Echo "Query errored."; 
                }
            }
    }
mysqli_close($link);

header('Location: main.php');
?>