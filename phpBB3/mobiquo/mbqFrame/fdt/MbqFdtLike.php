<?php

defined('MBQ_IN_IT') or exit;

/**
 * like module field definition class
 */
Abstract Class MbqFdtLike extends MbqBaseFdt {
    
    public static $df = array(
        'MbqEtLike' => array(
            'type' => array(
                'range' => array(
                    'likeForumTopic' => 'likeForumTopic',
                    'likeForumPost' => 'likeForumPost'
                )
            )
        )
    );
  
}
MbqBaseFdt::$df['MbqFdtLike'] = &MbqFdtLike::$df;
