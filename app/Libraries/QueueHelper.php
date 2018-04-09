<?php
/**
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Kabooodle,LLC <help@kabooodle.com>
 */

namespace Kabooodle\Libraries;

/**
 * Class QueueHelper
 */
class QueueHelper
{
    /**
     * @var array
     */
    public static $Q_VIEWTRACKER = [
        'iron-viewtracker',
//        'iron-viewtracker-b'
    ];

    /**
     * @var array
     */
    public static $Q_EMAILS = [
        'iron-emails',
//        'iron-emails-b',
//        'iron-emails-c',
//        'iron-emails-d',
//        'iron-emails-e',
//        'iron-emails-f',
//        'iron-emails-g'
    ];

    /**
 * @var array
 */
    public static $Q_FBSCHEDULER = [
        'iron-facebook-scheduler',
//        'iron-facebook-scheduler-b',
//        'iron-facebook-scheduler-c',
//        'iron-facebook-scheduler-d',
//        'iron-facebook-scheduler-e'
    ];

    /**
     * @var array
     */
    public static $Q_FBSCHEDULER_DELETE = [
        'iron-facebook-scheduler-delete',
//        'iron-facebook-scheduler-delete-b',
//        'iron-facebook-scheduler-delete-c',
//        'iron-facebook-scheduler-delete-d',
//        'iron-facebook-scheduler-delete-e'
    ];

    /**
     * @var array
     */
    public static $Q_FBLISTER = [
        'iron-facebook-lister',
//        'iron-facebook-lister-b',
//        'iron-facebook-lister-c',
//        'iron-facebook-lister-d',
//        'iron-facebook-lister-e',
//        'iron-facebook-lister-f',
//        'iron-facebook-lister-g',
//        'iron-facebook-lister-h',
//        'iron-facebook-lister-i',
//        'iron-facebook-lister-j'
    ];

    /**
     * @var array
     */
    public static $Q_FBDELETER = [
        'iron-facebook-deleter',
//        'iron-facebook-deleter-b',
//        'iron-facebook-deleter-c',
//        'iron-facebook-deleter-d',
//        'iron-facebook-deleter-e',
    ];

    /**
     * @param array $array
     *
     * @return string
     */
    private static function makeRandomSelection(array $array)
    {
        if (in_array(app()->environment(), ['dev','local', 'production'])) {
            return 'sync';
        }

        return $array[mt_rand(0, count($array) - 1)];
    }

    /**
     * @return string
     */
    public static function pickViewTracker()
    {
        return self::makeRandomSelection(self::$Q_VIEWTRACKER);
    }

    /**
     * @return string
     */
    public static function pickFacebookScheduler()
    {
        return self::makeRandomSelection(self::$Q_FBSCHEDULER);
    }

    /**
     * @return string
     */
    public static function pickFacebookSchedulerDelete()
    {
        return self::makeRandomSelection(self::$Q_FBSCHEDULER_DELETE);
    }

    /**
     * @return string
     */
    public static function pickFacebookLister()
    {
        return self::makeRandomSelection(self::$Q_FBLISTER);
    }

    /**
     * @return string
     */
    public static function pickFacebookDeleter()
    {
        return self::makeRandomSelection(self::$Q_FBDELETER);
    }

    /**
     * @return string
     */
    public static function pickEmails()
    {
        return self::makeRandomSelection(self::$Q_EMAILS);
    }
}
