<?php

namespace SyncSDK\Model;

class Error
{
    private $id;

    private $title;

    private $detail;

    public function __construct(array $error) {
        $this->id = $error['id'];
        $this->title = $error['title'];

        if (isset($error['detail'])) {
            $this->detail = $error['detail'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDetail() {
        return $this->detail;
    }
}