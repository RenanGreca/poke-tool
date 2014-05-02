<?php
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
?>