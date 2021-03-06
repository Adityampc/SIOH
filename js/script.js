"use strict"

load_news_list();
load_middle_content();

function load_news_list() {
    fetch('/all.php?length=5&type=json')
        .then(response => response.json())
        .then(data => {
            let news_list = document.getElementById('new-report');
            let list = '';
            data.forEach(element => {
                list += `<li><a href="javascript:void(0)" title="${element.nama} Umur ${element.umur} Tahun" onclick="load_middle_content('/detail.php?id=${element.id}')">${element.nama} (${element.umur})</a></li>`;
            });
            news_list.innerHTML = list;
        })
}
function load_middle_content(url = '/all.php') {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            let news_list = document.getElementById('middle-content');
            news_list.innerHTML = data;
        })
}

function create_report() {
    const formData = new FormData();
    const foto = document.querySelector('input[type="file"]');
    const itext = document.querySelectorAll('[class="itext"]');
    let err = false;
    itext.forEach(element => {
        if (element.value.length == 0) {
            err = true;
        }
        formData.append(element.name, element.value)
    });
    if (err) {
        alert("Mohon Isi Semua Kolom");
        return;
    }
    if (foto.files.length == 0) {
        alert('Mohon Masukkan Foto')
        return
    }
    formData.append('foto', foto.files[0])
    fetch('/save_report.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            alert(result.message)
            if (result.statusCode == 200) {
                foto.value = '';
                itext.forEach(element => {
                    element.value = '';
                });
                load_news_list()
            }
        })
        .catch(error => {
            alert("Ada masalah saat memproses data")
        });
}