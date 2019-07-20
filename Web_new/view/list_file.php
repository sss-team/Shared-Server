<?php
$extension_fic = array('bat', 'doc', 'docx', 'exe', 'gz', 'odt', 'pps', 'ppt', 'rar', 'tar', 'xls', 'xlsx', 'zip', 
'XML', 'sh', 'h', 'py', 'odp', 'ods', 'odg', 'pdf', 'txt', 'php', 'html');
$extension_image = array('bmp', 'gif', 'iso', 'jpeg', 'jpg', 'png', 'eps', 'psd', 'psp', 'tif', 'tiff');
$extension_audio = array('aac', 'mp3', 'wav', 'mid', 'AAC', 'aac');
$extension_video = array('avi', 'mkv', 'mov', 'mpg', 'qt', 'ra', 'ram', 'mp4', 'wmv', );

$extension_a_down = strtolower(substr(strrchr($name_file, '.'), 1));


if(strlen($name_file)>32)
{
    $name_file = str_replace('_', ' ', substr($name_file, 0, 28));
    $name_file = "$name_file...";
}
if(strlen($name_file)<=19)
{
    $name_file = substr($name_file, 0, 19);
    $name_file = "$name_file <br/>";
}
if(strlen($groupe_file)<=19)
{
    $groupe_file = substr($groupe_file, 0, 19);
    $groupe_file = "$groupe_file <br/>";
}
if(in_array($extension_a_down, $extension_fic)){
    echo '<div id="desc_fic"><img class="media-object" src="public/image/fic_new.png">'.$name_file.'<br/>
    Propriétaire: '.$user_name.'<br/>Groupe: '.$groupe_file.'<br/>Description:'.$description_file.'<br/>Upload: '.$date_upload_file.'
    <br/></div>';
    echo "<a href=\"$destination\">Download</a><br/><br/>";
}
elseif(in_array($extension_a_down, $extension_image)){
    echo '<div id="desc_fic"><img class="media-object" src="public/image/image_new.png">'.$name_file.'<br/>
    Propriétaire: '.$user_name.'<br/>Groupe: '.$groupe_file.'<br/>Description:'.$description_file.'<br/>Upload: '.$date_upload_file.'
    <br/></div>';
    echo "<a href=\"$destination\">Download</a><br/><br/>";
}
elseif(in_array($extension_a_down, $extension_audio)){
    echo '<div id="desc_fic"><img class="media-object" src="public/image/audio_new.png">'.$name_file.'<br/>
    Propriétaire: '.$user_name.'<br/>Groupe: '.$groupe_file.'<br/>Description:'.$description_file.'<br/>Upload: '.$date_upload_file.'
    <br/></div>';
    echo "<a href=\"$destination\">Download</a><br/><br/>";
}
elseif(in_array($extension_a_down, $extension_video)){
    echo '<div id="desc_fic"><img class="media-object" src="public/image/video_new.png">'.$name_file.'<br/>
    Propriétaire: '.$user_name.'<br/>Groupe: '.$groupe_file.'<br/>Description:'.$description_file.'<br/>Upload: '.$date_upload_file.'
    <br/></div>';
    echo "<a href=\"$destination\">Download</a><br/><br/>";
}
else{
    echo '<div id="desc_fic"><img class="media-object" src="public/image/autre_new.png">'.$name_file.'<br/>
    Propriétaire: '.$user_name.'<br/>Groupe: '.$groupe_file.'<br/>Description:'.$description_file.'<br/>Upload: '.$date_upload_file.'
    <br/></div>';
    echo "<a href=\"$destination\">Download</a><br/><br/>";
}