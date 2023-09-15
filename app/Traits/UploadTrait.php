<?php 
namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait 
{ 
    private function imageUpload(Request $request, $imageColumn = null)
    {
        $images = $request->file('photos');

        $uploadedImages = [];

        foreach($images as $image) {
            if(!is_null($image)) {
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
             } else {
                $uploadedImages = $image;
             }
        }

        return $uploadedImages;
    }

}
