<?php
/**
 * Created by Umair Ansari
 * Date: 12/16/2018
 * Time: 5:50 PM
 */

class Page
{
    private $id;
    private $page_id;
    private $page_name;
    private $access_token;
    private $updated_time;

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
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * @param mixed $page_id
     */
    public function setPageId($page_id)
    {
        $this->page_id = $page_id;
    }

    /**
     * @return mixed
     */
    public function getPageName()
    {
        return $this->page_name;
    }

    /**
     * @param mixed $page_name
     */
    public function setPageName($page_name)
    {
        $this->page_name = $page_name;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    public function setRow($row){

        $this->id = $row["id"];
        $this->page_id = $row["page_id"];
        $this->page_name = $row["page_name"];
        $this->access_token = $row["access_token"];
        $this->updated_time = $row["updated_time"];
    }

    /**
     * @return mixed
     */
    public function getUpdatedTime()
    {
        return $this->updated_time;
    }

    /**
     * @param mixed $updated_time
     */
    public function setUpdatedTime($updated_time)
    {
        $this->updated_time = $updated_time;
    }




}