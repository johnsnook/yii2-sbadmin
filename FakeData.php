<?php

/*
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://github.com/johnsnook/yii2-sbadmin/blob/master/LICENSE
 */

namespace johnsnook\sbadmin;

/**
 * Description of Fake
 *
 * @author John
 */
class FakeData {

    public static function getMessages() {
        return [
            [
                'from' => 'David Miller',
                'time' => '11:21 AM',
                'message' => 'Hey there! This new version of SB Admin is pretty awesome!'
                . " These messages clip off when they reach the end of the box so they "
                . "don't overflow over to the sides! "
            ],
            [
                'from' => 'Jane Smith',
                'time' => '6:08 AM',
                'message' => 'I was wondering if you could meet for an appointment at 3:00 '
                . 'instead of 4:00. Thanks!'
            ],
            [
                'from' => 'John Doe',
                'time' => '9:42 PM',
                'message' => "I've sent the final files over to you for review. When you're "
                . "able to sign off of them let me know and we can discuss distribution."
            ],
        ];
    }

    public static function getAlerts() {
        return [
            [
                'status' => 'Status Update',
                'time' => '11:21 AM',
                'message' => 'The Yii2 SB Admin extension is properly installed and you\'re'
                . ' very good looking and wise.',
                'good' => true
            ],
            [
                'status' => 'Status Update',
                'time' => '6:08 AM',
                'message' => 'This is an automated server response message. All systems are online.',
                'good' => false
            ],
            [
                'status' => 'Status Update',
                'time' => '9:42 PM',
                'message' => 'This is an automated server response message. All systems are online.',
                'good' => true
            ],
        ];
    }

}
