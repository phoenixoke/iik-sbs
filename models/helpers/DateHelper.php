<?php
/**
 * Author: Martinus D. Setiono
 * Date: 08/07/2015
 */

namespace app\models\helpers;

class DateHelper
{
    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    const DATE_FORMAT_LOCALIZED = 'php:d-m-Y';
    const DATETIME_FORMAT_LOCALIZED = 'php:d-m-Y H:i:s';
    const TIME_FORMAT_LOCALIZED = 'php:H:i:s';

    /**
     * @param $dateStr
     * @param string $type
     * @param null $format
     * @return string
     */
    public static function convertDate($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
            $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
            $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
            $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }

    public static function localizeDate($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
            $fmt = ($format == null) ? self::DATETIME_FORMAT_LOCALIZED : $format;
        }
        elseif ($type === 'time') {
            $fmt = ($format == null) ? self::TIME_FORMAT_LOCALIZED : $format;
        }
        else {
            $fmt = ($format == null) ? self::DATE_FORMAT_LOCALIZED : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }


}