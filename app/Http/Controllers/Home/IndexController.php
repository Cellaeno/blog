<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;

class IndexController extends Controller
{
    // 
    
    public static function getCates()
    {
        // 获取栏目
        $data_parent_cates = DB::table('cate')->where('pid',0)->get();
        $data = '';

        foreach ($data_parent_cates as $k => $v) {
            $data_child_cates = DB::table('cate')->where('pid',$v->cid)->get();
            $data_parent_cates[$k]->sub = $data_child_cates;
            $data = $data_parent_cates;
        }

        return $data;
    }

    public static function getCateName()
    {
        $cates = DB::table('cate')->select('cid','cname')->get();
        $datas = [];
        foreach ($cates as $k => $v) {
            $datas[$v->cid] = $v->cname;
        }
        return $datas;
    }

    // 特别推荐
    public static function special()
    {
        $data = DB::table('art')->orderBy('like','desc')
                                ->orderBy('view','desc')
                                ->orderBy('ctime','desc')
                                ->skip(0)->take(3)
                                ->get();
        return $data;
    }

    // 点击排行
    public static function getArtFirst($filed)
    {
        $data = DB::table('art')->orderBy($filed,'desc')
                                ->orderBy('ctime','desc')
                                ->skip(0)->take(1)
                                ->first();
        return $data;
    }

    public static function getArtThree($filed)
    {
        $data = DB::table('art')->orderBy($filed,'desc')
                                ->orderBy('ctime','desc')
                                ->skip(1)->take(4)
                                ->get();
        return $data;
    }

    public function index()
    {
        // 栏目信息
        $data_cates = self::getCates();

        $cate_names = self::getCateName();

        // 轮播图信息
        $data_banners = DB::table('banner')->where('status',1)->get();

        // 云标签信息
        $data_tags = DB::table('tag')->get();

        // 文章信息
        $data_arts = DB::table('art')->orderBy('ctime','desc')->skip(0)->take(10)->get();
        $top_arts = DB::table('art')->orderBy('like','desc')->skip(0)->take(2)->get();
        // dd($top_arts);
        
        return view('home.index.index',[
                'data_cates'=>$data_cates,'data_banners'=>$data_banners,
                'data_tags'=>$data_tags,'data_arts'=>$data_arts,
                'cate_names'=>self::getCateName(),'top_arts'=>$top_arts,
                'special_art'=>self::special(),'good_art'=>self::getArtFirst('like'),
                'good_arts'=>self::getArtThree('like'),'view_art'=>self::getArtFirst('view'),
                'view_arts'=>self::getArtThree('view')
            ]);
    }

    // 修改个人信息
    public function edit($uid,$token)
    {
        $data = DB::table('user')->where('uid',$uid)->first();
        if ($token != $data->token) {
            return back()->with('error','token验证失败');
        }

        return view('home.index.edit',['data'=>$data]);
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

        $uface_path = $request->input('uface_path','');
        $uid = $request->input('uid','');

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

        // dd($data);
        
        $res = DB::table('user')->where('uid',$uid)->update($data);

        if ($res) {
            $data = DB::table('user')->where('uid',$uid)->first();
            session(['user_home'=>$data]);
            return redirect('/')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }

    }

    
}
