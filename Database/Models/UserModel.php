<?php

class UserModel
{
    private int $userID;
    private string $userName;
    private string $userSurname;
    private string $email;
    private string $password;
    private string $country;
    private string $city;

    public function __construct($userID, $userName, $userSurname ,$email, $password, $country, $city)
    {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->userSurname = $userSurname;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getUserSurname(): string
    {
        return $this->userSurname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

}

