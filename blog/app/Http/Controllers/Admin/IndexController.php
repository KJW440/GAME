<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\AdminUser;

/**
 * 后台首页控制类
 * @author rong <[<871513137@qq.com>]>
 *
 */
class IndexController extends Controller
{
    public function welCome()
    {
        return view('Admin/welcome');
    }


    
}
