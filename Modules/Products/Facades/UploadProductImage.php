<?php

namespace Modules\Products\Facades;

use Illuminate\Support\Facades\Facade;
use Intervention\Image\Facades\Image;

class UploadProductImage extends Facade
{
    const MAXIMUM_FILE_SIZE = 2000000;

    const WIDTH_SIZE = 400;

    const HEIGHT_SIZE = 400;

    /**
     * @param $image
     * @return string
     */
    public static function handleUpload($image)
    {
        $input['imagename'] = uniqid() . '-' .time().'.'.$image->extension();

        $filePath = public_path('product/media');
        if (!file_exists(public_path('product'))) {
            mkdir($filePath, 0777, true);
        }
        $img = Image::make($image->path());

        if ($img->filesize() >= self::MAXIMUM_FILE_SIZE) {
            $img->resize(self::WIDTH_SIZE, self::HEIGHT_SIZE);
        }

        $img->save($filePath.'/'.$input['imagename']);

        return $input['imagename'];
    }
}
