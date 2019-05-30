<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use DB;

class BannerController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        $datas = DB::table('banner')->where('title','like','%'.$search.'%')
                                    // ->orWhre('desc','like','%'.$search.'%')
                                    ->get();
        return view('admin.banner.index',['datas'=>$datas]);
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
            'url' => 'required',
        ],[
            'title.required'=>'标题不能为空',
            'desc.required'=>'描述不能为空',
            'url.required'=>'请选择图片',
        ]);

        if($request->hasFile('url')) {
            $path = $request->file('url')->store(date('Ymd'));
        } else {
            return back();
        }

        $data['title'] = $request->input('title','');
        $data['desc'] = $request->input('desc','');
        $data['status'] = $request->input('status','');
        $data['url'] = $path;
        // dd($data);
        
        $res = DB::table('banner')->insert($data);
        if ($res) {
            return redirect('/admin/banner/index')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
        
        
    }

    public function schange(Request $request)
    {
        $data['status'] = $request->input('status','');
        $bid = $request->input('bid','');

        // dd($bid,$status);
        
        $res = DB::table('banner')->where('bid',$bid)->update($data);

        if ($res) {
            return redirect('/admin/banner/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
        

    }

    public function destory(Request $request)
    {
        $bid = $request->input('bid');

        // echo $bid;
        
        $res = DB::table('banner')->where('bid',$bid)->delete();
        if ($res) {
            echo 'ok';
        } else {
            echo 'error';
        }
        
    }

    public function edit($bid)
    {
        $datas = DB::table('banner')->where('bid',$bid)->first();

        return view('admin.banner.edit',['datas'=>$datas]);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
        ],[
            'title.required'=>'标题不能为空',
            'desc.required'=>'描述不能为空',
        ]);

        $bid = $request->input('bid');
        $url_path = $request->input('url_path');
        // dd($url_path);

        if($request->hasFile('url')) {
            $path = $request->file('url')->store(date('Ymd'));
            Storage::delete($url_path);

        } else {
            $path = $url_path;
        }

        $data['url'] = $path;
        $data['title'] = $request->input('title');
        $data['desc'] = $request->input('desc');
        $data['status'] = $request->input('status');

        // dd($data);
        $res = DB::table('banner')->where('bid',$bid)->update($data);
        if ($res) {
            return redirect('/admin/banner/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
        

    }
}
