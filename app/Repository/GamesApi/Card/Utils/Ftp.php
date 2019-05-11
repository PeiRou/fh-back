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
    public $conn;

    public function __construct($FTP_HOST,$FTP_USER,$FTP_PASS,$FTP_PORT = 21)
    {
        $this->u = $FTP_USER;
        $this->p = $FTP_PASS;
        $this->conn = ftp_connect($FTP_HOST,$FTP_PORT);
        ftp_login($this->conn,$FTP_USER,$FTP_PASS);
        ftp_pasv($this->conn,true); // 打开被动模拟
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        @ftp_close($this->conn);
    }

    public function files($path = ''){
        return ftp_nlist($this->conn, $path);
    }

    public function downNb($path, $newpath, $resumepos = 0)
    {
        \App\GamesApi::mkPath($newpath);
        ftp_get($this->conn, $newpath, $path, FTP_BINARY, $resumepos);
    }

}