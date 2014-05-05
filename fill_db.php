<?php

$link = mysqli_connect("localhost", "test", "test", "poketool");

/*$query = "select * from Pokemon WHERE dexno < 152";
$result = mysqli_query($link, $query); 
while ($pokemon = mysqli_fetch_array($result)) {
     echo $pokemon['name']; ?> <br>
    <?
} */

$pokemon_csv       = array_map('str_getcsv', file(dirname(__FILE__).'/csv/pokemon.csv'));
$pokemon_types_csv = array_map('str_getcsv', file(dirname(__FILE__).'/csv/pokemon_types.csv'));
$types_csv         = array_map('str_getcsv', file(dirname(__FILE__).'/csv/type_names.csv'));
$versions_csv      = array_map('str_getcsv', file(dirname(__FILE__).'/csv/version_names.csv'));
$regions_csv       = array_map('str_getcsv', file(dirname(__FILE__).'/csv/regions.csv'));
$locations_csv     = array_map('str_getcsv', file(dirname(__FILE__).'/csv/locations.csv'));
$encounters_csv    = array_map('str_getcsv', file(dirname(__FILE__).'/csv/encounters.csv'));


// echo $pokemon_csv[1][1];
// id    identifier  species_id  height  weight  base_experience order   is_default
foreach ($pokemon_csv as $pokemon) {
    // echo $pokemon[1].'<br>';

    $query = "INSERT INTO Pokemon (
                dexno,
                name
              ) VALUES (
                $pokemon[0],
                '".ucfirst($pokemon[1])."'
              );";
    
    mysqli_query($link, $query);

}

foreach ($types_csv as $type) {
    $query = "INSERT INTO Types (
                tid,
                name
              ) VALUES (
                $type[0],
                'ucfirst($type[1])'
              );";
    
    mysqli_query($link, $query);
}

foreach ($pokemon_types_csv as $pokemon_types) {

    if ($pokemon_types[2] == 1) {
        $query = "UPDATE Pokemon
                  SET type1 = $pokemon_types[1]
                  WHERE dexno = $pokemon_types[0];";
    } else {
        $query = "UPDATE Pokemon
                  SET type2 = $pokemon_types[1]
                  WHERE dexno = $pokemon_types[0];";
    }

    mysqli_query($link, $query);
}

foreach ($versions_csv as $version) {
    $gen = 0;
    if ($version[0] <= 2) {
        $gen = 1;
    } else if ($version[0] <= 6) {
        $gen = 2;
    } else if ($version[0] <= 11) {
        $gen = 3;
    } else if ($version[0] <= 16) {
        $gen = 4;
    } else if ($version[0] <= 22) {
        $gen = 5;
    } else {
        $gen = 6;
    }

    $query = "INSERT INTO Game (
                gid,
                gen,
                name
              ) VALUE (
                $version[0],
                $gen,
                '$version[2]'
              );";

    mysqli_query($link, $query);
}

foreach ($regions_csv as $region) {

    $query = "INSERT INTO Region (
                rid,
                name
              ) VALUES (
                $region[0],
                '".ucfirst($region[1])."'
              );";

    mysqli_query($link, $query);

}

foreach ($locations_csv as $location) {

    $query = "INSERT INTO Area (
                aid,
                rid,
                name
              ) VALUES (
                $location[0],
                $location[1],
                '$location[2]'
              );";

    mysqli_query($link, $query);

}

// id,version_id,location_area_id,encounter_slot_id,pokemon_id,min_level,max_level
foreach ($encounters_csv as $encounter) {

    $query = "INSERT INTO Capture (
                cid,
                pid,
                aid,
                gid,
                min_level,
                max_level
              ) VALUES (
                $encounter[0],
                $encounter[4],
                $encounter[2],
                $encounter[1],
                $encounter[5],
                $encounter[6]
              );";

    mysqli_query($link, $query);
}

mysqli_close($link);

/*$result = mysqli_query($link, $query); 
while ($pokemon = mysqli_fetch_array($result)) {
     echo $pokemon['name']; ?> <br>
    <?
} */

?>