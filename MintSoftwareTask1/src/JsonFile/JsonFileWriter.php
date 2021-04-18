<?php


namespace App\JsonFile;


class JsonFileWriter
{
    private string $filename;

    /**
     * JsonFileWriter constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function write(array $jsonString): void {
        file_put_contents($this->filename, json_encode($jsonString));
    }

}