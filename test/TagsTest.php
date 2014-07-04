<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */

include_once __DIR__ . '/../libs/PhpComment/Comment.php';
include_once __DIR__ . '/../libs/PhpComment/Tags.php';


use \PhpComment;

class TagsTest extends PHPUnit_Framework_TestCase{
    
    function testGet(){
        $tags = new PhpComment\Tags("/**\n *@tag1\n *@tag2 \n *@tag3 tag_content \n * tag_content2 */");
        $kvs = $tags->get();
        
        $this->assertArrayHasKey('tag1', $kvs);
        $this->assertEquals([''], $kvs['tag1']);
        
        $this->assertArrayHasKey('tag2', $kvs);
        $this->assertEquals([''], $kvs['tag2']);
        
        $this->assertArrayHasKey('tag3', $kvs);
        $this->assertEquals(['tag_content tag_content2'], $kvs['tag3']);
        
        $this->assertEquals([''], $tags->get( 'tag1'));
        $this->assertFalse($tags->get('tag_no_exist'));
        
        
    }
    
}