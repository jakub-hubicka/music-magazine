<?php

if (isset($_POST["image"])) {
    $data = $_POST["image"];
    $base64explode = explode(";", $data);
    $base64explode_level2 = explode(",", $base64explode_level2[1]);
    $data = base64_decode($base64explode[1]);
    $imageName = uniqid() . '.png';

    $path = '../images/banner/' . $imageName;
    echo 'images/banner/' . $imageName;
    file_put_contents($path, $data);
}