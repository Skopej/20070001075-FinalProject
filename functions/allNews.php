<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Services/newService.php";
$info =getNews([]);
$data = [];
foreach ($info as $value){
    $data[] = array($value->getNewsTitle(),$value->getNewsDetail(),$value->getNewsImage(),$value->getNewsDate());
}
echo json_encode($data);

