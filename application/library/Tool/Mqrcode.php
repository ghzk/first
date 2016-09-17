<?php
/***************************************************************************
 *
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 *
 **************************************************************************/

/**
 * @file   Qrcode.php
 * @author fanyitian (fanyitian@baidu.com)
 * @date   2016-09-17
 * @brief
 *
 **/


namespace Tool;

use Endroid\QrCode\QrCode;

class Mqrcode
{
    static public $instance;

    /**
     * @return Mqrcode
     */
    static public function Instance()
    {
        $class = get_called_class();
        if (empty(self::$instance)) {
            self::$instance = new $class();
        }

        return self::$instance;
    }

    public function get($text, $size = 300)
    {
        $qrCode = new QrCode();
        $qrCode
            ->setText($text)
            ->setSize($size)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        return $qrCode->getDataUri();
    }


}