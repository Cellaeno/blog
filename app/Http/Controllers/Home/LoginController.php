<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Captcha;
use DB;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('home.login.index');
    }

    public function dologin(Request $request)
    {
        $this->validate($request,[
            'uname'=>'required',
            'upwd'=>'required',
        ],[
           'uname.required'=>'用户名不能为空', 
           'upwd.required'=>'密码不能为空', 
        ]);

        // 验证码
        if($request->captcha){
            $this->validate($request, [
                'code' => 'required|captcha',
            ]);
        }

        if(!Captcha::check($request->input('code'))){
            return back()->with('error','验证码错误');
        }

        $uname = $request->input('uname');
        $upwd = $request->input('upwd');

        $data = DB::table('user')->where('uname',$uname)->first();

        if (empty($data)) {
            return back()->with('error','用户名或密码错误');
        }
        if (Hash::check($upwd, $data->upwd)) {
            session(['flag_home' => 'true','user_home'=>$data]);
            return redirect('/');
        } else {
            return back()->with('error','用户名或密码错误');
        }
    }

    public function logout()
    {
        session(['flag_home'=>'','user_home'=>'']);
        echo 'ok';
        // return redirect('');
    }

    public function store(Request $request)
    {
        $upwd = $request->input('upwd');
        $uname = $request->input('uname');
        // echo $upwd;
        $data_uname = DB::table('user')->where('uname',$uname)->select('uname')->first();
        // echo $uname;
        
        if($data_uname) {
            echo json_encode(['res'=>'error_name','info'=>'用户名已存在']);
            exit;
        }

        // dump($request->all());
        // 验证码
        if($request->captcha){
            $this->validate($request, [
                'code' => 'required|captcha',
            ]);
        }

        if(!Captcha::check($request->input('code'))){
            echo json_encode(['res'=>'error','info'=>'验证码错误']);
            exit;
        }

        $data['uname'] = $uname;
        $data['upwd'] = Hash::make($upwd);
        $data['token'] = str_random(50);
        $data['ctime'] = date('Y-m-d H:i:s',time());
        $data['status'] = 1;


        $res = DB::table('user')->insert($data);
        if($res) {
            echo json_encode(['res'=>'success','info'=>'注册成功']);
        } else {
            echo json_encode(['res'=>'error','info'=>'注册失败,再试一次吧']);
        }
    }
}