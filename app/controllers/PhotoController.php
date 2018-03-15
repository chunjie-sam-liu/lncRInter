<?php

class SearchController extends BaseController
{

    public function show()
    {


        Route::get('/photo', function () {

            $img = Image::canvas(240, 30, '#ccc');
            $txt = $_GET[''];
            $img->text($txt, 120, 10, function ($font) {
                $font->size(24);
                $font->color('#337ab7');
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            });
            return $img->response('jpg');
        });
    }
}