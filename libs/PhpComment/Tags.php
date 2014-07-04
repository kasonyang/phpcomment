<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace PhpComment;

class Tags{
    
    private $tags = [];
    
    private $last_tags = null;

    /**
     * 
     * @param string $raw_comment
     */
    public function __construct($raw_comment) {
        if(substr($raw_comment, 0,3) === '/**'){
            $raw_comment = substr($raw_comment, 3);
        }
        if(substr($raw_comment, -2) === '*/'){
            $raw_comment = substr($raw_comment, 0,-2);
        }
        $lines = explode("\n", trim($raw_comment));
        foreach($lines as $l){
            $l_str = ltrim($l);
            $l_str = ltrim($l_str,' *');
            if(substr($l_str, 0,1) === '@'){
                $space_offset = strpos($l_str, ' ');
                if($space_offset === FALSE){
                    $tag = substr($l_str, 1);
                    $this->last_tags = &$this->tags[$tag][];
                    $this->last_tags = '';
                }else{
                    $tag = substr($l_str,1,$space_offset - 1);
                    $this->last_tags = &$this->tags[$tag][];
                    $this->last_tags = substr($l_str, $space_offset + 1);
                }
            }else{
                if($this->last_tags){
                    $this->last_tags .= $l_str;
                }
            }
        }
    }
    
    /**
     * 
     * @param string|null $tag_name
     * @return array|boolean
     */
    function get($tag_name = NULL){
        if($tag_name){
            return isset($this->tags[$tag_name]) ? $this->tags[$tag_name] : FALSE;
        }else{
            return $this->tags;
        }
    }
    
}
