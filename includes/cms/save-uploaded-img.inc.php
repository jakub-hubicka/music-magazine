<?php

if (isset($_POST["image"])) {
    $type = $_POST['type'];
    $data = $_POST["image"];
    $base64explode = explode(";", $data);
    $base64explode_level2 = explode(",", $base64explode[1]);
    $data = base64_decode($base64explode_level2[1]);
    $imageName = uniqid() . '.png';

    switch ($type) {
        case 'novinka':
            $path = '../../root/images/novinky/' . $imageName;
            echo 'images/novinky/' . $imageName;
            break;

        case 'recenze':
            $path = '../../root/images/recenze/' . $imageName;
            echo 'images/recenze/' . $imageName;
            break;
        
        case 'rozhovor':
            $path = '../../root/images/clanky/' . $imageName;
            echo 'images/clanky/' . $imageName;
            break;

        case 'report':
            $path = '../../root/images/clanky/' . $imageName;
            echo 'images/clanky/' . $imageName;
            break;

        case 'akce':
            $path = '../../root/images/akce/' . $imageName;
            echo 'images/akce/' . $imageName;
            break;

        case 'ostatni':
            $path = '../../root/images/clanky/' . $imageName;
            echo 'images/clanky/' . $imageName;
            break;

        case 'alba':
            $path = '../../root/images/clanky/' . $imageName;
            echo 'images/akce/' . $imageName;
            break;

        default:
            # code...
            break;
    }
    file_put_contents($path, $data);
}