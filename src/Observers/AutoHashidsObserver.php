<?php
/**
 * Created by PhpStorm.
 * User: J
 * Date: 27/04/2017
 * Time: 10:48
 */

namespace Shalvah\AutoHashids\Observers;


use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class AutoHashidsObserver
{
    public function created (Model $model)
    {
        $column = property_exists($model, "hashidsColumn") ? $model->hashidsColumn : "uid";
        $connection = property_exists($model, "hashidsConnection") ? $model->hashidsConnection : "main";
        $encodings = property_exists($model, "hashidsEncodings") ? $model->hashidsEncodings : $model->getKey();

        $model->$column = Hashids::connection($connection)->encode($encodings);
        $model->save();
    }

}