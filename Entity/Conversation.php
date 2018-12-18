<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 5:50 PM
 */

class Conversation
{
    private $id;
    private $conversationId;
    private $updatedTime;
    private $pageId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * @param mixed $conversationId
     */
    public function setConversationId($conversationId)
    {
        $this->conversationId = $conversationId;
    }

    /**
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    /**
     * @param mixed $updatedTime
     */
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
    }

    /**
     * @return mixed
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param mixed $pageId
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }


    public function setRow($row){
        $this->id = $row["id"];
        $this->conversationId = $row["conversation_id"];
        $this->updatedTime = $row["updated_time"];
        $this->pageId = $row["page_id"];

    }
}