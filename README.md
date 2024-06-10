# 20070001075-Final-Project

The reason why I use PHP is, Our senior project was on the PHP due to Yaşar University's restriction. However, I mixed JavaScript with PHP and HTML.

Here is my Database structure;

create database msn;

use msn;

CREATE TABLE `user` (
  `userID` bigint(20) NOT null auto_increment primary key,
  `userName` varchar(100) NOT NULL,
  `userSurname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
);

CREATE TABLE `newsCategories` (
  `categoryID` bigint(20) NOT null auto_increment primary key,
  `category` varchar(100) NOT null
);

CREATE TABLE `news` (
  `newsID` bigint(20) NOT null auto_increment primary key,
  `category` varchar(100) NOT NULL,
  `newsTitle` varchar(100) NOT null,
  `newsImage` varchar(100) NOT NULL,
  `newsDetail` varchar(255) NOT NULL,
  `newsDate` date NOT NULL 
);

and you can see my models on Database/Models directory in the project.

----------------------------------------

The first struggle or maybe a mistake for me is making the newsDetail part varchar(100). News detail in real life it takes much more than that.
Second struggle is EN/TR changes. My News Categories comes to the front with their attribute on query. Query in english works but the Turkish doesn't work.

I could do this project with .NET or any framework with JS but I was so comfortable with PHP, and that costs me for publishing on AWS. I couldn't manage the dockerize PHP 8.2 version. I have got infinite errors during the process. Unfortunetly no publishing for the project.

Project Video:

https://drive.google.com/file/d/1DyB4JpM_HGqfhvVed548doBWQzaBQX8h/view?usp=sharing
