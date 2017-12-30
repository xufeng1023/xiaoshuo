<?php

namespace App;
   
class CutPage {     
    private $pagestr;       //被切分的内容     
    private $pagearr;       //被切分文字的数组格式     
    private $sum_word;      //总字数(UTF-8格式的中文字符也包括)     
    private $sum_page;      //总页数     
    private $payload;     //一页多少字     
    private $cut_custom;    //手动分页符     
    private $ipage;         //当前切分的页数，第几页     
    private $url;     
    private $cut_tag = ["</table>", "</div>", "</p>", "<br/>", "”。", "。", ".", "！", "……", "？", ","];
     
    function __construct($pagestr, $payload = 2000, $custom_tag = '')
    {     
        $this->pagestr = $pagestr;
        $this->payload = $payload;     
        $this->cut_custom = $custom_tag;
        $tmp_page = intval(trim(request()->ipage)); 
        $this->ipage = $tmp_page > 1? $tmp_page : 1;  
    }     
     
    function cut_str()
    {     
        $this->pagearr = $this->pageArray();
        $this->sum_page = count($this->pagearr);   
        return $this->pagearr; 
    }     

    private function pageArray()
    {
        $totalLength = strlen($this->pagestr);   

        if ($totalLength <= $this->payload) {  
            return [$this->pagestr];     
        }     

        if ($this->cut_custom && strpos($this->pagestr, $this->cut_custom)) {     
            return explode($this->cut_custom, $this->pagestr);     
        }

        $str_first = substr($this->pagestr, 0, $this->payload);   

        foreach ($this->cut_tag as $v) {     
            if ($cut_start = strrpos($str_first, $v)) {     //逆向查找第一个分页符的位置
                $page_arr[] = substr($this->pagestr, 0, $cut_start).$v;     
                $cut_start = $cut_start + strlen($v);     
                break;     
            }     
        }     

        if (($cut_start + $this->payload) >= $totalLength) {
            $page_arr[] = substr($this->pagestr, $cut_start, $this->payload);     
            return $page_arr;
        }

        while (($cut_start + $this->payload) < $totalLength) {    
            $str_tmp = substr($this->pagestr, $cut_start, $this->payload);
            foreach ($this->cut_tag as $v) {     
                if ($cut_tmp = strrpos($str_tmp, $v)) {     
                    $page_arr[] = substr($str_tmp, 0, $cut_tmp).$v;     
                    $cut_start = $cut_start + $cut_tmp + strlen($v);     
                    break;     
                }     
            }       
        }     
        $page_arr[] = substr($this->pagestr, $cut_start, $this->payload);  
        
        return $page_arr;   
    }

    function pagenav($str = '')
    {     
        //$this->set_url();     

        for($i = 1; $i <= $this->sum_page; $i++) { 
            if($i == $this->ipage) { 
                $str.= "<a href='#' class='cur'>".$i."</a> "; 
                continue;
            }

            $str.= "<a href='?ipage=".$i."'>".$i."</a> "; 
        } 
         
        return $str;     
    }     
       
    private function set_url()
    {     
        parse_str(\Request::server('QUERY_STRING'), $arr_url);     
        unset($arr_url["ipage"]);     
        if (empty($arr_url)) {     
            $str = "ipage=";     
        } else {     
            $str = http_build_query($arr_url)."&ipage=";     
        }     
        $this->url = "?".$str; 
    }     
}     
