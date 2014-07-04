<?php

/**
 * 
 * @author Kason Yang <i@kasonyang.com>
 */
 
namespace PhpComment;

class CommentException extends \Exception{
    
    static function noSaveCommentException(){
        return new self('必须设置：opcache.save_comments=1 或 zend_optimizerplus.save_comments=1');
    }
    
}