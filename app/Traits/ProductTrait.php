<?php

namespace App\Traits;

use App\Helpers\Classes\FileManage;
use Illuminate\Foundation\Http\FormRequest;

trait ProductTrait
{
    private function processData(FormRequest $request, $method = 'create')
    {
        $data['name'] = $request->name;
        $data['purchase_price'] = $request->purchase_price;
        $data['sell_price'] = $request->sell_price;
        $data['status'] = $request->status;
        if ($method == 'create'){
            $data['slug'] = slugGenerate($request->name,'products');
            $data['created_at'] = now();
        }else{
            $data ['updated_at'] = now();
        }
        return $data;
    }

    private function imageProcess($image, $data = null)
    {
        $path = null;
        if ($image) {
            if ($data && $data->image) {
                FileManage::fileDelete($data->image);
            }
            $path = FileManage::fileUpload($image, 'image/products');
        }

        return $path;
    }
}
