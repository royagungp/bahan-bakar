<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        display: grid;
        justify-content: center;
    }
    .box{
        text-align: center;
    }
</style>
<body>
    <div class="box">
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        class sheell {
            public $jumlah;
            public $jenis;
            public $ppn;
            public $data_harga = [
                "S Super" => 15420,
                "S V-Power" => 16130,
                "S V-Power Diesel" => 18310,
                "S V-Power Nitro" => 16510
            ];

            public function __construct($jumlah, $jenis, $ppn) {
                $this->jumlah=$jumlah;
                $this->jenis=$jenis;
                $this->ppn=$ppn;
            }

            public function getJumlah() {
                return $this->jumlah;
            }
            
            public function getJenis() {
                return $this->jenis;
            }

            public function getTotal() {
                $harga_per_liter = $this->data_harga[$this->jenis];
                $total_tanpa_ppn = $harga_per_liter * $this->jumlah;
                $total_dengan_ppn = $total_tanpa_ppn * (1 + $this->ppn / 100);
                return $total_dengan_ppn;
            }
        }

        $meli = new sheell($_POST['jumlah'], $_POST['jenis'], $_POST['ppn']);
        $total = $meli->getTotal();
        echo "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br />";
        echo "Anda membeli bahan bakar minyak tipe".$meli->getJenis(). "<br>";
        echo "Dengan jumlah: ".$meli->getJumlah() . "Liter<br>";
        echo "Total yang harus anda bayar Rp.". number_format($total,0,',','.')."<br>";
        echo "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br />";
    }
    ?>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    masukan jumlah liter : <input type="number" name= "jumlah"><br>
    pilih bahan bakar :
        <select name="jenis">
            <option value="S Super">Shell Super</option>
            <option value="S V-Power">Shell V-Power</option>
            <option value="S V-Power Diesel">Shell V-Power Diesel</option>
            <option value="S Power Nitro">Shell Power Nitro</option>
        </select><br>
        <input type="submit" value= "meli">
        <input type="hidden" name= "ppn" value="0.10">
</form>
</body>
</html>