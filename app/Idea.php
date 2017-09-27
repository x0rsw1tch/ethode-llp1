<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public static function fullList() {
        return static::get();
    }
    
    public static function listByOffset($offset) {
        return static::offset($offset)->limit(25)->get();
    }

    public static function ideaCount() {
        return static::count();
    }
}
