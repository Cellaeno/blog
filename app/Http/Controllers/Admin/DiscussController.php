<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DiscussController extends Controller
{
    //
    
    public static function getInfo($table,$id,$info)
    {
        $data = DB::table($table)->select($id,$info)->get();
        $datas = [];
        foreach ($data as $k => $v) {
            $datas[$v->$id] = $v->$info;
        }
        return $datas;
    }
    public function index()
    {

        $user_names = self::getInfo('user','uid','uname');
        $art_titles = self::getInfo('art','aid','title');

        $datas = DB::table('discuss')->orderBy('aid','asc')
                                    ->orderBy('ctime','desc')
                                    ->get();

        return view('admin.discuss.index',['datas'=>$datas,'user_names'=>$user_names,'art_titles'=>$art_titles]);
    }

    public function destory(Request $request)
    {
        // 删除
        
        $did = $request->input('did');
        // echo $did;
        $res = DB::table('discuss')->where('did',$did)->delete();

        if ($res) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
}
