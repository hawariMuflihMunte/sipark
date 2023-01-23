<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>

<form action="./veh.in.add.php" method="post" id="add-vehicle">
    <input type="hidden" name="id_petugas" value="<?= $_SESSION['id'] ?>">
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text">Jenis Kendaraan</span>
        <input
            type="text"
            name="jenis_kendaraan"
            id="jenis_kendaraan"
            required
            value="<?= ucwords($_REQUEST['jenis_kendaraan']) ?>"
            class="form-control "
            readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text">Nomor Polisi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <input
            type="text"
            name="nomor_polisi"
            id="nomor_polisi"
            required
            value="<?= $_REQUEST['nomor_polisi'] ?>"
            class="form-control"
            readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text">Waktu Masuk&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <input
            type="text"
            name="waktu_masuk"
            id="waktu_masuk"
            required
            value="<?= $_REQUEST['waktu_masuk'] ?>"
            class="form-control"
            readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text">Biaya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <span class="input-group-text">Rp</span>
        <input
            type="text"
            name="biaya"
            id="biaya"
            required
            <?php
            
                $jenis_kendaraan = $_REQUEST['jenis_kendaraan'];

                $sql = "SELECT
                    biaya_parkir
                FROM
                    tagihan
                WHERE
                    jenis_kendaraan = '$jenis_kendaraan'
                ;";
                $query = mysqli_query($connection, $sql);
                list($result) = mysqli_fetch_array($query);               

            ?>
            value="<?= $result ?>"
            class="form-control"
            readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span class="input-group-text">Petugas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <input
            type="text"
            name="petugas"
            id="petugas"
            required
            value="<?= $_SESSION['name'] ?>"
            class="form-control"
            readonly>
    </div>
    <div class="d-flex justify-content-between">
        <span></span>
        <div>
            <button type="button" onclick="window.print()" class="btn btn-info btn-sm no-print">
                <i class="bi bi-printer"></i>
            </button>
            <button type="submit" class="btn btn-success btn-sm no-print"><i class="bi bi-check-lg"></i></button>
        </div>
    </div>
    <script defer>
        const addVehicle = document.getElementById('add-vehicle')

        addVehicle.addEventListener('submit', (event) => {
            event.returnValue = false

            Swal.fire({
                text: "Yakin ingin memasukkan kendaraan ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    addVehicle.submit()
                }
            })
        })
    </script>
</form>