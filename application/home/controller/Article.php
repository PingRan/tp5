<?php
namespace app\home\controller;
use app\home\model\Picture;
use think\Db;
use think\Request;
use app\home\model\Document;
/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class Article extends Home {

    /* 文档模型频道页 */
	public function index(){
		/* 分类信息 */
		$category = $this->category();

		//频道页只显示模板，默认不读取任何内容
		//内容可以通过模板标签自行定制

		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);
		return $this->fetch($category['template_index']);
	}

	/* 文档模型列表页 */
	public function lists($p = 1){

		/* 分类信息 */
		$category = $this->category();
		/* 获取当前分类列表 */
		$Document = new Document();

		$list = $Document->lists($category['id']);

		if(false === $list){
			$this->error('获取列表数据失败！');
		}

		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);
		$this->assign('list', $list);

		// echo $category['template_lists'];
//		return $this->fetch($category['template_lists']);

        return $this->fetch('article/index');
	}

	//ajaxlist请求
    public function ajaxlists(){

        $data=\request()->param();
        $Document=new Document();
        $map=$Document->listMap($data['category']);

        $notices=$Document->where($map)->where('display','eq',1)->limit(($data['p']-1)*2,2)->select();

        $p=$data['p'];
        if(!empty($notices)){
            $p=$data['p']+1;
        }
        $picture=new Picture();

        foreach ($notices as &$v){
            $v['url']=$picture->field('path')->find($v['cover_id']);
        }

        $data=['notice'=>$notices,'url'=>url('Article/ajaxlists',array('category'=>$data['category'],'p'=>$p))];
        echo json_encode($data);

    }


	/* 文档模型详情页 */
	public function detail($id = 0, $p = 1){
		/* 标识正确性检测 */
		if(!($id && is_numeric($id))){
			$this->error('文档ID错误！');
		}

		/* 页码检测 */
		$p = intval($p);
		$p = empty($p) ? 1 : $p;

		/* 获取详细信息 */
		$Document = new Document();
		$info = $Document->detail($id);
		if(!$info){
			$this->error($Document->getError());
		}
		$info['create_time']=date('Y-m-d H:i:s',$info['create_time']);
		/* 分类信息 */
		$category = $this->category($info['category_id']);
		/* 获取模板 */
		if(!empty($info['template'])){//已定制模板
			$tmpl = $info['template'];
		} elseif (!empty($category['template_detail'])){ //分类已定制模板
			$tmpl = $category['template_detail'];
		} else { //使用默认模板
			$tmpl = 'article/'. get_document_model($info['model_id'],'name') .'/detail';
		}
		/* 更新浏览数 */
		$map = array('id' => $id);
		$Document->where($map)->setInc('view');
		/* 模板赋值并渲染模板 */
		$this->assign('category', $category);
		$this->assign('info', $info);
		$this->assign('page', $p); //页码
		return $this->fetch($tmpl);
	}

	/* 文档分类检测 */
	private function category($id = 0){
		/* 标识正确性检测 */
		$id = $id ? $id : input('param.category',0);
		if(empty($id)){
			$this->error('没有指定文档分类！');
		}

		/* 获取分类信息 */
		$category = model('Category')->info($id);
		if($category && 1 == $category['status']){
			switch ($category['display']) {
				case 0:
					$this->error('该分类禁止显示！');
					break;
				//TODO: 更多分类显示状态判断
				default:
					return $category;
			}
		} else {
			$this->error('分类不存在或被禁用！');
		}
	}
    //报名
    public function SingUp(){

        $result=['status'=>true,'message'=>'报名成功','code'=>1];
        if ( !is_login() ) {
            $result=['status'=>false,'message'=>'请登录','code'=>0];
            return json_encode($result);
        }
        $act_id=\request()->get('id');
        $user_id=$_SESSION['twothink_home']['user_auth']['uid'];
        $is_SingUp=Db::name('activity')->where('id','eq',$user_id)->where('act_id','eq',$act_id)->find();
       if($is_SingUp){
           $result=['status'=>false,'message'=>'您已报名,请勿重复报名','code'=>-1];
       }else{
           Db::name('activity')->insert(['id'=>$user_id,'act_id'=>$act_id]);
       }
        echo json_encode($result);
    }
    //显示button
    public function button()
    {
        $result=['status'=>false];

        if ( !is_login() ) {
            $result=['status'=>true];//表示显示点击报名
            return json_encode($result);
        }
        $act_id=\request()->get('id');
        $user_id=$_SESSION['twothink_home']['user_auth']['uid'];
        $is_SingUp=Db::name('activity')->where('id','eq',$user_id)->where('act_id','eq',$act_id)->find();
        if(!$is_SingUp){
            $result=['status'=>true];
            return json_encode($result);
        }
        echo json_encode($result);
    }

}
