<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

include_once __DIR__ . '/../libs/PhpComment/Comment.php';
include_once __DIR__ . '/../libs/PhpComment/Tags.php';

/**
 * @author kasonyang
 */
class ClassWithComment{
    /**
     *
     * @var string
     */
    public $prop1;
    
    /**
     * @return boolean
     */
    function func1(){
        
    }
}


class CommentTest extends PHPUnit_Framework_TestCase{
    
    function testComment(){
        $obj = new ClassWithComment();
        $comment = new \PhpComment\Comment($obj);
        $prop_tags = $comment->getAttributeTags();
        
        $this->assertArrayHasKey('prop1', $prop_tags);
        $this->assertEquals(["var"=>["string"]], $prop_tags['prop1']->get());
        
        $func_tags = $comment->getMethodTags();
        $this->assertArrayHasKey('func1', $func_tags);
        $this->assertEquals(['return' => ['boolean']], $func_tags['func1']->get());
        
        $class_tag = $comment->getClassTag();
        $this->assertEquals(['author' => ['kasonyang']], $class_tag->get());
    }
    
}