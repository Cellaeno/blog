<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;

class ArtController extends Controller
{
    //
    
    public function getCates($data)
    {
        foreach ($data as $k => $v) {
            if ($v->pid != 0) {
                $data[$k]-> cname = 'I-----'.$v->cname; 
            }
        }
        return $data;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $datas = DB::table('art')->where('title','like','%'.$search.'%')
                                 ->orWhere('content','like','%'.$search.'%')
                                 ->orWhere('desc','like','%'.$search.'%')
                                 ->paginate(5);
        return view('admin.art.index',['datas'=>$datas,'search'=>$search]);
    }

    public function create()
    {
        // 获取栏目信息
        $data_cates = DB::table('cate')->select('*',DB::raw('concat(path,",",cid) as paths'))
                                 ->orderBy('paths')->get();
        // 获取云标签信息
        $data_tags = DB::table('tag')->get();

        return view('admin.art.create',['data_cates'=>self::getCates($data_cates),'data_tags'=>$data_tags]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'auth'=>'required',
            'content'=>'required',
            'desc'=>'required',
        ],[
           'title.required'=>'标题不能为空', 
           'auth.required'=>'作者不能为空', 
           'content.required'=>'内容不能为空', 
           'desc.required'=>'描述不能为空', 
        ]);
        

        $data = $request->except('_token','thumb','tid','cid');
        $data['tid'] = $request->input('tid','');
        $data['cid'] = $request->input('cid','');

        $data['ctime'] = date('Y-m-d H:i:s',time());

        if($request->hasFile('thumb')) {
            $path = $request->file('thumb')->store(date('Ymd'));
        } else {
            $path = '';
        }

        $data['thumb'] = $path;

        // dd($data);

        $res = DB::table('art')->insert($data);
        if($res) {
            return redirect('/admin/art/index')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }

    }

    public function edit($aid)
    {
        $data = DB::table('art')->where('aid',$aid)->first();

        // 获取栏目信息
        $data_cates = DB::table('cate')->select('*',DB::raw('concat(path,",",cid) as paths'))
                                 ->orderBy('paths')->get();
        // 获取云标签信息
        $data_tags = DB::table('tag')->get();

        return view('admin.art.edit',['data'=>$data,'data_cates'=>$data_cates,'data_tags'=>$data_tags]);
        
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'auth'=>'required',
            'content'=>'required',
            'desc'=>'required',
        ],[
           'title.required'=>'标题不能为空', 
           'auth.required'=>'作者不能为空', 
           'content.required'=>'内容不能为空', 
           'desc.required'=>'描述不能为空', 
        ]);

        $thumb_path = $request->input('thumb_path');
        
        // dump($request->all());

        // dd($request->hasFile('thumb'));

        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->store(date('Ymd'));
            Storage::delete($thumb_path);
        } else {
            $path = $thumb_path;
        }



        $aid = $request->input('aid');
        $data = $request->except(['_token','thumb','thumb_path','aid']);
        $data['thumb'] = $path;

        // dd($data);
        $res = DB::table('art')->where('aid',$aid)->update($data);

        if ($res) {
            return redirect('/admin/art/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }

    }

    public function destory(Request $request)
    {
        $aid = $request->input('aid');
        $res = DB::table('art')->where('aid',$aid)->delete();

        if ($res) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
