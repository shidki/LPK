<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Transkip Nilai</title>
    <style media="screen">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
        }
        /*
            These next two styles are apparently the modern way to clear a float. This allows the logo
            and the word "Invoice" to remain above the From and To sections. Inserting an empty div
            between them with clear:both also works but is bad style.
            Reference:
            http://stackoverflow.com/questions/490184/what-is-the-best-way-to-clear-the-css-style-float
        */
        
        header:before,
        header:after {
            content: " ";
            display: table;
        }
        
        header:after {
            clear: both;
        }
        
        .invoiceNbr {
            font-size: 40px;
            margin-right: 30px;
            margin-top: 30px;
            float: right;
        }
        
        .logo {
            float: left;
        }
        
        .from {
            float: left;
        }
        
        .to {
            float: right;
        }
        
        .fromto {
            border-style: solid;
            border-width: 1px;
            border-color: #e8e5e5;
            border-radius: 5px;
            margin: 20px;
            min-width: 200px;
        }
        
        .fromtocontent {
            margin: 10px;
            margin-right: 15px;
        }
        
        .panel {
            background-color: #e8e5e5;
            padding: 7px;
        }
        
        .items {
            clear: both;
            display: table;
            padding: 20px;
        }
        /* Factor out common styles for all of the "col-" classes.*/
        
        div[class^="col-"] {
            display: table-cell;
            padding: 7px;
        }
        /*for clarity name column styles by the percentage of width */
        
        .col-1-10 {
            width: 10%;
        }
        
        .col-1-52 {
            width: 52%;
        }
        
        .row {
            display: table-row;
            page-break-inside: avoid;
        }
    </style>

    <!-- These styles are exactly like the screen styles except they use points (pt) as units
        of measure instead of pixels (px) -->
    <style media="print">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
        }
        
        header:before,
        header:after {
            content: " ";
            display: table;
        }
        
        header:after {
            clear: both;
        }
        
        .invoiceNbr {
            font-size: 30pt;
            margin-right: 30pt;
            margin-top: 30pt;
            float: right;
        }
        
        .logo {
            float: left;
        }
        
        .from {
            float: left;
        }
        
        .to {
            float: right;
        }
        
        .fromto {
            border-style: solid;
            border-width: 1pt;
            border-color: #e8e5e5;
            border-radius: 5pt;
            margin: 20pt;
            min-width: 200pt;
        }
        
        .fromtocontent {
            margin: 10pt;
            margin-right: 15pt;
        }
        
        .panel {
            background-color: #e8e5e5;
            padding: 7pt;
        }
        
        .items {
            clear: both;
            display: table;
            padding: 20pt;
        }
        
        div[class^="col-"] {
            display: table-cell;
            padding: 7pt;
        }
        
        .col-1-10 {
            width: 10%;
        }
        
        .col-1-52 {
            width: 52%;
        }
        
        .row {
            display: table-row;
            page-break-inside: avoid;
        }
    </style>

</head>

<body>
    <header>
        <div class="" style="text-align: center; margin-bottom: 50px;">
            <img src="{{ public_path('dashboard/img/logo.png') }}" alt="LPK CIPTA KERJA LOGO" height="181" width="167" />
        </div>
    </header>

    <div class="fromto from">
        <div class="panel">Informasi Siswa</div>
        <div class="fromtocontent">
            <span style="margin-bottom: 10px; display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:20%;">Nama</span> <span  style="width: 5%;">:</span> <span  style="width: 70%;"> <br>{{ $nama }}</span></span> <hr />
            <span style="margin-bottom: 10px; display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:20%;">Email</span> <span  style="width: 5%;">:</span> <span  style="width: 70%;"><br>{{ $email }}</span></span><hr />
            <span style="margin-bottom: 10px; display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:20%;">No Hp</span> <span  style="width: 5%;">:</span> <span  style="width: 70%;"><br>{{ $no_hp }}</span></span><hr />
            <span style="display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:20%;">Alamat</span> <span  style="width: 5%;">:</span> <span  style="width: 70%;"><br>{{ $alamat }}</span></span><br />
        </div>
    </div>
    <div class="fromto to">
        <div class="panel">Informasi Kelas</div>
        <div class="fromtocontent">
			<span style="margin-bottom: 10px; display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:40%">Kelas</span> <span  style="width: 5%;">:</span> <span  style="width: 65%;"> <br>{{ $kelas }}</span></span><hr />
			<span style=" display: flex; align-items: center ;justify-content: space-between; width: 100%;"><span style="display: inline-block;width:40%;">Instruktur</span> <span  style="width: 5%;">:</span> <span  style="width: 65%;"> <br>{{ $instruktur }}</span></span><hr />
        </div>
    </div>

    <section class="items" style="width: 100%;">

        <!-- your favorite templating/data-binding library would come in handy here to generate these rows dynamically !-->
        <div class="row">
            <div class="col-1-10 panel">
                No
            </div>
            <div class="col-1-52 panel">
                Kategori Nilai
            </div>
            <div class="col-1-10 panel">
                Nilai
            </div>
        </div>
		@if (empty($transkip))
            @foreach ($komp_nilai as $item )
            <div class="row">
                <div class="col-1-10">
                    {{ $loop->iteration}}
                </div>
                <div class="col-1-52">
                    {{ $item['Kategori_Nilai'] }}
                </div>
                <div class="col-1-10">
                    -
                </div>
            </div>
            @endforeach
        @else
        @php
        $totalNilai = 0;
    	@endphp
		@foreach ($transkip  as $item )
            @php
            // Hanya tambahkan nilai proporsi ke $totalNilai
            $totalNilai += ($item['nilai'] * ($item['proporsi'] / 100));
            @endphp
            <div class="row">
                <div class="col-1-10">
                    {{ $loop->iteration}}
                </div>
                <div class="col-1-52">
                    {{ $item['Kategori_Nilai'] }}
                </div>
                <div class="col-1-10">
                    {{ $item['nilai'] }}
                </div>
            </div>
		@endforeach
        <div class="row">
            <div class="col-1-10 panel">

            </div>
            <div class="col-1-10 panel">
                Nilai Keseluruhan
            </div>
            <div class="col-1-10 panel">
                {{ number_format($totalNilai, 2) }}
            </div>
        </div>
        @endif
    </section>
	
	<div id="TtdContainer" style="width: 100%; margin-top: 30px; display: flex; justify-content: space-between; align-items: flex-start;">
	</div>
	<div id="kiri" style="float: right;margin-right: 20px;">
		<div>Kepala LPK Cipta Kerja  DPN Perkasa Jateng,</div>
		<div style="margin-bottom: 100px;"></div>
		<hr style="width: 100%; margin-left: auto; margin-right: 0;">
        <div style="text-align: center">Ir. Muhamad Ridwan Ash'shidqi S.Kom</div>
	</div>
</body>

</html>