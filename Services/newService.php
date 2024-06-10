<?php

include $_SERVER["DOCUMENT_ROOT"] . "/Database/database.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Database/Models/NewsModel.php";

function addNew($category, $newsTitle, $newsImage, $newsDetail, $newsDate): NewsModel
{
    global $mysqli;
    $query = "insert into news (category, newsTitle, newsImage, newsDetail, newsDate)"
        . "values (?,?,?,?,?);";

    $mysqli->execute_query($query, [$category, $newsTitle, $newsImage, $newsDetail, $newsDate]);

    return new NewsModel(
        $mysqli->insert_id,
        $category,
        $newsTitle,
        $newsImage,
        $newsDetail,
        $newsDate
    );
}

function getNews(array $newsIDs): array
{
    global $mysqli;
    $query = "SELECT * FROM news";
    $sizeOfIDs = sizeof($newsIDs);

    if ($sizeOfIDs > 0) {
        $query =
            $query .
            " where newsID in (" .
            implode(',', array_fill(0, count($newsIDs), '?')) . ");";
    }

    $result = $mysqli->execute_query($query, $newsIDs);

    $response = array();

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $response[] = new NewsModel(
                $value["newsID"],
                $value["category"],
                $value["newsTitle"],
                $value["newsImage"],
                $value["newsDetail"],
                $value["newsDate"]
            );
        }
    } else {
        echo "No Result!";
    }

//    foreach ($response as $value) {
//
//        echo $value->getNewsID() . "\t";
//        echo $value->getCategory() . "\t";
//        echo $value->getNewsTitle() . "\t";
//        echo $value->getNewsImage() . "\t";
//        echo $value->getNewsDetail() . "\t";
//        echo $value->getNewsDate() . "\t";
//
//    }

    return $response;
}

function getNewsByCategory($category): array
{
    global $mysqli;
    $response = array();
    $query = "select * from news where category = '$category'";
    $result = $mysqli->execute_query($query);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $response[] = new NewsModel(
                $value["newsID"],
                $value["category"],
                $value["newsTitle"],
                $value["newsImage"],
                $value["newsDetail"],
                $value["newsDate"]
            );
        }
    }

    return $response;
}

function getNewsByContent($content): array
{
    global $mysqli;
    $query = "SELECT * FROM news WHERE newsDetail LIKE ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $content); // Bind the parameter
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();

    if ($result->num_rows > 0) {
        while ($value = $result->fetch_assoc()) {
            $response[] = new NewsModel(
                $value["newsID"],
                $value["category"],
                $value["newsTitle"],
                $value["newsImage"],
                $value["newsDetail"],
                $value["newsDate"]
            );
        }
    }

    return $response;
}
