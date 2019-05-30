<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CateController extends Controller
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
        $search = $request->input('search','');

        // $data = DB::select('select *,concat(pid,",",path) as paths from cate order by paths');
        $data = DB::table('cate')->select('*',DB::raw('concat(path,",",cid) as paths'))
                                 ->where('cname','like','%'.$search.'%')
                                 ->orderBy('paths')->get();
        


        return view('admin.cate.index',['datas'=>self::getCates($data),'search'=>$search]);
    }


    public function create(Request $request)
    {
        $cid = $request->input('cid','');

        $datas = DB::table('cate')->select('*',DB::raw('concat(path,",",cid) as paths'))->orderBy('paths')->get();

        return view('admin.cate.create',['datas'=>self::getCates($datas),'cid'=>$cid]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'cname'=>'required',
        ],[
            'cname.required'=>'栏目名不能为空',
        ]);

        $pid = $request->input('pid');

        if ($pid == 0) {
            $path = 0;
        } else {
            $parent_data = DB::table('cate')->where('cid',$pid)->first();
            // dd($parent_data);
            $path = $parent_data->path.','.$parent_data->cid;
        }

        $data['cname'] = $request->input('cname','');
        $data['pid'] = $request->input('pid','');
        $data['path'] = $path;

        $res = DB::table('cate')->insert($data);

        if ($res) {
            return redirect('/admin/cate/index')->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
        }
        
    }

    public function edit($cid)
    {
        $data = DB::table('cate')->where('cid',$cid)->first();
        // dd($data);
        $data_all = DB::table('cate')->select('*',DB::raw('concat(path,",",cid) as paths'))
                                 ->orderBy('paths')->get();
        return view('admin.cate.edit',['data'=>$data,'data_all'=>self::getCates($data_all)]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'cname'=>'required',
        ],[
            'cname.required'=>'栏目名不能为空',
        ]);

        $cid = $request->input('cid','');
        $pid = $request->input('pid','');

        $data['cname'] = $request->input('cname','');
        $data['pid'] = $pid;
        if ($pid == 0) {
            $path = 0;
        } else {
            $parent_data = DB::table('cate')->where('cid',$pid)->first();
            // dd($parent_data);
            $path = $parent_data->path.','.$parent_data->cid;
        }
        $data['path'] = $path;

        $res = DB::table('cate')->where('cid',$cid)->update($data);
    }

}
