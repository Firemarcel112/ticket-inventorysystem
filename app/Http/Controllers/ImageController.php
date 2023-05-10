<?php

namespace App\Http\Controllers;

use Exception;
use League\Flysystem\Config;
use Symfony\Component\Mime\Exception\InvalidArgumentException;

class ImageController extends Controller
{

    /**
     * @param $image -- Inputfield from Image
     * @param $folderPath -- Path to folder if you want
     * @param $allowedSize -- Type your allowed imageSize in MB
     * @param int $i -- change it if you want different imagenames
     * @return bool|string
     * @throws Exception
     */
    public function create($image, $folderPath, $allowedSize, int $i = 1): bool|string
    {
        $imageName = $i . date("Ymdhmis") . $image->getClientOriginalName();
        $imageName = str_replace(array('(', ')'), '', $imageName);
        $imageSize = $image->getSize();
        try {
            $imageMimeTyp = $image->getMimeType();
        } catch (InvalidArgumentException) {
            throw new Exception("Bilddatei beschädigt");
        }
        $checkSize = $allowedSize * 1048578; // Value in bytes 1048576 == 1mb


        if (!in_array($imageMimeTyp, ConfigController::ALLOWEDEXTENSIONS)) {
            $allowTyp = implode(ConfigController::ALLOWEDEXTENSIONS);
            $allowTyp = str_replace(['image/', 'application/'], " ", "$allowTyp");

            throw new Exception("Das Bildformat wird nicht unterstützt! Erlaubte Formate:$allowTyp");
        }

        if ($imageSize > $checkSize) {
            throw new Exception("Es werden nur Bilder bis zu {$allowedSize} MB unterstützt");
        }
        $image->move(public_path($folderPath), $imageName);

        if ($image->getError() == 0) {
            return $folderPath . "/" . $imageName;
        }

        return false;
    }

    public function validateImage($image, $folderPath, $allowedSize, int $i = 1) {
        $imageName = $i . date("Ymdhmis") . $image->getClientOriginalName();
        $imageSize = $image->getSize();
        try {
            $imageMimeTyp = $image->getMimeType();
        } catch (InvalidArgumentException) {
            throw new Exception("Bilddatei beschädigt");
        }
        $checkSize = $allowedSize * 1048578; // Value in bytes 1048576 == 1mb

        if (!in_array($imageMimeTyp, ConfigController::ALLOWEDEXTENSIONS)) {
            $allowTyp = implode(ConfigController::ALLOWEDEXTENSIONS);
            $allowTyp = str_replace(['image/', 'application/'], " ", "$allowTyp");

            throw new Exception("Das Bildformat wird nicht unterstützt! Erlaubte Formate: $allowTyp");
        }

        if ($imageSize > $checkSize) {
            throw new Exception("Es werden nur Bilder bis zu $allowedSize MB unterstützt");
        }
    }

    public function delete($image)
    {
        $check = explode("/", $image)[0];
        if(!in_array($check, ConfigController::SECUREPATHS) && file_exists($image) ) {
            unlink($image);
        }
    }


}
