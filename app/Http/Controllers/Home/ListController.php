<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ListController extends Controller
{

    public static function getTagName()
    {
        $tags = DB::table('tag')->select('tid','tname')->get();
        $datas = [];
        foreach ($tags as $k => $v) {
            $datas[$v->tid] = $v->tname;
        }
        return $datas;
    }

    public function index(Request $request)
    {
        // 栏目id
        $cid = $request->input('cid','');
        // 云标签id
        $tid = $request->input('tid','');

        $search = $request->input('search','');

        // dd($search);

        // 栏目信息
        $data_cates = IndexController::getCates();
        $cate_names = IndexController::getCateName();

        // 云标签信息
        $data_tags = DB::table('tag')->get();
        $tag_names = self::getTagName();

        // 侧边栏
        $special_art = IndexController::special();
        $good_art = IndexController::getArtFirst('like');
        $good_arts = IndexController::getArtThree('like');
        $view_art = IndexController::getArtFirst('view');
        $view_arts = IndexController::getArtThree('view');

        if (!empty($cid)) {

            // 获取文章信息
            
            $data_arts = DB::table('art')->where('cid',$cid)->orderBy('ctime','desc')->paginate(1);
        } else if (!empty($tid)) {

            // 获取文章信息
            $data_arts = DB::table('art')->where('tid',$tid)->orderBy('ctime','desc')->paginate(1);
        } else {

            // 获取文章信息
            $data_arts = DB::table('art')->where('title','like','%'.$search.'%')
                                         ->orWhere('content','like','%'.$search.'%')
                                         ->orWhere('desc','like','%'.$search.'%')
                                         ->orderBy('ctime','desc')
                                         ->paginate(1);
        }

        return view('home.list.index',[
                'data_cates'=>$data_cates,'data_tags'=>$data_tags,
                'data_arts'=>$data_arts,'tag_names'=>$tag_names,
                'cate_names'=>$cate_names,'cid'=>$cid,'tid'=>$tid,
                'search'=>$search,'special_art'=>$special_art,
                'good_art'=>$good_art,
                'good_arts'=>$good_arts,
                'view_art'=>$view_art,
                'view_arts'=>$view_arts
            ]);
    }
}
