<?php

$data = json_decode(file_get_contents('data.json'),true);
$result = [];
echo '<h3 align="center">Detail</h3><ul>';
foreach($data as $key=>$d)
{
    if($_GET['id']==$d['id'])
    {
        echo '<li><div class="time">'.$d['time'].'</div>
            <img class="user-image" align="middle" src="images/user/'.$d['foto'].'" alt="Foto '.$d['nama'].'">
            <div class="detail">
                <p>
                    Nama : '.$d['nama'].'<br>
                    Umur : '.$d['umur'].' Tahun<br>
                    Tanggal Hilang : '.$d['tgl_hilang'].'<br>
                </p>
            </div>
            <div class="ket">
            '.$d['ket'].'
            </div></li>';
            return;
        }
    }
    echo '</ul>';
echo '<p>Orang Tidak Ditemukan</p>';