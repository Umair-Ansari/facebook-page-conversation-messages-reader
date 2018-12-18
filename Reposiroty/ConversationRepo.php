<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:08 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\Database.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Conversation.php";
class ConversationRepo
{
    function getConversationByConversationId($conversation_id)
    {
        $database = new Database();

        $conversation = new Conversation();
        $sql = 'SELECT * FROM fbinbox_conversation WHERE conversation_id="'.$conversation_id.'"';
        $query = mysqli_query($database->get_connection(), $sql);
        while ($row = mysqli_fetch_array($query)) {

            $conversation->setRow($row);
        }

        $database->close_connection();
        return $conversation;
    }
    function createConversation($conversation)
    {
        $database = new Database();

        $sql = 'INSERT INTO `fbinbox_conversation`(`conversation_id`, `updated_time`,`page_id`) VALUES ("'.$conversation->getConversationId().'","'.$conversation->getUpdatedTime().'","'.$conversation->getPageId().'")';

        mysqli_query($database->get_connection(), $sql);

        $database->close_connection();
        return $conversation;
    }
    function updateConversationTime($conversation)
    {
        $database = new Database();

        $sql = 'UPDATE `fbinbox_conversation` SET `updated_time`="'.$conversation->getUpdatedTime().'" WHERE id='.$conversation->getId();
        mysqli_query($database->get_connection(), $sql);

        $database->close_connection();
        return $conversation;
    }
}