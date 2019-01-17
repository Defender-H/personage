<?php

namespace App\Common\Admin;

use App\Model\Notice_article;
use App\Model\Notice_column;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5
 * Time: 17:27
 */
class Notice
{
    /**
     * 查找所有公告栏目数据并分页
     */
    public function column_index(){
        $a = Notice_column::select()
            ->orderBy('created_at','desc')
            ->paginate(15);
        return $a;
    }

    /**
     * 实现栏目添加
     * @param $data
     * @return bool
     */
    public function column_add($data){
        Notice_column::create([
            'name'=>$data['name'],
        ]);
        return true;
    }

    /**
     * 栏目单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function column_show($id){
        $a = Notice_column::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 实现栏目修改
     * @param $data
     * @return bool
     */
    public function column_edit($data){
        Notice_column::where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
        ]);
        return true;
    }

    /**
     * 删除栏目以及栏目底下的公告文章
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function column_del($id){
        Notice_article::where(['column_id'=>$id])->delete();
        Notice_column::where(['id'=>$id])->delete();
        return true;
    }

    /**
     * 查找分类下的所有公告文章数据并分页
     * @param $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function article_indexs($id){
        $a = Notice_article::where(['column_id'=>$id])
            ->select()
            ->orderBy('created_at','desc')
            ->paginate(15);
        return $a;
    }

    /**
     * 显示所有文章、已发布文章、未发布文章
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function article_index(){
        $a = Notice_article::select()
            ->orderBy('created_at','desc')
            ->paginate(15);
        $b = Notice_article::where(['status'=>0])->select()
            ->orderBy('created_at','desc')
            ->paginate(15);
        $c = Notice_article::where(['status'=>1])->select()
            ->orderBy('created_at','desc')
            ->paginate(15);
//        dd($a);
        return ['a'=>$a,'b'=>$b,'c'=>$c];
    }

    /**
     * 查询出全部栏目记录
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function article_column(){
        $a = Notice_column::all();
        return $a;
    }

    /**
     * 实现公告文章添加
     * @param $data
     * @return bool
     */
    public function article_add($data){
        Notice_article::create([
            'title'=>$data['title'],
            'column_id'=>$data['column_id'],
            'synopsis'=>$data['synopsis'],
            'content'=>$data['content'],
            'status'=>$data['status'],
        ]);
        return true;
    }

    /**
     * 实现公告文章的状态修改
     * @param $id
     * @return bool
     */
    public function article_status($id){
        $article = Notice_article::where(['id'=>$id])->first();
        if($article['status']==0){
            Notice_article::where(['id'=>$id])->update(['status'=>1]);
            return true;
        }else{
            Notice_article::where(['id'=>$id])->update(['status'=>0]);
            return true;
        }
    }

    /**
     * 公告文章单记录查询
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function article_show($id){
        $a = Notice_article::where(['id'=>$id])->first();
        return $a;
    }

    /**
     * 实现公告文章修改
     * @param $data
     * @return bool
     */
    public function article_edit($data){
        Notice_article::where(['id'=>$data['id']])
            ->update([
                'title'=>$data['title'],
                'column_id'=>$data['column_id'],
                'synopsis'=>$data['synopsis'],
                'content'=>$data['content'],
                'status'=>$data['status'],
            ]);
        return true;
    }

    /**
     * 实现公告文章删除
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function article_del($id){
        Notice_article::where(['id'=>$id])->delete();
        return true;
    }
}