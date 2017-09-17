<?php

namespace App\Http\Controllers\Admin\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\AdminUser;
use Illuminate\Support\Facades\Cache;



/**
 * @author [dengjihua] <[<2563654031@qq.com>]>
 *
 * 后台管理员控制类，用于对管理员的增删改查
 */
class AdminList extends Controller
{
    /**
     * 显示管理员页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {

        $name = $request->input('name');
        


        // $userinfo = AdminUser::get();
        $userinfo = DB::table('admin_users')->where('name', 'like', '%'.$name.'%')->paginate(3);

        // dd($userinfo);
        return view('Admin/admin-list',['userinfo' => $userinfo, 'name' => $name]);
    }

    /**
     * 显示添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/admin-insert');
    }

    /**
     * 执行添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $bool = DB::table('admin_users')->insert([

            'uid' => $request->input('uid'),
            'pass' => $request->input('pass'),
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'power' => $request->input('power'),
            'address' => $request->input('address'),
            'status' => $request->input('status')
        ]);

        if ($bool) {
            return redirect('admin/adminlist')->with('msg', '添加成功');
        }

        return back()->with('errorTip', '添加失败');
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // var_dump($id);

        $user = DB::table('admin_users')->where('id', $id)->get()->toArray();

        // dd($user);
        return view('Admin/admin-add', ['user' => $user[0]]);
        // var_dump($_GET);
    }

    /**
     * 此方法用了修复管理员的状态：启用或禁用
     * 只能禁用管理员和超级管理员，老大无法被禁
     *
     * @param  int  $id
     * @return bool
     */
    public function edit($id)
    {

        
        $user = DB::table('admin_users')->where('id', $id)->first();

        // var_dump($user);


        if ($user->power == 2) {
            echo 66;
        }else{

            $bool = DB::table('admin_users')->where('id', $id)->update(['status' => $_GET['status'] ]);
            echo $bool;
        }

       
    }

    /**
     * 执行数据的修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $bool = DB::table('admin_users')->where('id', $id)
        ->update([
            'uid' => $request->input('uid'),
            'pass' => $request->input('pass'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'power' => $request->input('power')
        ]);

        if ($bool) {
            return redirect('admin/adminlist');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
