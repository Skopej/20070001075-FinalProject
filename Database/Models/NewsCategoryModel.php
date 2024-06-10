<?php

class NewsCategoryModel
{
    private int $categoryID;
    private string $category;

    public function __construct($categoryID, $category)
    {
        $this->categoryID = $categoryID;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getCategoryID(): int
    {
        return $this->categoryID;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

}