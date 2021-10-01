<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection
 */
class FileCollection extends DataExpiration
{
        /**
     * FileCollection filePath
     *
     * @var string
     */
    private $filePath;

    /**
     * Constructor
     */
    public function __construct($file = "")
    {
        parent::__construct();
        
        if ($file && file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $k => $v) {
                $k++;
                //$this->data["index{$k}"] = $v;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = [];
    }
}
