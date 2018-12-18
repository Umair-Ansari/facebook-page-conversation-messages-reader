<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 5:36 PM
 */

class Database
{
    private $con;
    function __construct()
    {
        $this->con = @mysqli_connect('localhost', 'root', '', 'fb_conversations');

        if (!$this->con) {
            echo "Error: " . mysqli_connect_error();
            exit();
        }

    }

    function get_connection(){
        return $this->con;
    }
    function close_connection(){
        mysqli_close($this->con);
    }
}