<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;

class UserController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $search = $request->input('search','');
        
        // $data = DB::table('user')->paginate(5);

        $data = DB::table('user')->where('uname','like','%'.$search.'%')->paginate(5);
        
        
        return view('admin.user.index',['datas'=>$data,'search'=>$search]);

    }

    public function create()
    {
        // echo '添加用户';
        
        return view('admin.user.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        // 验证表单
        $this->validate($request,[
            'uname'=>'required|regex:/^.{1,24}$/',
            'upwd'=>'required|regex:/^\w{6,12}$/',
            'reupwd'=>'required|same:upwd',
        ],[
           'uname.required'=>'用户名不能为空', 
           'uname.regex'=>'用户格式错误', 
           'upwd.required'=>'密码不能为空', 
           'upwd.regex'=>'密码格式错误', 
           'reupwd.required'=>'确认密码必填', 
           'reupwd.same'=>'两次密码不一致', 
        ]);

        // 执行文件上传
        if($request->hasFile('uface')){
            $path = $request->file('uface')->store(date('Ymd'));
        } else {
            $path = '';
        }

        // 保存数据
        // Hash::make('plain-text')
        
        $data['uname'] = $request->input('uname','');
        $data['upwd'] = Hash::make($request->input('upwd'));
        $data['ctime'] = date('Y-m-d H:i:s',time());
        $data['uface'] = $path;
        $data['token'] = str_random(50);
        $data['status'] = 0;
        // dump($data);

        $res = DB::table('user')->insert($data);
        if($res) {
            return redirect('/admin/user/index')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
    }


    public function destory(Request $request)
    {
        $uid = $request->input('uid',0);

        $token = $request->input('token',0);
        
        $data_token = DB::table('user')->select('token')->where('uid',$uid)->first();

        if($data_token->token != $token){
            echo 'error';
        }

        // 删除
        $res = DB::table('user')->where('uid',$uid)->delete();
        if ($res) {
            echo 'ok';
        } else {
            echo 'error';
        }
        
    }


    public function edit($uid,$token)
    {
        // echo $token;
        $data = DB::table('user')->where('uid',$uid)->first();

        // 验证token
        if ($data->token != $token) {
            return back()->with('error','token验证失败');
        } 
        // dump($data);
        return view('admin.user.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'uname' => 'required|regex:/^.{1,24}$/',
            'email'=>'required|regex:/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/',
        ],[
            'uname.required'=>'用户名不能为空',
            'uname.regex'=>'用户名最多12位中文,24个字母或字符',
            'email.required'=>'邮箱不能为空',
            'email.regex'=>'邮箱格式错误',
        ]);

        // dump($request->all());
        $uface_path = $request->input('uface_path');

        $data = $request->only(['uname','uid','email']);
        if ($request->hasFile('uface')) {
            $path = $request->file('uface')->store(date('Ymd'));
            // 删除旧文件
            Storage::delete($uface_path);
        } else {
            $path = $uface_path;
        }

        $data['uface'] = $path;
        $data['status'] = 1;
        $data['token'] = str_random(50);
        $uid = $request->input('uid','');
        
        // dd($data);
        
        $res = DB::table('user')->where('uid',$uid)->update($data);

        if ($res) {
            // session('user_home')->uface = $data['uface'];
            // session('userInfo')->uface = $data['uface'];
            return redirect('/admin/user/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
        
    }

    // public function delete(Request $request)
    // {
    //     $uid = $request->input('uid',0);

    //     echo $uid;
    // }
    

    public function face(Request $request)
    {
        $this->validate($request, [
            'uface' => 'required',
        ],[
            'uface.required'=>'不能上传空文件',
        ]);

        $uid = $request->input('uid','');
        $uface_path = $request->input('uface_path','');

        if ($request->hasFile('uface')) {
            $path = $request->file('uface')->store(date('Ymd'));
            // 删除旧文件
            Storage::delete($uface_path);
        }

        // dd($request->all(),$path);
        $res = DB::table('user')->where('uid',$uid)->update(['uface'=>$path]);
        if ($res) {
            $data = DB::table('user')->where('uid',$uid)->first();
            session(['userInfo'=>$data]);
            return redirect('/admins')->with('success','头像修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }
}
