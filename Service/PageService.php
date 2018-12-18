<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:05 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\PageRepo.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Conversation.php";
class PageService
{
    function get_all_pages(){
        $pageRepo = new PageRepo();
        return $pageRepo->get_page();
    }

    function updatePageUpdatedTime($page){
        $pageRepo = new PageRepo();
        $pageRepo->updatePageUpdatedTime($page);
    }
}