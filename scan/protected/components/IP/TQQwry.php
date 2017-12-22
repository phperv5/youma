<?php

/**
 * QQwry.dat格式说明如下:
A。文件头，共8字节
B。若干条记录的结束地址+国家和区域
C。按照从小到大排列的若干条起始地址+结束地址偏移，定长，7字节
D。所有的IP都是用4字节整数记录的，并且遵照Intel次序，高位在后，低位在前。
E。所有偏移量都是绝对偏移，就是从文件最开头计算。
F。除了文件头用了两个4字节偏移，其余偏移量都用3字节。
G。所有的偏移量也是低位在前，高位在后
H。采用了一些字符串压缩技术

1。文件头，共8字节
FirstStartIpOffset:4 第一个起始IP的绝对偏移
LastStartIpOffset:4 最后一个起始IP的绝对偏移

2。起始地址+结束地址偏移记录区
每条记录7字节，按照起始地址从小到大排列

StartIp:4 起始地址，整数形式的IP
EndIpOffset:3 结束地址绝对偏移

3。结束地址+国家+区域记录区

EndIP:4
国家+区域记录:不定长

4。国家+区域记录，有几种形式
4.1。
国家字符串，以 0×0 结束
区域字符串，以 0×0 结束

4.2。
Flag:1 标识取值： 0×1，后面没有Local记录
0×2，后面还有Local记录
sCountryOffset:3 实际的字符串要去这个偏移位置去找
LocalRec:不定长，可选 根据Flag取值而定。这个记录也类似Country，可能采用压缩

4.3 LocalRec结构一
flag:1 还不是十分了解这个flag含义，取值 0×1 or 0×2
sLocalOffset:3

4.4 LocalRec结构二
sLocal：不定长 普通的C风格字符串

注意：sCountryOffset指向的位置可能依然是4.2格式的，不知道为什么这样设计。

Flag取0×1时，sCountryOffset指向的位置可能是Flag为0×2，这时，LocalRec也在这里寻找。

现在不明白当记录Local的位置遇到0×2的标志意味着什么。

在qqwry.dat中，似乎存在一些错误。
个别的记录Local会被写为：
0×2,0×0,0×0,0×0
根据规则，应该到文件最开头去寻找，可是，文件最开头显然不是记录这些的。
 */
class TQQwry
{
    var $StartIP = 0;
    var $EndIP    = 0;
    var $Country = '';
    var $Local    = '';
    var $CountryFlag = 0; // 标识 Country位置
    // 0x01,随后3字节为Country偏移,没有Local
    // 0x02,随后3字节为Country偏移，接着是Local
    // 其他,Country,Local,Local有类似的压缩。可能多重引用。
    var $fp;

    var $FirstStartIp = 0;
    var $LastStartIp = 0;
    var $EndIpOff = 0;
    static $Instance = NULL;
    var $QQWRY = '';


    function IpToInt($Ip) {
        $array=explode('.',$Ip);
        $Int=($array[0] * 256*256*256) + ($array[1]*256*256) + ($array[2]*256) + $array[3];
        return $Int;
    }

    function IntToIp($Int) {
        $b1=($Int & 0xff000000)>>24;
        if ($b1<0) $b1+=0x100;
        $b2=($Int & 0x00ff0000)>>16;
        if ($b2<0) $b2+=0x100;
        $b3=($Int & 0x0000ff00)>>8;
        if ($b3<0) $b3+=0x100;
        $b4= $Int & 0x000000ff;
        if ($b4<0) $b4+=0x100;
        $Ip=$b1.'.'.$b2.'.'.$b3.'.'.$b4;
        return $Ip;
    }

    function getStartIp ( $RecNo ) {
        $offset = $this->FirstStartIp + $RecNo * 7;
        @fseek ( $this->fp , $offset , SEEK_SET );
        $buf = fread ( $this->fp , 7 );
        $this->EndIpOff = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])* 256*256);
        $this->StartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        return $this->StartIp;
    }

    function getEndIp ( ) {
        @fseek ( $this->fp , $this->EndIpOff , SEEK_SET );
        $buf = fread ( $this->fp , 5 );
        $this->EndIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        $this->CountryFlag = ord ( $buf[4] );
        return $this->EndIp;
    }

    function getCountry() {

        switch ( $this->CountryFlag ) {
            case 1:
            case 2:
                $this->Country = $this->getFlagStr ( $this->EndIpOff+4);
                //echo sprintf('EndIpOffset=(%x)',$this->EndIpOff );
                $this->Local = ( 1 == $this->CountryFlag )? '' : $this->getFlagStr ( $this->EndIpOff+8);
                break;
            default :
                $this->Country = $this->getFlagStr ($this->EndIpOff+4);
                $this->Local =    $this->getFlagStr ( ftell ( $this->fp ));

        }
    }

    function getFlagStr ( $offset )
    {
        $flag = 0;
        while ( 1 ){
            @fseek ( $this->fp , $offset , SEEK_SET );
            $flag = ord ( fgetc ( $this->fp ) );
            if ( $flag == 1 || $flag == 2 ) {
                $buf = fread ($this->fp , 3 );
                if ($flag == 2 ){
                    $this->CountryFlag = 2;
                    $this->EndIpOff = $offset - 4;
                }
                $offset = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])* 256*256);
            }else{
                break;
            }
        }
        if ( $offset < 12 )
            return '';
        @fseek($this->fp , $offset , SEEK_SET );
        return $this->getStr();
    }

    function getStr ( )
    {
        $str = '';
        while ( 1 ) {
            $c = fgetc ( $this->fp );
            if ( ord ( $c[0] ) == 0   )
                break;
            $str .= $c;
        }
        return $str;
    }

    function qqwry ($dotip) {

        $nRet="";
        $ip = $this->IpToInt ( $dotip );

        $this->fp= @fopen($this->QQWRY, "rb");
        if ($this->fp == NULL) {
            $szLocal= "OpenFileError";
            return 1;

        }
        @fseek ( $this->fp , 0 , SEEK_SET );
        $buf = fread ( $this->fp , 8 );//文件开头8个字节
        $this->FirstStartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        $this->LastStartIp   = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])*256*256) + (ord($buf[7])*256*256*256);

        $RecordCount= floor( ( $this->LastStartIp - $this->FirstStartIp ) / 7);
        if ($RecordCount <= 1){
            $this->Country = "FileDataError";
            fclose ( $this->fp );
            return 2;
        }

        $RangB= 0;
        $RangE= $RecordCount;
        // Match ...
        while ($RangB < $RangE-1)
        {
            $RecNo= floor(($RangB + $RangE) / 2);
            $this->getStartIp ( $RecNo );

            if ( $ip == $this->StartIp )
            {
                $RangB = $RecNo;
                break;
            }
            if ( $ip > $this->StartIp)
                $RangB= $RecNo;
            else
                $RangE= $RecNo;
        }
        $this->getStartIp ( $RangB );
        $this->getEndIp ( );

        if ( ( $this->StartIp   <= $ip ) && ( $this->EndIp >= $ip ) ){
            $nRet = 0;
            $this->getCountry ( );
            //这样不太好..............所以..........
            $this->Local = str_replace("（我们一定要解放台湾！！！）", "", $this->Local);
            $this->Local = str_replace("CZ88.NET", "", $this->Local);

        }else {
            $nRet = 3;
            $this->Country = '未知';
            $this->Local = '';
            $this->Local = str_replace("CZ88.NET", "", $this->Local);
        }
        fclose ( $this->fp );
        return $nRet;
    }

    public static function newInstance($ip,$DataPath)
    {
        if(!isset(self::$Instance))
        {
            self::$Instance = new TQQwry();
        }
        self::$Instance->QQWRY = $DataPath;
        $nRet = self::$Instance->qqwry($ip);
        //可以利用 $nRet做一些事情，我是让他自动记录未知IP到一个表,代码就不写了。
        return self::$Instance;
        //return $wry->Country.$wry->Local;
    }

    public static function getInOrOut($ip)
    {
        $Local = iconv("GBK", "UTF-8", self::newInstance($ip,Yii::app()->basePath.'/components/IP/QQWry.Dat')->Country);
        $province = array('北京市','天津市','河北省','山西省','内蒙古','辽宁省','吉林省','黑龙江省','上海市','江苏省','浙江省',
            '安徽省','福建省','江西省','山东省','河南省','湖北省','湖南省','广东省','广西','海南省','重庆市','四川省',
            '贵州省','云南省','西藏','陕西省','甘肃省','青海省','宁夏','新疆');

        foreach($province as $item)
        {
            if(strstr($Local,$item))
            {
                return true;
            }
        }
        return false;
    }
}

