<?php

if(isset($_POST["image"])) {
    $data = $_POST["image"];
    $img_array_1 = explode(";", $data);
    $img_array_2 = explode(",", $img_array_1[1]);
    $data = base64_decode($img_array_2[1]);
    $imageName = uniqid() . '.png';

    $path = '../images/user-events/' . $imageName;
    echo 'images/user-events/' . $imageName;
    file_put_contents($path, $data);
}