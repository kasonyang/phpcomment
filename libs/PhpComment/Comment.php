<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

namespace PhpComment;


class Comment{
    
    /**
     *
     * @var ReflectionClass
     */
    private $ref;


    /**
     * 
     * @param array $ref_array
     * @return \PhpComment\Tags
     */
    private function getTags($ref_array){
        $tags = [];
        foreach($ref_array as $ref){
            $tags[$ref->getName()] = $this->getTag($ref);
        }
        return $tags;
    }
    
    private function getTag($ref){
        return new Tags($ref->getDocComment());
    }
    
    /**
     * 
     * @param string|object $class
     */
    public function __construct($class) {
        if (extension_loaded('Zend Optimizer+')
                && (ini_get('zend_optimizerplus.save_comments') === "0" || ini_get('opcache.save_comments') === "0")) {
            throw CommentException::noSaveCommentException();
        }
        if (extension_loaded('opcache') && ini_get('opcache.save_comments') == 0) {
            throw CommentException::noSaveCommentException();
        }
        $this->ref = new \ReflectionClass($class);
    }
    
    /**
     * 
     * @return array 以属性名称为键Tags为值的数组
     */
    function getAttributeTags(){
        $props = $this->ref->getProperties();
        return $this->getTags($props);
      
    }
    
    /**
     * 
     * @return array 以属性名称为键Tags为值的数组
     */
    function getMethodTags(){
        return $this->getTags($this->ref->getMethods());
    }
    
    function getClassTag(){
        return $this->getTag($this->ref);
    }
}