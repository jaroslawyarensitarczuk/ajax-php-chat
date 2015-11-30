<?php
namespace Yaren\Core;

class JsonDecoder {
    public function decodeJsonFile($file) {
        try {
            if(!file_exists($file)) {
                throw new \Exception("JSON Decoder: Plik nie istnieje!");
            } else {
                $fileContent = file_get_contents($file);
                return json_decode($fileContent);
            }
        } catch(\Exception $error) {
            echo $error->getMessage();
        }
    }
}