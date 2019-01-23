<?php

namespace SyncSDK\Response;

class ListResponse implements \Countable, \ArrayAccess
{
    /**
     * @var mixed
     */
    private $count;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @param array $body
     * @param $convertEntry
     * @return mixed
     */
    public function __construct(array $body, $convertEntry)
    {
        if (count($body) == 0) {
            $this->count = 0;
            $this->data  = [];
        } else {
            $this->data = array_map(
                function ($item) use ($convertEntry) {
                    return $convertEntry($item);
                }, $body['data']
            );
        }
    }

    public function count()
    {
        return count($this->data);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $offset
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        $data = $this->data;

        $array = [];
        foreach ($data as $key => $data) {
            $array[] = $data->attributes;
        }

        return $array;
    }
}
