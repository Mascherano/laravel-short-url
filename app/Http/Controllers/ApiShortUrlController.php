<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiLongUrlManagerRequest;
use App\Http\Requests\ApiShortUrlManagerRequest;
use App\Http\Controllers\UrlManagerController;

class ApiShortUrlController extends Controller
{

    public function __construct()
    {
        $this->urlManager = new UrlManagerController();
    }

    public function generateCode(ApiLongUrlManagerRequest $request)
    {

        $shortcode = $this->urlManager->getShortUrl();
        $existscode = $this->urlManager->codeExists($shortcode);

        if(!$existscode){

            if($this->urlManager->saveInShortUrl($request->url, $shortcode)){

                $shortUrl = url('') . '/' . $shortcode;
    
            }else{

                return response()->json([
                    'res'   => false,
                    'msg'   => 'No hemos logrado generar la url corta, por favor vuelve a intenarlo.'
                ], 500);

            }

        }else{

            $shortUrl = url('') . '/' . $existscode->shortcode;
            
        }

        return response()->json([
            'res'   => true,
            'msg'   => 'url corta generada: ' . $shortUrl
        ], 200);

    }

    public function getUrl(ApiShortUrlManagerRequest $request)
    {

        $code = $this->urlManager->getSize($request->url);

        if($code == false){
            return response()->json([
                'res'   => false,
                'msg'   => 'El tamaño del código no corresponde, vuelve a intentarlo'
            ], 400);
        }

        $existscode = $this->urlManager->codeExists($code);

        if($existscode){

            return response()->json([
                'res'   => true,
                'msg'   => 'url: ' . $existscode->url
            ], 200);
        
        }else{

            return response()->json([
                'res'   => false,
                'msg'   => 'La url proporcionada no existe en nuestros registros.'
            ], 400);
            
        }

    }

    public function deleteUrl(ApiShortUrlManagerRequest $request)
    {

        $code = $this->urlManager->getSize($request->url);

        if($code == false){
            return response()->json([
                'res'   => false,
                'msg'   => 'El tamaño del código no corresponde, vuelve a intentarlo'
            ], 400);
        }

        $existscode = $this->urlManager->codeExists($code);
        
        if($existscode){

           $existscode->delete();

            return response()->json([
                'res'   => true,
                'msg'   => 'url eliminada exitosamente.'
            ], 200);
        
        }else{

            return response()->json([
                'res'   => false,
                'msg'   => 'La url proporcionada no existe en nuestros registros.'
            ], 400);
            
        }
    }
}
