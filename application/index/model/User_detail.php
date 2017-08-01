<?php

namespace app\index\model;

use think\Model;

class User_detail extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('User');
    }
}
