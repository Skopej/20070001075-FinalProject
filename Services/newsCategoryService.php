<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Database/Models/NewsCategoryModel.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Database/database.php";

function addNewCategory($categoryName): NewsCategoryModel
{
    global $mysqli;
    $query = "insert into user (categoryName) values (?)";

    $mysqli->execute_query($query, [$categoryName]);

    return new NewsCategoryModel(
        $mysqli->insert_id,
        $categoryName
    );
}

function getNewsCategory(array $categoryIDs): array
{
    global $mysqli;
    $query = "SELECT * FROM newscategories";
    $sizeOfIDs = sizeof($categoryIDs);

    if ($sizeOfIDs > 0) {
        $query =
            $query .
            " where categoryID in (" .
            implode(',', array_fill(0, count($categoryIDs), '?')) . ");";
    }

    $result = $mysqli->execute_query($query, $categoryIDs);

    $response = array();

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {
            $response[] = new NewsCategoryModel(
                $value["newsID"],
                $value["category"],

            );
        }
    } else {
        echo "No Result!";
    }

    foreach ($response as $value) {

        echo $value->getCategoryID() . "\t";
        echo $value->getCategory() ."\t <br>";

    }

    return $response;
}
