<?php

namespace Live\Collection;

abstract class DataExpiration implements CollectionInterface{
     /**
     * Collection data
     *
     * @var array
     */
    protected $data;

    /**
     * Collection dataExpiration
     *
     * @var array
     */
    private $dataExpiration;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
        $this->dataExpiration = [];
    }

     /**
     * {@inheritDoc}
     */
    public function set(string $index, $value, $expirer = .5)
    {
        $this->data[$index] = $value;
        $this->dataExpiration[$index] = microtime(true) + $expirer;
    }

    /**
     * {@inheritDoc}
    */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }

        if ($this->dataExpiration[$index] >= microtime(true)) {
            return $this->data[$index];
        }
    }
}