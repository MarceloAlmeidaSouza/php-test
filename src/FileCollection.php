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
        $this->filePath = $file;
        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $k => $v) {
                $k++;
                $this->set("index{$k}", $v);
            }
        }
    }

    /**
     * FileCollection writeDataToFile
     */
    public function writeDataToFile():bool
    {
        if (is_writable($this->filePath)) {
            return file_put_contents($this->filePath, implode("\n", $this->data)."\n", FILE_APPEND);
        }
        return false;
    }
}
