<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailController extends Controller
{
    //
    
    // 获取上下篇的文章
    public function getArt($aid,$eq,$order)
    {
        $data = DB::table('art')->where('aid',$eq,$aid)
                                ->orderBy('aid',$order)
                                ->first();
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    // 获取相关文章
    public static function getLikeArt($data_art)
    {
        
        $data = DB::table('art')->skip(0)->take(6)
                                ->where('tid',$data_art->tid)
                                ->where(function($query) use($data_art){
                                    $query->where('aid','!=',$data_art->aid);
                                })
                                ->orWhere('cid',$data_art->cid)
                                ->where(function($query) use($data_art){
                                    $query->where('aid','!=',$data_art->aid);
                                })
                                ->orderBy('view','desc')
                                ->get();
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    // 获取评论
    public static function getDiscuss($aid)
    {
        $data_discuss = DB::table('discuss')->where('aid',$aid)->get();
        $data_discusses = [];
        foreach ($data_discuss as $k => $v) {
            $discuss_user = DB::table('user')->where('uid',$v->uid)->first();
            if ($discuss_user->uid == $v->uid) {
                $data_discuss[$k]->sub = $discuss_user;
            }
            $data_discusses = $data_discuss;
        }
        return $data_discusses;
    }

    public function index(Request $request)
    {
        $aid = $request->input('aid','');
        
        $prev_art = self::getArt($aid,'>','asc');   // 上一篇
        $next_art = self::getArt($aid,'<','desc');  // 下一篇

        // 导航栏信息
        $data_cates = IndexController::getCates();

        // 栏目名 标签名
        $cate_names = IndexController::getCateName();
        $tag_names = ListController::getTagName();

        // 侧边栏
        $special_art = IndexController::special();
        $good_art = IndexController::getArtFirst('like');
        $good_arts = IndexController::getArtThree('like');
        $view_art = IndexController::getArtFirst('view');
        $view_arts = IndexController::getArtThree('view');

        $data_tags = DB::table('tag')->get();

        $data_art = DB::table('art')->where('aid',$aid)->first();

        // 相关推荐
        $like_arts = self::getLikeArt($data_art);

        

        // dd($like_art);

        // 有人进来看细节阅读量+3
        DB::table('art')->where('aid',$aid)->increment('view', 3);

        return view('home.detail.index',[
                'data_cates'=>$data_cates,'data_tags'=>$data_tags,
                'data_art'=>$data_art,'cate_names'=>$cate_names,
                'tag_names'=>$tag_names,'prev_art'=>$prev_art,
                'next_art'=>$next_art,'like_arts'=>$like_arts,
                'special_art'=>$special_art,'good_art'=>$good_art,
                'good_arts'=>$good_arts,'view_art'=>$view_art,
                'view_arts'=>$view_arts,'data_discusses'=>self::getDiscuss($aid)
            ]);
    }

    public function like(Request $request)
    {
        $aid = $request->input('aid');

    // 检测该用户是否重复点赞
            
        // 检测用户是否登录
            if (empty(session('flag_home'))) {
                echo json_encode(['msg'=>'error','info'=>'请先登录']);
                exit;
            }
        // 获取用户id
        $uid = session('user_home')->uid;

        // echo $uid,$aid;

        // 所有点赞的文章
        $users_art = DB::table('users_art')->where([['uid',$uid],['aid',$aid]])->select('id')->first();

        // dump(empty($users_art));
        
        if (!empty($users_art)) {
            echo json_encode(['msg'=>'error','info'=>'您已经点过赞了,不用重复点赞']);
            exit;
        }

        // $data['uid'] = $uid;
        // $data['aid'] = $aid;

        // dump($data);

        $res = DB::table('art')->where('aid',$aid)->increment('like', 1);

        if ($res) {
            $data['uid'] = $uid;
            $data['aid'] = $aid;
            DB::table('users_art')->insert($data);
            echo json_encode(['msg'=>'success','info'=>'点赞成功,谢谢支持']);
        } else {
            echo json_encode(['msg'=>'error','info'=>'点赞失败,请刷新试试']);
        }
        
    }

    public function discuss(Request $request)
    {
        if (empty(session('flag_home'))) {
            echo json_encode(['res'=>'error_user','info'=>'请先登录']);
            exit;
        }

        $uid = session('user_home')->uid;
        $data = $request->all();
        $data['uid'] = $uid;
        $data['ctime'] = date('Y-m-d H:i:s',time());
        // dump($data);
        
        $res = DB::table('discuss')->insert($data);
        if ($res) {
            echo json_encode(['res'=>'success','info'=>'评论成功']);
            exit;
        } else {
            echo json_encode(['res'=>'error','info'=>'评论失败,刷新试试']);
            exit;
        }
        
    }
}
