<?php

use Illuminate\Support\Str;

if (!function_exists('json_response')) {
    function json_response($data = null, $message = null, $code = 200)
    {
        $array = [
            'status' => in_array($code, success_response()) ? true : false,
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($array);
    }

    function success_response()
    {
        return [
            200,   //OK. The standard success code and default option.
            201,   //Object created. Useful for the store actions.
            202,   //The request has been accepted for processing, but the processing has not been completed.
            204,   //No content. When an action was executed successfully, but there is no content to return.
            206,    //Partial content. Useful when you have to return a paginated list of resources.
        ];
    }

    /************** another http request codes **************/
    /* *
    *  400: Bad request. The standard option for requests that fail to pass validation.
    *  401: Unauthorized. The user needs to be authenticated.
    *  403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    *  404: Not found. This will be returned automatically by Laravel when the resource is not found.
    *  405: Method Not Allowed.
    *  419: Authentication Timeout.
    *  422: Unprocessable Entity. validation failed.
    *  500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    *  503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    * */

}

if (!function_exists('str_limit')) {
    function str_limit(string $text = null, int $limit = 70)
    {
        return !empty($text) ? Str::limit($text, $limit) : null;
    }
}

if (!function_exists('status_value')) {
    function status_value($object)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();
        return $statusArray[$object->status];
    }
}

if (!function_exists('status_trans')) {
    function status_trans($object,$value)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();
        return $statusArray[$value];
    }
}


if (!function_exists('array_to_string')) {
    function array_to_string($array)
    {
        return implode(",", $array);
    }
}

if (!function_exists('user_id')) {
    function user_id()
    {
        return \Illuminate\Support\Facades\Auth::id() ?? null;
    }
}


if (!function_exists('is_create')) {
    function is_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? true : false;
    }
}


if (!function_exists('is_show')) {
    function is_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? true : false;
    }
}

if (!function_exists('is_edit')) {
    function is_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? true : false;
    }
}
//
//if (!function_exists('setting_value')) {
//    function setting_value($key)
//    {
//        $setting = \App\Models\Setting::get()->keyBy('key');
//        $value = null;
//        if (isset($setting[$key])) {
//            if (in_array($key, ['logo', 'fav_icon'])) {
//                if ($setting[$key]->value != null) {
//                    $value = asset('storage/settings/' . $setting[$key]->value);
//                } else {
//                    $value = asset('admin/img/logo.png');
//                }
//            } else {
//                $value = $setting[$key]->value;
//
//                if ($key == 'nexmo_key' && $setting[$key]->value == null) $value = 'c8cc7ddc';
//
//                if ($key == 'nexmo_api_secret' && $setting[$key]->value == null) $value = 'CX5s7KyzP6Kkpp7B ';
//
//                if ($key == 'default_message_from' && $setting[$key]->value == null) $value = 'ROQAY';
//
//                if ($key == 'default_mail_from' && $setting[$key]->value == null) $value = 'no-reply@sent.center';
//            }
//        }
//
//        return $value;
//    }
//}

function saveImage($file, $folder = '/')
{
    request()->files->remove('link');
    $extension = $file->extension();

    $fileName = time() . rand(10,99). '.'.$extension;
    $dest = public_path('/uploads/' . $folder);
    $file->move($dest, $fileName);

    $uploaded_file = 'uploads/' . $folder . '/' . $fileName;
    return $uploaded_file;
}

/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    return ($angle * $earthRadius) / 1000; //return in KM .
}
