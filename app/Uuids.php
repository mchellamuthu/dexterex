<?php
namespace App;

use Ramsey\Uuid\Uuid;

trait Uuids
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $uuid5 = Uuid::uuid4();
            $uuid =  $uuid5->toString();
            $model->{$model->getKeyName()} = $uuid;
        });
        static::saving(function ($model) {
            $uuid5 = Uuid::uuid4();
            $uuid =  $uuid5->toString();
            $model->{$model->getKeyName()} = $uuid;
        });
    }
}
