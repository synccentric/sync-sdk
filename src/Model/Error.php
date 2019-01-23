<?php

namespace SyncSDK\Model;

class Error
{
    /**
     * @var mixed
     */
    private $detail;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var mixed
     */
    private $title;

    /**
     * @param array $error
     */
    public function __construct(array $error)
    {
        $this->id    = $error['id'];
        $this->title = $error['title'];

        if (isset($error['detail'])) {
            $this->detail = $error['detail'];
        }
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}
