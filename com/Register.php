<?php
if(isset($_POST['Signup']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "name is " . $name . "<br>";
    echo "email is " . $email . "<br>";
    echo "password is " . $password . "<br>";
}
?>
