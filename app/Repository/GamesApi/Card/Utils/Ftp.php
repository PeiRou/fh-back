<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/8
 * Time: 19:06
 */

namespace App\Repository\GamesApi\Card\Utils;


class Ftp
{

    public function __construct($FTP_HOST,$FTP_USER,$FTP_PASS,$FTP_PORT = 21)
    {
        $conn = @ftp_connect($FTP_HOST,$FTP_PORT);
        @ftp_login($this->conn_id,$FTP_USER,$FTP_PASS);
        @ftp_pasv($this->conn_id,1); // 打开被动模拟
    }

}