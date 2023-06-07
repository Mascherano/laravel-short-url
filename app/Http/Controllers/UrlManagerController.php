<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ShortUrl;

class UrlManagerController extends Controller
{
    public const NEW_URL_LENGTH = 8;
    public const RANDOM_BYTES = 40;

    //Función que valida formato de url
    public function isValidUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /*
        Genero cadena de 40 bytes aleatorios
        Genero un hash sha256
        trunco la cadena generada en la cantidad de caracteres especificado en NEW_URL_LENGTH
    */

    public function getShortUrl()
    {
        //$hashmake = Hash::make(random_bytes(self::RANDOM_BYTES));
        //$hashadler = hash('adler32', random_bytes(self::RANDOM_BYTES));

        $hash = substr(hash('sha256', random_bytes(self::RANDOM_BYTES)), 0, self::NEW_URL_LENGTH);
        return $hash;
    }

    //Funcion para revisar tamaño de código generado para la url corta
    public function getSize($url)
    {
        $code = explode("/", $url);
        $size = strlen(end($code));
        
        return ($size != self::NEW_URL_LENGTH) ? false : end($code);
        
    }

    //Función que revisa si la url ya existe en base de datos
    public function urlExists($url)
    {
        return ShortUrl::select('id')->where('url', $url)->first();
    }

    //Función que revisa si ya existe código corto generado
    public function codeExists($code)
    {
        return ShortUrl::select(['id', 'url', 'shortcode'])->where('shortcode', $code)->first();
    }

    //Función para guardar en bd url original y url corta generada
    public function saveInShortUrl($url = null, $code = null)
    {
        $shortUrl = new ShortUrl;

        $shortUrl->url          = $url;
        $shortUrl->shortcode    = $code;

        return $shortUrl->save();
    }
}
