<?php

header('Content-Type: application/json');
$response = ['statusCode'=>200,'message'=>'Berhasil Membuat Laporan Orang Hilang'];
$target_dir = "images/user/";
$filename = time(). basename($_FILES["foto"]["name"]);
$target_file = $target_dir .$filename;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["foto"]["tmp_name"]);
if ($check !== FALSE) {
} else {
    $response = ['statusCode'=>403,'message'=>"Mohon Pilih Foto Dengan Benar"];
    echo json_encode($response);
    return;
}
// Check if file already exists
while (file_exists($target_file)) {
    $target_file = $target_dir .time(). basename($_FILES["foto"]["name"]);
}
// // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $response = ['statusCode'=>403,'message'=>"Maaf, Hanya Boleh File JPG, JPEG, PNG ."];
    echo json_encode($response);
    return;
}

if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $response = ['statusCode'=>403,'message'=>"Maaf, Ada masalah saat mengirim foto, silahkan coba lagi."];
    echo json_encode($response);
    return;
}
$last_data = json_decode(file_get_contents('data.json'), true);
$last_id = 1;
foreach ($last_data as $ld) {
    if ($ld['id'] > $last_id) {
        $last_id = $ld['id'];
    }
}
$data = [
    'id' => $last_id+1,
    'nama' => $_POST['nama'],
    'umur' => $_POST['umur'],
    'tgl_hilang' => $_POST['tgl_hilang'],
    'ket' => $_POST['ket'],
    'time' => date('Y-m-d H:i:s'),
    'foto' => $filename
];
$last_data[] = $data;
file_put_contents('data.json',json_encode($last_data));
echo json_encode($response);
