<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        if (session('flag')) {
            return view('admin.index.index');
        } else {
            return view('admin.index.login');
        }
        
    }

    public function dologin(Request $request)
    {
        $uname = $request->input('uname');
        $upwd = $request->input('upwd');

        $data = DB::table('user')->where('uname',$uname)->first();

        if (empty($data)) {
            return back()->with('error','用户名或密码错误');
        }
        if ($data->type != 1) {
            return back()->with('error','用户权限不够');
        }
        if (Hash::check($upwd, $data->upwd)) {
            session(['flag' => 'true','userInfo'=>$data]);
            return redirect('/admins');
        } else {
            return back()->with('error','用户名或密码错误');
        }
    }

    public function logout(Request $request)
    {
        // dump($request->session()->all());
        session(['flag'=>'','userInfo'=>'']);
        // $request->session()->flush();
        // session('flag') = '';
        // session('userInfo') = '';

        // dd($request->session()->all());
        return redirect('/admins')->with('success','退出成功');
    }

    public function edit($uid,$token)
    {
        $data = DB::table('user')->where('uid',$uid)->first();

        if ($data->token != $token) {
            return back()->with('error','异常操作,请确定是本人在操作');
        }

        return view('admin.index.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'oldpwd'=>'required',
            'newpwd'=>'required|regex:/^\w{6,12}$/',
            'repwd'=>'required|same:newpwd',
        ],[
           'oldpwd.required'=>'密码不能为空', 
           'newpwd.required'=>'密码不能为空', 
           'newpwd.regex'=>'密码格式错误', 
           'repwd.required'=>'密码不能为空', 
           'repwd.same'=>'两次密码不一致', 
        ]);

        $uid = $request->input('uid');
        $oldpwd = $request->input('oldpwd');
        $newpwd = $request->input('newpwd');

        $datas = DB::table('user')->where('uid',$uid)->first();

        if (!Hash::check($oldpwd, $datas->upwd)) {
            return back()->with('error','原密码错误');
        }

        $data['token'] = str_random(50);

        $data['upwd'] = Hash::make($newpwd);

        $res = DB::table('user')->where('uid',$uid)->update($data);
        if ($res) {
            session(['flag'=>'','userInfo'=>'']);
            return redirect('/admins')->with('success','密码修改成功,请重新登录');
        } else {
            return back()->with('密码修改失败');
        }
        
    }

    
}
