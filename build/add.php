<html>
<head>
    <title>
        Insert Data
    </title>
    <style>
        .styled-table {
            border-collapse: collapse;
            width: 100%;
        }

        .styled-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        /* Kolom lebar otomatis sesuai panjang teks input */
        .styled-table .col-1 {
            width: 150px;
        }

        .styled-table .col-2 {
            width: 20px;
            text-align: center;
        }

        .styled-table .col-3 input {
            width: auto; /* Lebar otomatis */
            min-width: 60ch; /* Lebar minimum setara 10 karakter */
            max-width: 100%; /* Lebar maksimum 100% kolom */
        }

        .long-input {
            width: 40em; /* Lebar dua kali lipat dari ukuran default (20em) */
            padding: 5px; /* Tambahan padding agar lebih nyaman */
            font-size: 1em; /* Menyesuaikan font-size */
        }

        .center-align td {
            text-align: center;
        }
    </style>
</head>
<body>
<form method="post" action="insert.php">
    <table class="styled-table">
        <tr class="header-row">
            <td colspan="3" style="text-align: center;"><h3>DATA SISWA</h3></td>
        </tr>
        <tr>
            <td class="col-1">NIS</td>
            <td class="col-2">:</td>
            <td class="col-3">
                <input type="text" name="txtnis" class="long-input">
            </td>
        </tr>
        <tr>
            <td class="col-1">NAMA</td>
            <td class="col-2">:</td>
            <td class="col-3">
                <input type="text" name="txtnama" class="long-input">
            </td>
        </tr>
        <tr>
            <td class="col-1">UMUR</td>
            <td class="col-2">:</td>
            <td class="col-3">
                <input type="text" name="txtumur" class="long-input">
            </td>
        </tr>
        <tr>
            <td>SEKS</td>
            <td>:</td>
            <td>
                <input type="radio" name="rdoseks" value="PRIA">PRIA
                <input type="radio" name="rdoseks" value="WANITA">WANITA
            </td>
        </tr>
        <tr class="center-align">
            <td colspan="3">
                <input type="submit" value="INSERT">
                <INPUT type="reset" value="CANCEL">
                <?php
                echo "\t[<a href=view.php>VIEW DATA SISWA</a>]";
                ?>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
