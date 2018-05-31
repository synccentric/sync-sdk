<?php

namespace SyncSDK\Response;

class ListResponse implements \Countable, \ArrayAccess
{
	private $count;
    private $data;

    public function __construct(array $body, $convertEntry) {
        if (count($body) == 0) {
            $this->count = 0;
            $this->data = array();
        } else {
            $this->data = array_map(function ($item) use ($convertEntry) {
                return $convertEntry($item);
            }, $body['data']);
        }
    }

    public function getCount() {
        return $this->count;
    }

    public function getData() {
        return $this->data;
    }

    public function toArray() {
        $data = $this->data;

        $array = [];
        foreach($data as $key => $data)
        {
            $array[] = $data->attributes;
        }

        return $array;
    }

    public function count() {
        return count($this->data);
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
}