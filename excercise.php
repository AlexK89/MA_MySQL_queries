<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 27/09/2017
 * Time: 11:05
 */
$db = new PDO("mysql:host=127.0.0.1;dbname=test_DB", "root" , "");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT `name`, `f_color` 
                                FROM `children` 
                                WHERE `f_color` = 3;");
$query->execute();
$result = $query->fetchAll();

foreach ($result as $array)
{
        echo "<p>" . $array["name"] . " and color number is: " . $array["f_color"] . "</p>";
}

$query = $db->prepare("SELECT `children`.`name` 
                                FROM `children` 
                                INNER JOIN `adults` ON `adults`.`child1` = `children`.`id` 
                                WHERE `adults`.`pet_name` = \"Syd\" 
                                GROUP BY `children`.`name`;");
$query->execute();
$result = $query->fetch();

echo "===================================";
echo "<p>" . $result["name"] ."</p>";
echo "===================================";
$query = $db->prepare("SELECT `children`.`name`, `pet_name` 
                                FROM `children` 
                                INNER JOIN `adults` ON `adults`.`child1` = `children`.`id` 
                                AND `adults`.`DOB` > \"1985-01-01\" 
                                WHERE `adults`.`pet_name` IS NOT NULL;");
$query->execute();
$result = $query->fetchAll();

foreach ($result as $array) {
    echo "<p>" . $array["name"] . " and pet name is: " . $array["pet_name"] . "</p>";
}
echo "===================================";
$query = $db->prepare("SELECT `colors`.`color` 
                                FROM `colors` 
                                INNER JOIN `children` ON `colors`.`id` = `children`.`f_color` 
                                INNER JOIN `adults` ON `adults`.`child1` = `children`.`id` 
                                AND `adults`.`DOB` > \"1991-01-01\" 
                                GROUP BY `f_color` 
                                ORDER BY COUNT(`f_color`) 
                                DESC LIMIT 1;");
$query->execute();
$result = $query->fetch();

echo "<p>" . $result["color"] ."</p>";

echo "===================================";