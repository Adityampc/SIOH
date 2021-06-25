<?php

$data = json_decode(file_get_contents('data.json'),true);
$result = [];
rsort($data);
foreach($data as $key=>$d)
{
    if(isset($_GET['length']))
    {
        if($key == $_GET['length'])
        {
            break;
        }
    }
    if(isset($_GET['query']))
    {
        if($_GET['query'])
        {
            if (strpos(strtolower($d['nama']), strtolower($_GET['query'])) !== false) {
                $result[] = $d;
            }
            continue;
        }
    }
    $result[] = $d;
}
if(isset($_GET['type']))
{
    if($_GET['type']=='json')
    {
        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }
}
echo '<h3 align="center">Berita</h3><ul>';
if(!$result)
{
    echo 'Orang Tidak Ditemukan '.($_GET['query']??'');
}
foreach($result as $r)
{
    echo '<li><div class="time">'.$r['time'].'</div>
        <img class="user-image" align="middle" src="images/user/'.$r['foto'].'" alt="Foto '.$r['nama'].'">
        <div class="detail">
            <p>
                Nama : '.$r['nama'].'<br>
                Umur : '.$r['umur'].' Tahun<br>
                Tanggal Hilang : '.$r['tgl_hilang'].'<br>
            </p>
        </div>
        <div class="ket">
        '.$r['ket'].'
        </div></li>';
        
}
echo '</ul>';