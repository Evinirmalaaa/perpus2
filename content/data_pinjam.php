 <?php 
function newDateFormatBack($date){
  $bulan = explode("-", $date)[1];
  $tanggal = intval(explode("-", $date)[2]);
  $tahun = explode("-", $date)[0];
  // return $bulan;
  if ($bulan=="01") {
    return $tanggal." Januari ".$tahun;
  }elseif ($bulan=="02") {
    return $tanggal." Februari ".$tahun;
  }elseif ($bulan=="03") {
    return $tanggal." Maret ".$tahun;
  }elseif ($bulan=="04") {
    return $tanggal." April ".$tahun;
  }elseif ($bulan=="05") {
    return $tanggal." Mei ".$tahun;
  }elseif ($bulan=="06") {
    return $tanggal." Juni ".$tahun;
  }elseif ($bulan=="07") {
    return $tanggal." Juli ".$tahun;
  }elseif ($bulan=="08") {
    return $tanggal." Agustus ".$tahun;
  }elseif ($bulan=="09") {
    return $tanggal." September ".$tahun;
  }elseif ($bulan=="10") {
    return $tanggal." Oktober ".$tahun;
  }elseif ($bulan=="11") {
    return $tanggal." November ".$tahun;
  }elseif ($bulan=="12") {
    return $tanggal." Desember ".$tahun;
  }else{
    return "Tanggal Error";
  }
}
 ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color:#ff597b;color:white;">
                                    <h6 class="m-0 font-weight-bold">Data Peminjaman</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"  data-toggle="modal" data-target="#modal-add" style="color:white;">
                                            <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dataTable table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                              <thead class="thead-dark text-center">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Kode Pinjam</th>
                                  <th scope="col">Buku</th>
                                  <th scope="col">Siswa</th>
                                  <th scope="col">Sampai</th>
                                  <th scope="col">HP/WA</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                      $sql = mysqli_query($conn,"
                                        SELECT a.*,b.*,c.*
                                        FROM `tb_pinjam` a 
                                        LEFT JOIN tb_buku b ON a.kode_buku = b.kode_buku
                                        LEFT JOIN tb_siswa c  ON a.nis = c.nis
                                        ORDER BY a.created_at DESC");
                                      $no=1;
                                      while ($data= mysqli_fetch_array($sql)) {
                                  ?>
                                <tr>
                                  <th scope="row" class="text-center"><?=$no++?></th>
                                  <td><?=$data['kode_pinjam']?></td>
                                  <td><?=$data['nama']?></td>
                                  <td><?=$data['judul']?></td>
                                  <td class="text-center"><?=newDateFormatBack($data['sampai'])?></td>
                                  <td class="text-center"><?=$data['hp']?></td>
                                  <td class="text-center">
                                    <?php 
                                      if ($data['status']=='0') {
                                        echo '<span class="badge badge-primary">Dipinjam</span>';
                                      }else{
                                        echo '<span class="badge badge-success">Dikembalikan</span>';
                                      }
                                    ?>
                                    
                                  </td>
                                  <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <?php
                                      if ($data['status']=='0') {
                                      ?>
                                      <a class="btn btn-success" title="Kembalikan peminjaman" href="proses/pinjam/p_kembalikan_data_pinjam.php?kode_pinjam=<?=$data['kode_pinjam']?>" role="button" onclick = "if (! confirm('Apakah Anda Yakin?')) { return false; }"><i class="fa fa-handshake"></i></a>
                                      <?php
                                      }
                                      ?>
                                      
                                      <button type="button" 
                                        class="btn btn-primary" 
                                        data-toggle="modal" 
                                        data-target="#modal-detail" 
                                        data-kode_pinjam="<?=$data['kode_pinjam']?>"
                                        data-kode_buku="<?=$data['kode_buku']?>"
                                        data-nis="<?=$data['nis']?>"
                                        data-sampai="<?=$data['sampai']?>"
                                        data-keterangan="<?=$data['keterangan']?>"
                                      >
                                        <i class="fa fa-eye"></i>
                                      </button>
                                      <button type="button" 
                                        class="btn btn-info" 
                                        data-toggle="modal" 
                                        data-target="#modal-edit" 
                                        data-kode_pinjam="<?=$data['kode_pinjam']?>"
                                        data-kode_buku="<?=$data['kode_buku']?>"
                                        data-nis="<?=$data['nis']?>"
                                        data-sampai="<?=$data['sampai']?>"
                                        data-hp="<?=$data['hp']?>"
                                        data-keterangan="<?=$data['keterangan']?>"
                                      >
                                        <i class="fa fa-edit"></i>
                                      </button>

                                      <a class="btn btn-danger" href="proses/pinjam/p_hapus_data_pinjam.php?kode_pinjam=<?=$data['kode_pinjam']?>" role="button" onclick = "if (! confirm('Apakah Anda Yakin?')) { return false; }"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                            </div>
                        </div>
                    </div>



<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" method="POST" action="proses/pinjam/p_tambah_data_pinjam.php" target="_SELF" onSubmit="return confirm('Apakah anda yakin akan menyimpan data?')" enctype="multipart/form-data">
      <div class="modal-body row">
        <?php 
                    $token = "";
                    $codeAlphabet= "0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ";
                    $alp = strlen($codeAlphabet) - 1;
                    for ($i=0; $i < 6; $i++) {
                      $token .= $codeAlphabet[mt_rand(0, $alp)];
                    }
                    $kode_pinjam = 'PJ'.$token;
        ?>
            <div class="form-group col-md-12">
              <label for="kode_pinjam">Kode Pinjam</label>
              <input type="text" class="form-control" id="kode_pinjam" name="kode_pinjam" value="<?=$kode_pinjam?>" readonly>
            </div>
            <div class="form-group col-md-12">
              <label for="nis">Siswa</label>
              <select class="form-control" id="nis" name="nis" style="width:100%;">
                <option value=""> Pilih Siswa</option>
                <?php
                  $ss = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_siswa` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($dd= mysqli_fetch_array($ss)) {
                ?>
                <option value="<?=$dd['nis']?>"><?=$dd['nis']?> | <?=$dd['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="kode_buku">Buku</label>
              <select class="form-control" id="kode_buku" name="kode_buku" style="width:100%;">
                <option value=""> Pilih Buku</option>
                <?php
                  $s = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_buku` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($d= mysqli_fetch_array($s)) {
                ?>
                <option value="<?=$d['kode_buku']?>"><?=$d['kode_buku']?> | <?=$d['judul']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="sampai">Pinjam Sampai Tanggal</label>
              <input type="date" class="form-control" id="sampai" name="sampai" placeholder="Pinjam Sampai Tanggal" required>
            </div>
            <div class="form-group col-md-6">
              <label for="hp">HP/WA</label>
              <input type="number" class="form-control" id="hp" name="hp" placeholder="HP/WA">
            </div>
            <div class="form-group col-md-12">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#modal-add').on('show.bs.modal', function (event) {
  
  $(this).find('.jk').select2()
  
})

</script>
<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" method="POST" action="proses/siswa/p_update_data_siswa.php" target="_SELF" onSubmit="return confirm('Apakah anda yakin akan menyimpan data?')" enctype="multipart/form-data">
      <div class="modal-body row">
            <div class="form-group col-md-12">
              <label for="kode_pinjam">Kode Pinjam</label>
              <input type="text" class="form-control" id="kode_pinjam" name="kode_pinjam" readonly>
            </div>
            <div class="form-group col-md-12">
              <label for="nis">Siswa</label>
              <select class="form-control" id="nis" name="nis" style="width:100%;">
                <option value=""> Pilih Siswa</option>
                <?php
                  $ss = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_siswa` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($dd= mysqli_fetch_array($ss)) {
                ?>
                <option value="<?=$dd['nis']?>"><?=$dd['nis']?> | <?=$dd['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="kode_buku">Buku</label>
              <select class="form-control " id="kode_buku" name="kode_buku" style="width:100%;">
                <option value=""> Pilih Siswa</option>
                <?php
                  $ss = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_buku` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($dd= mysqli_fetch_array($ss)) {
                ?>
                <option value="<?=$dd['kode_buku']?>"><?=$dd['kode_buku']?> | <?=$dd['judul']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="sampai">Pinjam Sampai Tanggal</label>
              <input type="date" class="form-control" id="sampai" name="sampai" placeholder="Pinjam Sampai Tanggal" required>
            </div>
            <div class="form-group col-md-6">
              <label for="hp">HP/WA</label>
              <input type="number" class="form-control" id="hp" name="hp" placeholder="HP/WA">
            </div>
            <div class="form-group col-md-12">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#modal-edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var kode_pinjam = button.data('kode_pinjam') // Extract info from data-* attributes
  var kode_buku = button.data('kode_buku')
  var nis = button.data('nis')
  var sampai = button.data('sampai')
  var hp = button.data('hp')
  var keterangan = button.data('keterangan')
  
  $(this).find('#kode_pinjam').val(kode_pinjam)
  $(this).find('#kode_buku').val(kode_buku).trigger("change");
  $(this).find('#nis').val(nis).trigger("change");
  $(this).find('#sampai').val(sampai)
  $(this).find('#hp').val(hp)
  $(this).find('#keterangan').val(keterangan)
  

})

</script>

<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
            <div class="form-group col-md-12">
              <label for="kode_pinjam">Kode Pinjam</label>
              <input type="text" class="form-control" id="kode_pinjam" name="kode_pinjam" readonly>
            </div>
            <div class="form-group col-md-12">
              <label for="nis">Siswa</label>
              <select class="form-control" id="nis" name="nis" style="width:100%;" disabled>
                <option value=""> Pilih Siswa</option>
                <?php
                  $ss = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_siswa` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($dd= mysqli_fetch_array($ss)) {
                ?>
                <option value="<?=$dd['nis']?>"><?=$dd['nis']?> | <?=$dd['nama']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="kode_buku">Buku</label>
              <select class="form-control " id="kode_buku" name="kode_buku" style="width:100%;" disabled>
                <option value=""> Pilih Siswa</option>
                <?php
                  $ss = mysqli_query($conn,"
                  SELECT a.*
                  FROM `tb_buku` a 
                  ORDER BY a.created_at DESC");
                                      
                  while ($dd= mysqli_fetch_array($ss)) {
                ?>
                <option value="<?=$dd['kode_buku']?>"><?=$dd['kode_buku']?> | <?=$dd['judul']?></option>
                <?php }?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="sampai">Pinjam Sampai Tanggal</label>
              <input type="date" class="form-control" id="sampai" name="sampai" placeholder="Pinjam Sampai Tanggal" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="hp">HP/WA</label>
              <input type="number" class="form-control" id="hp" name="hp" placeholder="HP/WA" readonly>
            </div>
            <div class="form-group col-md-12">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly></textarea>
            </div>
          
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#modal-detail').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var kode_pinjam = button.data('kode_pinjam') // Extract info from data-* attributes
  var kode_buku = button.data('kode_buku')
  var nis = button.data('nis')
  var sampai = button.data('sampai')
  var hp = button.data('hp')
  var keterangan = button.data('keterangan')
  
  $(this).find('#kode_pinjam').val(kode_pinjam)
  $(this).find('#kode_buku').val(kode_buku).trigger("change");
  $(this).find('#nis').val(nis).trigger("change");
  $(this).find('#sampai').val(sampai)
  $(this).find('#hp').val(hp)
  $(this).find('#keterangan').val(keterangan)
})

</script>