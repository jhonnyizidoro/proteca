<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Storage;

class FileController extends Controller
{

	private static $uploadDisk = 'public_folder';
	private static $baseUploadDirectory = '/' . 'uploads' . '/';

    /**
     * Faz o upload de um arquivo
     * @param uploadedFile arquivo da requisição
     * @param String o segundo parâmetro é a pasta que o arquivo vai ficar, por default é images, pois é o mais usado
     * @return String localização do arquivo na pasta public do servidor
     */
    public static function uploadFile($file, String $subDirectory = 'images')
    {
        $name = self::sanitizeFileName($file->getClientOriginalName());
        $name = self::$baseUploadDirectory."{$subDirectory}/".date("Y-m-d_H-i-s_").$name;
        $file = File::get($file);
        Storage::disk(self::$uploadDisk)->put($name, $file);
        return $name;
    }


    /**
     * Faz o upload de um arquivo via requisição AJAX
     * @param Request com um arquivo
     * @return JSON retorn uma json com a lotation do arquivo ['location' => 'path']
     */
    public static function tinymceUploader(Request $request)
    {
        $image = $request->file;
		$name = self::sanitizeFileName($image->getClientOriginalName());
		$name = self::$baseUploadDirectory."images/".date("Y-m-d_H-i-s_").$name;
        $image = File::get($image);
        Storage::disk(self::$uploadDisk)->put($name, $image);
        return response()->json(['location' => $name]);
    }

    /**
     * Converte o nome do arquivo arquivo para um nome sem caracteres especiais e espaços
     * @param String nome do arquivo com extensão
     * @return String nome do arquivo com extensão
     */
    public static function sanitizeFileName(String $filename)
    {
        //Separar o nome e a extensão do arquivo
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $array = explode('.', $filename);
        $extension = end($array);
        //Modificar o nome do arquivo para tirar caracteres especiais
        $name = preg_replace('~[^\pL\d]+~u', '-', $name);
        $name = iconv('utf-8', 'us-ascii//TRANSLIT', $name);
        $name = preg_replace('~[^-\w]+~', '', $name);
        $name = trim($name, '-');
        $name = preg_replace('~-+~', '-', $name);
        $name = strtolower($name);
        if (empty($name)) {
            $name = 'n-a';
        }
        return $name.'.'.$extension;
    }

    /**
     * Converte uma string em um formato que seja uma URL válida
     * @param String texto original
     * @return String text convertido
     */
    public static function slugify(String $text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        return $text;
    }

    /**
     * Gera uma string aleatória com os carecteres setados
     * @param int recebe o tamanho da String, por default é 8
     * @return String retorn a string gerada
     */
    public static function generateString($length = 8) 
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

    

}
