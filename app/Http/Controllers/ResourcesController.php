<?php

namespace App\Http\Controllers;

use App\Models\ResponseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    protected $responseModel;

    function __construct()
    {
        $this->responseModel = (new ResponseModel());
    }

    public function prefectures($language, $output)
    {
        $data = [];
        $responseMessage = __('resources.API200');
        $isValid = false;

        if (in_array($language, ['en', 'jp']) && in_array($output, ['all', 'region', 'prefecture'])) {
            $isValid = true;
            foreach (json_decode(file_get_contents(storage_path() . config('filename.PREFECTURES')), true) as $key => $value) {
                if($output=='region'){
                    $data[] = $key;
                }else{
                    foreach ($value as $valuePre) {
                        switch ($output) {
                            case 'all':
                                $data[] = [$key => $valuePre[$language]];
                                break;
                            case 'prefecture':
                                $data[] = $valuePre[$language];
                                break;
                            default:
                                break;
                        }
                    }
                }
            }
        } else {
            $responseMessage = __('resources.API400');
        }

        return $this->responseModel->sendJSON(($isValid) ? ((count($data) > 0) ? 200 : 204) : 400, $responseMessage, $data);
    }
}
