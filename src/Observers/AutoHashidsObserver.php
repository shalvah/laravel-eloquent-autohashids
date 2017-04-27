<?php

namespace Shalvah\AutoHashids\Observers;


use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class AutoHashidsObserver
{
    public function created (Model $model)
    {
        $column = property_exists($model, "hashidsColumn") ? $model->hashidsColumn : "uid";
        $connection = property_exists($model, "hashidsConnection") ? $model->hashidsConnection : "main";
        $encodings = property_exists($model, "hashidsEncodings") ? $model->hashidsEncodings : [$model->getKey()];

        $hashConn = Hashids::connection($connection)
        $model->$column = call_user_func_array([$hashConn, "encode"], $encodings);

        $model->save();
    }

}