<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:08 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\Database.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Page.php";
class PageRepo
{
    function get_page()
    {
        $database = new Database();

        $pageList = array();

        $sql = 'SELECT * FROM fbinbox_page';
        $query = mysqli_query($database->get_connection(), $sql);
        while ($row = mysqli_fetch_array($query)) {
            $page = new Page();
            $page->setRow($row);
            $pageList[] =  $page;
        }

        $database->close_connection();
        return $pageList;
    }

    function updatePageUpdatedTime($page){
        $database = new Database();

        $sql = 'UPDATE `fbinbox_page` SET `updated_time`="'.$page->getUpdatedTime().'" WHERE id='.$page->getId();
        mysqli_query($database->get_connection(), $sql);
        $database->close_connection();
    }
}