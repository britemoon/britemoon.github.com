<?php 
function bin_todec($datalist,$bin){
    static $arr=array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'A'=>10,'B'=>11,'C'=>12,'D'=>13,'E'=>14,'F'=>15);
    if(!is_array($datalist))$datalist=array($datalist);
    if($bin==10)return $datalist; 
    $aOutData=array(); 
    foreach ($datalist as $num){
        $atnum=str_split($num); 
        $atlen=count($atnum);
        $total=0;
        $i=1;
        foreach ($atnum as $tv)
        {
            $tv=strtoupper($tv);
             
            if(array_key_exists($tv,$arr))
            {
                $total=$total+$arr[$tv]*pow($bin,$atlen-$i);
            }
            $i++;
        }
        $aOutData[]=$total;
    }
    return $aOutData;
}

// var_dump(bin_todec(array('ff','33','80'),16));
// var_dump(bin_todec(array('1101101','111101101'),2));
// var_dump(bin_todec(array('1234123','12341'),8));

function decto_bin($datalist,$bin){
	static $arr=array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F');
	if(!is_array($datalist)) $datalist=array($datalist);
	if($bin==10)return $datalist; 
	$bytelen=ceil(16/$bin); 
	$aOutChar=array();
	foreach ($datalist as $num){
		$t="";
		$num=intval($num);
		if($num===0){
			$t=0;
		}
		while($num>0){
			$t=$arr[$num%$bin].$t;
			$num=floor($num/$bin);
		}
		$tlen=strlen($t);
		if($tlen%$bytelen!=0){
			$pad_len=$bytelen-$tlen%$bytelen;
			$t=str_pad("",$pad_len,"0",STR_PAD_LEFT).$t; 
		}
		$aOutChar[]=$t;
	}
	return $aOutChar;
}

// var_dump(decto_bin(array(128,253),2));
// var_dump(decto_bin(array(128,253),8));
// var_dump(decto_bin(array(128,253),16));

function word_array10($word){
	$string10 = $word;
	$array10 = explode(",",$string10);
	$middle = decto_bin($array10,2);
	// print_r($array10);
	$final=array();
	$b=0;
	$c='';
	foreach ($middle as $num)
	{
		$c = $c.$num;
		$b = $b + 1;
		if ($b == 3){
			$final[] = $c;
			$b = 0;
			$c = '';
		}
	}
	return $final;
}

function word_array16($word){
	$string16 = $word;
	$array16 = explode(",",$string16);
	$array10 = bin_todec($array16,16);
	$middle = decto_bin($array10,2);
	// print_r($array10);
	$final=array();
	$b=0;
	$c='';
	foreach ($middle as $num)
	{
		$c = $c.$num;
		$b = $b + 1;
		if ($b == 3){
			$final[] = $c;
			$b = 0;
			$c = '';
		}
	}
	return $final;
}

function array_list($final){
	$list = '';
	$x = 0;
	$y = 0;
	foreach ($final as $num){
		$array = str_split($num);
		$f = '';
		foreach ($array as $n){
			if($n == 1){
				$f = $f.'['.$x.','.$y.',1],';
			}
			$x = $x + 1;
		}
		$list = $list.$f."\n";
		$y = $y + 1;
		$x = 0;
	}
	return $list;
}


$final1 = word_array10('0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,17,15,224,127,152,112,65,179,96,25,158,192,25,3,192,25,15,254,17,59,62,63,223,252,48,219,176,0,211,48,254,223,240,224,131,48,1,131,248,15,191,204,7,0,0,0,0,0,0,0,0,0,0,0');

$final2 = word_array10('0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,112,0,31,247,248,31,143,56,28,7,24,12,7,48,15,247,224,12,199,248,12,199,28,12,199,12,12,255,12,127,247,60,126,7,240,0,7,0,0,7,0,0,7,0,0,0,0,0,0,0,0,0,0');

$final3 = word_array16('00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,0C,32,00,0E,37,FC,06,23,18,07,63,30,0F,F3,30,01,83,F0,1F,FB,FC,3F,F3,0C,01,83,06,03,63,0C,07,33,78,1E,1B,E0,78,03,00,00,03,00,00,03,00,00,00,00,00,00,00,00,00,00');

$final4 = word_array16('00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,18,00,00,38,00,00,38,00,00,38,00,0F,FF,F0,0C,38,00,00,3C,00,00,36,00,00,63,00,00,E3,C0,03,C1,F0,7F,80,FE,7F,00,7E,1C,00,3C,00,00,00,00,00,00,00,00,00,00,00,00');

$final5 = word_array16('00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,00,03,00,00,03,7F,FE,33,63,1E,33,03,00,33,3F,F8,33,3F,F8,33,33,18,33,33,18,33,33,18,13,33,18,06,73,18,0E,E3,18,3C,C3,18,78,03,00,00,03,00,00,00,00,00,00,00,00,00,00');

for($i=1;$i<=24;$i++){
	$final[$i]=$final3[$i].$final4[$i].$final5[$i];
}

echo $lattice = array_list($final);
