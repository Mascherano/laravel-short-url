<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UrlManagerController;
use App\Models\ShortUrl;

class ShortUrlController extends Controller
{

    public function __construct()
    {
        $this->urlManager = new UrlManagerController();
    }

    //validar envío de url
    //validar veracidad de la url
    //validar que es unica en la bd
    //generar short code y validar que no exista en la bd
    //insertar url y short code en bd
    //devolver url corta

    public function generateCode(Request $request)
    {
        if(empty($request->url)){
            return redirect()->back()->with('error', 'No has proporcionado una url.');
        }
        
        if($this->urlManager->isValidUrl($request->url) == false){
            return redirect()->back()->with('error', 'La url no tiene un formato válido.');
        }

        if($this->urlManager->urlExists($request->url)){
            return redirect()->back()->with('error', 'La url proporcionada ya existe en nuestros registros');
        }

        $shortcode = $this->urlManager->getShortUrl();
        $existscode = $this->urlManager->codeExists($shortcode);

        if(!$existscode){

            if($this->urlManager->saveInShortUrl($request->url, $shortcode)){

                $shortUrl = url('') . '/' . $shortcode;
    
            }

        }else{

            $shortUrl = url('') . '/' . $existscode->shortcode;
            
        }

        return redirect()->back()->with('success', 'url corta generada: ' . $shortUrl);

        
    }

    //validar envío de código
    //validar tamaño de código
    //validar su existencia en la bd, si existe devolver url larga, si no existe retornar mensaje informando.

    public function getUrl(Request $request)
    {
        if(empty($request->code)){
            return redirect()->back()->with('error', 'No has proporcionado una url corta.');
        }

        if($this->urlManager->isValidUrl($request->code) == false){
            return redirect()->back()->with('error', 'La url no tiene un formato válido.');
        }

        $code = $this->urlManager->getSize($request->code);

        if($code == false){
            return redirect()->back()->with('error', 'El tamaño del código no corresponde, vuelve a intentarlo');
        }

        $existscode = $this->urlManager->codeExists($code);

        if($existscode){
            return redirect()->back()->with('success', 'url: ' . $existscode->url);
        }else{
            return redirect()->back()->with('error', 'La url proporcionada no existe en nuestros registros.');
        }

    }

    public function redirectToUrl(Request $request)
    {
        if(empty($request->shortUrl)){
            return redirect()->back()->with('error', 'No has proporcionado una url corta.');
        }

        if($this->urlManager->isValidUrl(url()->current()) == false){
            return redirect()->back()->with('error', 'La url no tiene un formato válido.');
        }

        $code = $this->urlManager->getSize($request->shortUrl);

        if($code == false){
            return redirect()->back()->with('error', 'El tamaño del código no corresponde, vuelve a intentarlo');
        }

        $existscode = $this->urlManager->codeExists($code);

        if($existscode){
            return redirect($existscode->url);
        }else{
            return redirect()->back()->with('error', 'La url proporcionada no existe en nuestros registros.');
        }
    }

    public function deleteUrl(ShortUrl $ShortUrl)
    {

        $ShortUrl->delete();

        return redirect()->back()->with('success', 'La url ha sido eliminada exitosamente.');
    }

}
