<?php




function getlast($toget)
{
        $pos=strrpos($toget,".");
        $lastext=substr($toget,$pos+1);
        return $lastext;
}

function Get_TYPE_img($file) 
{
        $imge = getimagesize($file);
if($imge[2] == 1) {return 'gif';}
elseif($imge[2] == 2) {return 'jpg';}
elseif($imge[2] == 3) {return 'png';}
else{return 'none';}
        }

function resize_image($image_file_path, $new_image_file_path, $imgtype, $new_width, $new_height)
{
        $return_val = 1;
        if($imgtype == 'jpg'){
        $return_val = ( (@$img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
                         //Если картинка gif.
                         }elseif($imgtype == 'gif'){
        $return_val = ( (@$img = imagecreatefromgif ($image_file_path )) && $return_val == 1 ) ? "1" : "0";
                                 //Если картинка png.
                                 }elseif($imgtype == 'png'){
        $return_val = ( (@$img = imagecreatefrompng ($image_file_path )) && $return_val == 1 ) ? "1" : "0";
                                         }
        $FullImage_width = imagesx ($img);
        $FullImage_height = imagesy ($img);
        if ( $new_width == $FullImage_width && $new_height == $FullImage_height )
                copy ( $image_file_path, $new_image_file_path );
        $full_id = imagecreatetruecolor($new_width, $new_height);


         // вырезаем квадратную серединку по x, если фото горизонтальное
         if ($FullImage_width>$FullImage_height)
         imagecopyresampled($full_id, $img, 0, 0,
                          round((max($FullImage_width,$FullImage_height)-min($FullImage_width,$FullImage_height))/2),
                          0, $new_width, $new_height, min($FullImage_width,$FullImage_height), min($FullImage_width,$FullImage_height));

         // вырезаем квадратную верхушку по y,
         // если фото вертикальное (хотя можно тоже серединку)
         if ($FullImage_width<$FullImage_height)
         imagecopyresampled($full_id, $img, 0, 0, 0, round((max($FullImage_width,$FullImage_height)-min($FullImage_width,$FullImage_height))/2), $new_width, $new_height,
                          min($FullImage_width,$FullImage_height), min($FullImage_width,$FullImage_height));

         // квадратная картинка масштабируется без вырезок
         if ($FullImage_width==$FullImage_height)
         imagecopyresampled($full_id, $img, 0, 0, 0, 0, $new_width, $new_height, $FullImage_width, $FullImage_height);



        if($imgtype == 'jpg'){
        $return_val = ( $full = ImageJPEG( $full_id, $new_image_file_path, 100 )
                                 && $return_val == 1 ) ? "1" : "0";
                                 }elseif($imgtype == 'gif'){
        $return_val = ( $full = ImageGIF( $full_id, $new_image_file_path)
                                 && $return_val == 1 ) ? "1" : "0";
                                         }elseif($imgtype == 'png'){
        $return_val = ( $full = ImagePNG( $full_id, $new_image_file_path)
                                 && $return_val == 1 ) ? "1" : "0";
                                                 }
        ImageDestroy( $full_id );
        return ($return_val) ? TRUE : FALSE ;
}




function resize_image2($image_file_path, $new_image_file_path, $imgtype, $new_width, $new_height)
{
        $return_val = 1;
        if($imgtype == 'jpg'){
        $return_val = ( (@$img = ImageCreateFromJPEG ( $image_file_path )) && $return_val == 1 ) ? "1" : "0";
                         //Если картинка gif.
                         }elseif($imgtype == 'gif'){
        $return_val = ( (@$img = imagecreatefromgif ($image_file_path )) && $return_val == 1 ) ? "1" : "0";
                                 //Если картинка png.
                                 }elseif($imgtype == 'png'){
        $return_val = ( (@$img = imagecreatefrompng ($image_file_path )) && $return_val == 1 ) ? "1" : "0";
                                         }
        $FullImage_width = imagesx ($img);
        $FullImage_height = imagesy ($img);
        if ( $new_width == $FullImage_width && $new_height == $FullImage_height )
                copy ( $image_file_path, $new_image_file_path );


if ($FullImage_width > $FullImage_height){

    $new_height = $FullImage_height * $new_width / $FullImage_width;
} else{
    $new_width  = $FullImage_width * $new_height / $FullImage_height;
      }
         $full_id = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled( $full_id, $img,
                                        0,0,  0,0,
                                        $new_width, $new_height,
                                        $FullImage_width, $FullImage_height );
        if($imgtype == 'jpg'){
        $return_val = ( $full = ImageJPEG( $full_id, $new_image_file_path, 100 )
                                 && $return_val == 1 ) ? "1" : "0";
                                 }elseif($imgtype == 'gif'){
        $return_val = ( $full = ImageGIF( $full_id, $new_image_file_path)
                                 && $return_val == 1 ) ? "1" : "0";
                                         }elseif($imgtype == 'png'){
        $return_val = ( $full = ImagePNG( $full_id, $new_image_file_path)
                                 && $return_val == 1 ) ? "1" : "0";
                                                 }
        ImageDestroy( $full_id );
        return ($return_val) ? TRUE : FALSE ;
}



function get_element_price($aid)
{
        $sql = "SELECT price FROM `shop` WHERE (id='".$aid."')";
        $s=mysql_query("$sql") or die(mysql_error());
        $f=mysql_fetch_array($s);
return $f['price'];
        }


function perpage_query($sql,$pcount)
{
if(eregi("page=", $_SERVER['REQUEST_URI'])){
        $pos=strrpos($_SERVER['REQUEST_URI'],"=");
        $lastext=substr($_SERVER['REQUEST_URI'],$pos+1);
        $_GET['page'] = $lastext;
}
if(!empty($_GET['page'])) {$page = $_GET['page'];}else {$page = 1;}
    $n_count = $pcount;
            $s=mysql_query("$sql") or die(mysql_error());
            $rows = mysql_num_rows($s);
    $get_count = $rows;
    $arofmetik = $get_count / $n_count;
//===============================
$sum_1 = $page * $n_count; //20 //10 //30
$oni = $sum_1 - 1;         //19 //9  //29
$sum_2 = $sum_1 - $n_count;//10 //0  //20
$ofi = $sum_2 - 1;         //9  //-1 //19
//===============================
       $per_1 = $sum_2;
       $per_2 = $oni;

$lim = "LIMIT ".$per_1.", ".$n_count."";
if(!empty($_GET['page']) and $_GET['page'] == "all"){$lim = '';}
$perpage_arr['page'] = $page;
$perpage_arr['arofmetik'] = $arofmetik;
$perpage_arr['lim'] = $lim;
$perpage_arr['rows'] = $rows;
return $perpage_arr;
        }

function perpage_view($arofmetik,$page)
{              global $content,$type_vis;
if(empty($type_vis)){$type_vis = 'page';}
        $view_line = '';
$arofmetik = ceil($arofmetik);

                $pplus = $page + 1;
                $pmin = $page - 1;


if($arofmetik > 1){
$counter = 0; $columns = 22;
$pcount24 = 0; $pcount24 = $page + 5;

if($page > 1 and $page <= $arofmetik){
$bi = 1;
$view_line .= '<a href="?'.$type_vis.'='.$pmin.'">Назад</a> <a href="?'.$type_vis.'=1">1</a> ';
}

for($i=0;$i<$arofmetik;$i++)
{
$i_plus = $i + 1; //$view_line .= $i_plus.'-'.$pcount24;
if($page <= $i_plus and $i_plus < $pcount24) {

$pr = ' ';
if ($counter != 0 && ($counter % $columns == 0)) {	$view_line .= ' ';
	}


if($i_plus == $arofmetik){$pr = '';}
        if($arofmetik == $i_plus)
        {
                if($page == $i_plus){$view_line .= '&nbsp;<span>'.$i_plus.'</span>&nbsp;'.$pr.'';}else {
                $view_line .= '&nbsp;<a href="?'.$type_vis.'='.$i_plus.'">'.$i_plus.'</a>&nbsp;'.$pr.'';}
                }
else {
                if($page == $i_plus){$view_line .= '&nbsp;<span>'.$i_plus.'</span>&nbsp;'.$pr.'';}else {
                $view_line .= '&nbsp;<a href="?'.$type_vis.'='.$i_plus.'">'.$i_plus.'</a>&nbsp;'.$pr.'';}
                }
                $counter++;

 }else {
 if(empty($line_t)){ $line_t = 1; } $counter++;
 }


}


if($arofmetik > $page){
if(empty($bi)){$view_line .= ' ';}
$view_line .= '<a href="?'.$type_vis.'='.$pplus.'">Cледующая</a>';}
}
       return ''.$view_line.'';
        }



function readframe($file) {
	if (! ($f = fopen($file, 'rb')) ) die("Unable to open " . $file);
    $res['filesize'] = filesize($file);
    do {
        while (fread($f,1) != Chr(255)) { // Find the first frame
        	if (feof($f))  die( "No mpeg frame found") ;
        }
        fseek($f, ftell($f) - 1); // back up one byte

        $frameoffset = ftell($f);

        $r = fread($f, 4);

        $bits = sprintf("%'08b%'08b%'08b%'08b", ord($r{0}), ord($r{1}), ord($r{2}), ord($r{3}));
    }
	while (!$bits[8] and !$bits[9] and !$bits[10]); // 1st 8 bits true from the while

    // Detect VBR header
    if ($bits[11] == 0) {
        if (($bits[24] == 1) && ($bits[25] == 1)) {
            $vbroffset = 9; // MPEG 2.5 Mono
        } else {
            $vbroffset = 17; // MPEG 2.5 Stereo
        }
    } else if ($bits[12] == 0) {
        if (($bits[24] == 1) && ($bits[25] == 1)) {
            $vbroffset = 9; // MPEG 2 Mono
        } else {
            $vbroffset = 17; // MPEG 2 Stereo
        }
    } else {
        if (($bits[24] == 1) && ($bits[25] == 1)) {
            $vbroffset = 17; // MPEG 1 Mono
        } else {
            $vbroffset = 32; // MPEG 1 Stereo
        }
    }

    fseek($f, ftell($f) + $vbroffset);
    $r = fread($f, 4);

    switch ($r) {
        case 'Xing':
            $res['encoding_type'] = 'VBR';
        case 'VBRI':
        default:
            if ($vbroffset != 32) {
                // VBRI Header is fixed after 32 bytes, so maybe we are looking at the wrong place.
                fseek($f, ftell($f) + 32 - $vbroffset);
                $r = fread($f, 4);

                if ($r != 'VBRI') {
                    $res['encoding_type'] = 'CBR';
                    break;
                }
            } else {
                $res['encoding_type'] = 'CBR';
                break;
            }

            $res['encoding_type'] = 'VBR';
    }

    fclose($f);

    if ($bits[11] == 0) {
        $res['mpeg_ver'] = "2.5";
        $bitrates = array(
            '1' => array(0, 32, 48, 56, 64, 80, 96, 112, 128, 144, 160, 176, 192, 224, 256, 0),
            '2' => array(0,  8, 16, 24, 32, 40, 48,  56,  64,  80,  96, 112, 128, 144, 160, 0),
            '3' => array(0,  8, 16, 24, 32, 40, 48,  56,  64,  80,  96, 112, 128, 144, 160, 0),
                 );
    } else if ($bits[12] == 0) {
        $res['mpeg_ver'] = "2";
        $bitrates = array(
            '1' => array(0, 32, 48, 56, 64, 80, 96, 112, 128, 144, 160, 176, 192, 224, 256, 0),
            '2' => array(0,  8, 16, 24, 32, 40, 48,  56,  64,  80,  96, 112, 128, 144, 160, 0),
            '3' => array(0,  8, 16, 24, 32, 40, 48,  56,  64,  80,  96, 112, 128, 144, 160, 0),
                 );
    } else {
        $res['mpeg_ver'] = "1";
        $bitrates = array(
            '1' => array(0, 32, 64, 96, 128, 160, 192, 224, 256, 288, 320, 352, 384, 416, 448, 0),
            '2' => array(0, 32, 48, 56,  64,  80,  96, 112, 128, 160, 192, 224, 256, 320, 384, 0),
            '3' => array(0, 32, 40, 48,  56,  64,  80,  96, 112, 128, 160, 192, 224, 256, 320, 0),
                 );
    }

    $layer = array(
        array(0,3),
        array(2,1),
              );
    $res['layer'] = $layer[$bits[13]][$bits[14]];

    if ($bits[15] == 0) {
        // It's backwards, if the bit is not set then it is protected.
        $res['crc'] = true;
    }

    $bitrate = 0;
    if ($bits[16] == 1) $bitrate += 8;
    if ($bits[17] == 1) $bitrate += 4;
    if ($bits[18] == 1) $bitrate += 2;
    if ($bits[19] == 1) $bitrate += 1;
    $res['bitrate'] = $bitrates[$res['layer']][$bitrate];

    $frequency = array(
        '1' => array(
            '0' => array(44100, 48000),
            '1' => array(32000, 0),
                ),
        '2' => array(
            '0' => array(22050, 24000),
            '1' => array(16000, 0),
                ),
        '2.5' => array(
            '0' => array(11025, 12000),
            '1' => array(8000, 0),
                  ),
          );
    $res['frequency'] = $frequency[$res['mpeg_ver']][$bits[20]][$bits[21]];

    $mode = array(
        array('Stereo', 'Joint Stereo'),
        array('Dual Channel', 'Mono'),
             );
    $res['mode'] = $mode[$bits[24]][$bits[25]];

    $samplesperframe = array(
        '1' => array(
            '1' => 384,
            '2' => 1152,
            '3' => 1152
        ),
        '2' => array(
            '1' => 384,
            '2' => 1152,
            '3' => 576
        ),
        '2.5' => array(
            '1' => 384,
            '2' => 1152,
            '3' => 576
        ),
    );
    $res['samples_per_frame'] = $samplesperframe[$res['mpeg_ver']][$res['layer']];

    if ($res['encoding_type'] != 'VBR') {
        if ($res['bitrate'] == 0) {
            $s = -1;
        } else {
            $s = ((8*filesize($file))/1000) / $res['bitrate'];
        }
        $res['length'] = sprintf('%02d:%02d',floor($s/60),floor($s-(floor($s/60)*60)));
        $res['lengthh'] = sprintf('%02d:%02d:%02d',floor($s/3600),floor($s/60),floor($s-(floor($s/60)*60)));
        $res['lengths'] = (int)$s;

        $res['samples'] = ceil($res['lengths'] * $res['frequency']);
        if(0 != $res['samples_per_frame']) {
            $res['frames'] = ceil($res['samples'] / $res['samples_per_frame']);
        } else {
            $res['frames'] = 0;
        }
        $res['musicsize'] = ceil($res['lengths'] * $res['bitrate'] * 1000 / 8);
    } else {
        $res['samples'] = $res['samples_per_frame'] * $res['frames'];
        $s = $res['samples'] / $res['frequency'];

        $res['length'] = sprintf('%02d:%02d',floor($s/60),floor($s-(floor($s/60)*60)));
        $res['lengthh'] = sprintf('%02d:%02d:%02d',floor($s/3600),floor($s/60),floor($s-(floor($s/60)*60)));
        $res['lengths'] = (int)$s;

        $res['bitrate'] = (int)(($res['musicsize'] / $s) * 8 / 1000);
    }

    return $res;
}
?>