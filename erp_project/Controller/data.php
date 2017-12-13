<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 27/11/2017
 * Time: 11:05
 */



if(isset($_POST['newDate']))
{
    echo("cul");
    include_once "../Model/pdo.php";
    include_once "../Model/data.php";
    changeDate($db,$_POST['newDate']);

}