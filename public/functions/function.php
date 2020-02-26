<?php
     /*
     ** Title Function v1.0
     ** Title Function That Echo The Page Title In Case The Page
     ** Has The Variable $pageTitle And Echo Default Title For Other Pages
     */


    /*
     ** Home Redirect Function v2.0
     ** This Function Accept Parameters
     ** $errorMsg = Echo The Error Message [ Error | Success | Warning]
     ** $url = The Link You Want To Redirect To
     ** $seconds = Seconds Before Redirecting
    */

    function redirectHome($theMsg , $url = null , $seconds = 3){

        if($url === null){
            $url = 'index.php';
            $link = 'Home Page';
        } else {

            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){

                $url = $_SERVER['HTTP_REFERER'];
                $link = 'Previous Page';

            } else {
                $url = 'index.php';
                $link = 'Home Page';

            }
        }

        echo $theMsg;

        echo "<div class='alert alert-info'>You Will Be Redirected To $link After $seconds Seconds</div>";

        header("refresh:$seconds ; url=$url");

        exit();
    }

    /*
     ** Check Items Function v1.0
     ** Function To Check Item In Database [Function Accept Parameters]
     ** $select = The Item To Select [ Example: user, item, category]
     ** $from = The Table To Select From [ Example: users, items, categories ]
     ** $value = The Value Of Select [ Example: Belques, Box, Electronics ]
    */

    function checkItem($select, $from, $value){
        global $conn;

        $statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statement->execute(array($value));
        $count = $statement->rowCount();
        return $count;
    }


    /*
    ** Count Number Of Items Function v1.0
    ** Function To Count Number Of Items Rows
    ** $Item = The Item To Count
    ** $table = The Table To Choose From
    */

    function countItems($item, $table){

        global $conn;

        $stmt2 = $conn->prepare("SELECT COUNT($item) FROM $table");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }


    /*
    ** Get Latest Records Functions v1.0
    ** Function To Get Latest Items From Database [ users , items , comments ]
    ** $select = Field To Select
    ** $table = The Table To Choose From
    ** $limit = Number Of Records To Get
    */

    function getLatest($select, $table , $order , $limit = 5){

        global $conn;

        $getstmt = $conn->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

        $getstmt->execute();

        $rows = $getstmt->fetchAll();

        return $rows;
    }

