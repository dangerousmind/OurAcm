<?php
class NewsAction extends BaseAction {
    
    public function index() {
        
        $newsDB = D('News');
        $this -> commonassign();
        if(session('goldbirds_islogin'))  //仅队员可见
            $category = $newsDB -> distinct(true) -> field('category') -> select();
        else  //所有人可见
            $category = $newsDB -> distinct(true) -> field('category') -> where('permission=0') -> select();
        
        if(!$category) {  //暂无新闻
            $this -> display('nodata');
        }
        else {
            $nid = intval($this -> _get('nid'));
            $this -> assign('nid', $nid);
            $this -> assign('category', $category);
            $this -> display();
        }
    }
    
    public function ajaxload() {
        
        if(!$this -> isPost())
            $this -> ajaxReturn(null, '[错误]参数不正确。', 1);
        else {
            $PAGE = 10;  //每页显示数量
            
            $nid = intval($this -> _post('nid'));
            $page = intval($this -> _post('page'));
            if($page < 0) $page = 0;
            $category = base64_decode($this -> _post('category', false));
            
            $newsDB = D('News');
            if($nid > 0) {  //有该参数时，以该参数为准
                $cstr = 'nid='.$nid;
                if(!session('goldbirds_islogin')) $cstr .= ' AND permission=0';
                $data = $newsDB -> relation(true) -> where($cstr) -> select();
                if(false === $data) $this -> ajaxReturn(null, '[错误]读取数据库出错，请重试。', 2);
                else if($data) $this -> ajaxReturn($data, '[成功]', 0);
                else {  //该参数无效
                    $c = Array();
                    if($category) $c['category'] = $category;
                    if(!session('goldbirds_islogin')) $c['permission'] = 0;
                    $data = $newsDB -> relation(true) -> where($c) -> order('top DESC, nid DESC') -> limit(($page * $PAGE) . ',' . $PAGE) -> select();
                    if($data) $this -> ajaxReturn($data, '[成功]', 0);
                    else if($data === false) $this -> ajaxReturn(null, '[错误]读取数据库出错，请重试。', 2);
                    else $this -> ajaxReturn(null, '[错误]没有数据了>.<', 1);
                } 
            }
            else {  //根据page和category参数来
                $c = Array();
                if($category) $c['category'] = $category;
                if(!session('goldbirds_islogin')) $c['permission'] = 0;
                $data = $newsDB -> relation(true) -> where($c) -> order('top DESC, nid DESC') -> limit(($page * $PAGE) . ',' . $PAGE) -> select();
                if($data) $this -> ajaxReturn($data, '[成功]', 0);
                else if($data === false) $this -> ajaxReturn(null, '[错误]读取数据库出错，请重试。', 2);
                else $this -> ajaxReturn(null, '[错误]没有数据了>.<', 1);
            }
        }
    }
}
    