<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TagController extends Controller
{
    //
    
    public function index()
    {

        $datas = DB::table('tag')->get();

        return view('admin.tag.index',['datas'=>$datas]);
    }


    public function create(Request $request)
    {

        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tname'=>'required',
        ],[
           'tname.required'=>'标签名不能为空', 
        ]);

        $data = $request->except('_token');

        $res = DB::table('tag')->insert($data);
        if($res) {
            return redirect('/admin/tag/index')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }

    }

    public function edit($tid)
    {

        $data = DB::table('tag')->where('tid',$tid)->first();

        return view('admin.tag.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'tname'=>'required',
        ],[
           'tname.required'=>'云标签名不能为空', 
        ]);

        $tid = $request->input('tid','');

        $data = $request->except('_token','tid');

        // dd($data);

        $res = DB::table('tag')->where('tid',$tid)->update($data);
        if($res) {
            return redirect('/admin/tag/index')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    public function destory(Request $request)
    {
        $tid = $request->input('tid','');

        $res = DB::table('tag')->where('tid',$tid)->delete();

        if($res) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
}
