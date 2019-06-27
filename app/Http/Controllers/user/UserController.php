<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use MongoDB\Client;
//use Monolog\Handler\Mongo;

class UserController extends Controller
{
    public function getUser()
    {
        //获取用户ip
        $user_ip=$_SERVER['REMOTE_ADDR'];
        //获取ua
        $user_ua=$_SERVER['HTTP_USER_AGENT'];
        //获取url
        $user_url=$_SERVER['REQUEST_URI'];
        $user_host=$_SERVER['HTTP_HOST'];
        //用户访问时间
        $time=time();
        $data=[
            'ua'=>$user_ua,
            'user_ip'=>$user_ip,
            'time'=>$time,
            'url'=>$user_host.$user_url
        ];
        //mysql库
        $res=DB::table('user_test')->insert($data);
        var_dump($res);echo "<br/>";
        //MongoDB库
        $m = new Client("mongodb://192.168.3.160:27017");
        $db=$m->test->user;
        $db->insertOne($data);
        $ca=$db->find();
        var_dump($ca);
    }
}
