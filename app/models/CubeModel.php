<?php

namespace App\Models;
use App\Core\Database;

class CubeModel {

    protected function setCubeInfo(string $date, string $title, string $shortText, string $link, string $image): void {
        $Db = new Database;
        $sql = "INSERT INTO
                    cube(
                        date, 
                        title, 
                        subtitle, 
                        image, 
                        link
                    )
                VALUES (?,?,?,?,?)					
        ";
        $Db->query($sql);
        $Db->bind(1, $date);
        $Db->bind(2, $title);
        $Db->bind(3, $shortText);
        $Db->bind(4, $image);
        $Db->bind(5, $link);
        $Db->execute();
        $host = $_SERVER['HTTP_HOST'];
        header("Location: https://" . $host . "/root/cms");
    }

    protected function getCubeInfo(): array {        
        $Db = new Database;
        $sql = "SELECT
                    date, 
                    title, 
                    subtitle,
                    image, 
                    link
                FROM cube
                ORDER BY id
                DESC
                LIMIT 1";
		$Db->query($sql);
		return $Db->resultSet()[0];
    }
}