<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Desa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat img {
            height: 100px;
            width: auto;
        }

        .kop-surat h1 {
            font-size: 20px;
            margin: 0;
        }

        .kop-surat h2 {
            font-size: 18px;
            margin: 0;
        }

        .kop-surat p {
            font-size: 14px;
            margin: 0;
        }

        .isi-surat {
            text-align: justify;
            line-height: 1.6;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .kop-surat {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
        <div class="kop-surat">
            <img src="logo-instansi.png" alt="Logo Instansi">
            <h1>SURAT PERNYATAAN KASBON</h1>
            <h1>KARYAWAN</h1>
            <p>Jl. Ipik Gandamanah No.303/15, Cisereuh, Kec Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118</p>
        </div>

        <div class="isi-surat">
            <p>Kepada Yth,</p>
            <p>HRD CV.MULTI GRAHA RADHIKA</p>
            <p>Jl. Ipik Gandamanah No.303/15,</p>
            <p> Cisereuh, Kec Purwakarta,</p>
            <p> Kabupaten Purwakarta, Jawa Barat 41118</p>
            <br>
            <p>
                Dengan hormat,<br>
                Saya yang bertandatangan di bawah ini : 
            </p>
            <div class="row">
                <div class="col-md-3">
                    <span>Nama</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="nama_employee_print"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <span>Jabatan</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="position_print"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <span>NIP</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="nip_print"></span>
                </div>
            </div>
            <br>
            <p>
               Dengan ini saya mengajukan permohonan kasbon sebesar Rp.<span id="amount_piutang"></span> untuk keperluan pribadi.
            </p>
            <br>
            <br>
            <p>
                Saya memahami bahwa jumlah kasbon ini akan dipotong dari gaji saya secara bertahap sesuai dengan kesepakatan antara saya dan perusahaan.
            </p>
            <br>
            <p>
                Adapun alasan pengajuan kasbon ini adalah sebagai berikut :
            </p>
            <p>
               "<span id="description_piutang_print"></span>"
            </p>
            <br> 
            <p>
                Akan saya kembalikan pada tanggal : <span id="tgl_lunas"></span>
            </p>
        </div>

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Hormat saya, </p>
                    
                    <br><br><br>
                    <p>(<span id="name_karyawan_ttd_print">)</span></p>
                    <p>Tanggal : <span id="piutang_date"></span></p>
                </div>                              
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Mengetahui, </p>
                    
                    <br><br><br>
                    <p>Amelia Gita Rahayu</span></p>
                    <p>Admin Finance</span></p>
                </div>                              
            </div>
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Mengetahui, </p>
                    
                    <br><br><br>
                    <p>Ara Suhara Sudrajat</span></p>
                    <p>HRD</span></p>
                </div>                              
            </div>
            
        </div>
        

</body>
</html>