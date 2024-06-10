<?php
class NewsModel
{
    private int $newsID;
    private string $category;
    private string $newsTitle;
    private string $newsImage;
    private string $newsDetail;
    private string $newsDate;

    public function __construct($newsID, $category, $newsTitle, $newsImage, $newsDetail, $newsDate)
    {
        $this->newsID = $newsID;
        $this->category = $category;
        $this->newsTitle = $newsTitle;
        $this->newsImage = $newsImage;
        $this->newsDetail = $newsDetail;
        $this->newsDate = $newsDate;
    }

    /**
     * @return int
     */
    public function getNewsID(): int
    {
        return $this->newsID;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getNewsTitle(): string
    {
        return $this->newsTitle;
    }

    /**
     * @return string
     */
    public function getNewsImage(): string
    {
        return $this->newsImage;
    }

    /**
     * @return string
     */
    public function getNewsDetail(): string
    {
        return $this->newsDetail;
    }

    /**
     * @return string
     */
    public function getNewsDate(): string
    {
        return $this->newsDate;
    }

}