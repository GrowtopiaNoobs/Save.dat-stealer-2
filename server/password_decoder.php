<?php
function toNumber($dest)
    {
        if ($dest)
            return ord($dest);
        else
            return 0;
    }

function getString($arr, $offs, $len)
{
    $res = "";
    for($i=0; $i<$len; $i++)
    {
        $res .= $arr[$i+$offs];
    }
    return $res;
}

function getDecryptedString($arr, $offs, $len, $advChar=false) // TODO: remove advChar - it have no longer any use...
{
    $rStr = "";
    for($i=0; $i<256; $i++)
    {
        $retStr="";
        $isV=true;
        for($j=0; $j<$len && $isV; $j++)
        {
            $chra = toNumber($arr[$offs+$j])+$i-$j;
            if($chra%256>31&&$chra%256<127)
            {
                $retStr.=chr($chra);
            } else {
                $isV = false;
            }
        }
        if($isV)
        {
            $rStr.=$retStr."<BR>";
        }
    }
    return $rStr;
}

function getFloat($arr, $offs)
{
    return unpack("f", pack('CCCC', toNumber($arr[$offs+0]), toNumber($arr[$offs+1]), toNumber($arr[$offs+2]), toNumber($arr[$offs+3])))[1];
}

function getInt($arr, $offs)
{
    return unpack("I", pack('CCCC', toNumber($arr[$offs+0]), toNumber($arr[$offs+1]), toNumber($arr[$offs+2]), toNumber($arr[$offs+3])))[1];
}

function get_savedat($path)
{
        $data = file_get_contents($path);
        $size = filesize($path);
        $increasor=0;
        $res=array();
        if($size<9)
        {
            $res["error"]="This file is too small to be valid!";
            return $res;
        }
        for($i=4;$i<10000;$i+=8+$increasor)
        {
            $increasor=0;
            if(toNumber($data[$i])===0 || $i+8>$size)
            {
                break;
            } else if(toNumber($data[$i])==1)
            {
                $increasor = 4 + toNumber($data[$i+4]);
                $res[getString($data, $i+8, toNumber($data[$i+4]))]=getFloat($data, toNumber($data[$i+4])+$i+8);
            } else if(toNumber($data[$i])==2)
            {
                $increasor = 4 + toNumber($data[$i+4]) + toNumber($data[$i + 8 + toNumber($data[$i + 4])]);
                $ncach = getString($data, $i+8, toNumber($data[$i+4]));
                $vcach = "";
                if($ncach==="meta")
                {
                    $vcach = getDecryptedString($data, $i+12+toNumber($data[$i+4]), toNumber($data[$i+8+toNumber($data[$i+4])]), true);
                } else if($ncach=="tankid_password")
                {
                    $vcach = getDecryptedString($data, $i+12+toNumber($data[$i+4]), toNumber($data[$i+8+toNumber($data[$i+4])]));
                } else
                {
                    $vcach = getString($data, $i+12+toNumber($data[$i+4]), toNumber($data[$i+8+toNumber($data[$i+4])]));
                }
                $res[$ncach]=$vcach;
            } else if(toNumber($data[$i])==5)
            {
                $increasor = 4 + toNumber($data[$i+4]);
                if(toNumber($data[toNumber($data[$i+4])+$i+8])!=0)
                {
                    $vcach = "true";
                } else {
                    $vcach = "false";
                }
                
                $res[getString($data, $i+8, toNumber($data[$i+4]))]=$vcach;
            } else if(toNumber($data[$i])==9)
            {
                $increasor = 4 + toNumber($data[$i+4]);
                $res[getString($data, $i+8, toNumber($data[$i+4]))]=getInt($data, toNumber($data[$i+4])+$i+8);
            }
        }
        return $res;
    }
