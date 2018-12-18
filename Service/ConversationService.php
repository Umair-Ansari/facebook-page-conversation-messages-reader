<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 6:05 PM
 */

require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Reposiroty\ConversationRepo.php";
require_once $_SERVER['DOCUMENT_ROOT']."\\reader\Entity\Conversation.php";
class ConversationService
{
    function isNewConversation($conversation){
        $conversationRepo = new ConversationRepo();
        $conversationResponse = $conversationRepo->getConversationByConversationId($conversation->getConversationId());
        if($conversationResponse != null && $conversationResponse->getId() != null){
            return false;
        }
        $conversationRepo->createConversation($conversation);
        return true;
    }

    function getConversationId($conversation){
        $conversationRepo = new ConversationRepo();
        $conversationResponse = $conversationRepo->getConversationByConversationId($conversation->getConversationId());
        return $conversationResponse->getId();
    }

    function getConversation($conversation){
        $conversationRepo = new ConversationRepo();
        return $conversationRepo->getConversationByConversationId($conversation->getConversationId());

    }

    function updateConversationTime($conversation){
        $conversationRepo = new ConversationRepo();
        return $conversationRepo->updateConversationTime($conversation);

    }
}