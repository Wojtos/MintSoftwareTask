<?php


namespace App\JsonFile;


class JsonFileReader
{
    private string $filename;

    /**
     * JsonFileReader constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function read(): array {
        $jsonString = file_get_contents($this->filename);
        return json_decode($jsonString);
    }

}