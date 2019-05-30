<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use \App\Helper;

class existpointname implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //$value(=$pointname)を引数にジオコーディングを呼び出し
        $giocordingStatus = Helper::getLatLng("AIzaSyATubpo-Sq-u-uWRaIZn7gv84_lwCNzRK8", $value);
        
        //ジオコーディングのstatus="OK"でなければバリデーションNG
        return $giocordingStatus === "OK";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '入力した地名の住所情報が取得できませんでした。正しい地名を再入力するか、住所を入力してください。';
    }
}
