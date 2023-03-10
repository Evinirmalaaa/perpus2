

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color:#ff597b;color:white;">
                                    <h6 class="m-0 font-weight-bold">Data Siswa</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"  data-toggle="modal" data-target="#modal-add" style="color:white;">
                                            <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                        <div class="card-body">
                            <!-- <div class="table-responsive"> -->
                                <table class="table dataTable table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Foto</th>
                                  <th scope="col">NIS</th>
                                  <th scope="col">Nama Siswa</th>
                                  <th scope="col">Jenis Kelamin</th>
                                  <th scope="col">Kelas</th>
                                  <th scope="col">Alamat</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                      $sql = mysqli_query($conn,"
                                        SELECT *
                                        FROM `tb_siswa` 
                                        ORDER BY created_at DESC");
                                      $no=1;
                                      while ($data= mysqli_fetch_array($sql)) {
                                  ?>
                                <tr>
                                  <th scope="row" class="text-center"><?=$no++?></th>
                                  <td>
                                    <img src="uploads/img/siswa/<?=$data['foto']?>" style="width:50px;height:auto;">
                                  </td>
                                  <td><?=$data['nis']?></td>
                                  <td><?=$data['nama']?></td>
                                  <td><?=$data['jk']?></td>
                                  <td  class="text-center"><?=$data['kelas']?></td>
                                  <td><?=$data['alamat']?></td>
                                  <td class="text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <button type="button" 
                                        class="btn btn-primary" 
                                        data-toggle="modal" 
                                        data-target="#modal-detail" 
                                        data-id_siswa="<?=$data['id_siswa']?>"
                                        data-nis="<?=$data['nis']?>"
                                        data-nama="<?=$data['nama']?>"
                                        data-jk="<?=$data['jk']?>"
                                        data-kelas="<?=$data['kelas']?>"
                                        data-alamat="<?=$data['alamat']?>"
                                        data-img="<?=$data['foto']?>"
                                      >
                                        <i class="fa fa-eye"></i>
                                      </button>
                                      <button type="button" 
                                        class="btn btn-info" 
                                        data-toggle="modal" 
                                        data-target="#modal-edit" 
                                        data-id_siswa="<?=$data['id_siswa']?>"
                                        data-nis="<?=$data['nis']?>"
                                        data-nama="<?=$data['nama']?>"
                                        data-jk="<?=$data['jk']?>"
                                        data-kelas="<?=$data['kelas']?>"
                                        data-alamat="<?=$data['alamat']?>"
                                        data-img="<?=$data['foto']?>"
                                      >
                                        <i class="fa fa-edit"></i>
                                      </button>

                                      <a class="btn btn-danger" href="proses/siswa/p_hapus_data_siswa.php?id_siswa=<?=$data['id_siswa']?>" role="button" onclick = "if (! confirm('Apakah Anda Yakin?')) { return false; }"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>



<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" method="POST" action="proses/siswa/p_tambah_data_siswa.php" target="_SELF" onSubmit="return confirm('Apakah anda yakin akan menyimpan data?')" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
            <div class="form-group col-md-6">
              <label for="nis">Nomor Induk Siswa</label>
              <input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" required>
            </div>            
            <div class="form-group col-md-6">
              <label for="nama">Nama Siswa</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Siswa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="pengarang">Jenis Kelamin</label>
              <select class="form-control" id="jk" name="jk">
                <option value=""> Pilih jenis kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>

            </div>
            <div class="form-group col-md-6">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
            </div>
            <div class="form-group col-md-12">
              <label for="keterangan">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
              <label for="img">Gambar Buku</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="img" name="img" accept=".jpg,.jpeg,.png" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" required>
                <label class="custom-file-label" for="img">Choose file</label>
              </div>
            </div>
            
            </div>
          </div>
          <div class="col-md-6">
           <img style="width:100%;height:auto;" id="blah" alt="Gamabar Buku" width="100" height="100">
          </div>
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
<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" method="POST" action="proses/siswa/p_update_data_siswa.php" target="_SELF" onSubmit="return confirm('Apakah anda yakin akan menyimpan data?')" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
            <div class="form-group col-md-6">
              <label for="nis">Nomor Induk Siswa</label>
              <input type="hidden" name="id_siswa" id="id_siswa">
              <input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" required>
            </div>            
            <div class="form-group col-md-6">
              <label for="nama">Nama Siswa</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Siswa" required>
            </div>
            <div class="form-group col-md-6">
              <label for="pengarang">Jenis Kelamin</label>
              <select class="form-control" id="jk" name="jk">
                <option value=""> Pilih jenis kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>

            </div>
            <div class="form-group col-md-6">
              <label for="kelas">Kelas</label>
              <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
            </div>
            <div class="form-group col-md-12">
              <label for="keterangan">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
              <label for="img">Gambar Buku</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="img" name="img" accept=".jpg,.jpeg,.png" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" >
                <label class="custom-file-label" for="img">Choose file</label>
              </div>
              <small id="help" class="form-text text-muted">Kosongkan jika tidak ingin merubah gambar.</small>
            </div>
            
            </div>
          </div>
          <div class="col-md-6">
           <img style="width:100%;height:auto;" id="blah2" alt="Gamabar Buku" width="100" height="100">
          </div>
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
  var id_siswa = button.data('id_siswa') // Extract info from data-* attributes
  var nis = button.data('nis')
  var nama = button.data('nama')
  var jk = button.data('jk')
  var kelas = button.data('kelas')
  var alamat = button.data('alamat')
  var img = button.data('img')
  
  $(this).find('#id_siswa').val(id_siswa)
  $(this).find('#nis').val(nis)
  $(this).find('#nama').val(nama)
  $(this).find('#jk').val(jk)
  $(this).find('#kelas').val(kelas)
  $(this).find('#alamat').val(alamat)
  $(this).find('#blah2').attr('src','uploads/img/siswa/'+img)
  
})

</script>

<!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="kode_buku">Kode Buku</label>
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="" readonly>
              </div>            
              <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="pengarang">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Pengarang Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="penerbit">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="tahun">Tahun Terbit</label>
                <input type="number" maxlength="4" min="1900" class="form-control" id="tahun" name="tahun" placeholder="Tahun Terbit Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="img">Gambar Buku</label>
                <input type="text" class="form-control" id="img" name="tahun" placeholder="Tahun Terbit Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="baris_rak">Baris Rak</label>
                <input type="number" class="form-control" id="baris_rak" name="baris_rak" placeholder="Baris Rak Buku" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="nomor_rak">Nomor Rak</label>
                <input type="number" class="form-control" id="nomor_rak" name="nomor_rak" placeholder="Nomor Rak Buku" readonly>
              </div>
              <div class="form-group col-md-12">
                <label for="keterangan">Keterangan Buku</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" readonly></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-6">
           <img style="width:100%;height:auto;" id="imgg">
          </div>
        </div>
            
          
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#modal-detail').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var kode_buku = button.data('kode_buku') // Extract info from data-* attributes
  var judul = button.data('judul')
  var pengarang = button.data('pengarang')
  var penerbit = button.data('penerbit')
  var tahun = button.data('tahun')
  var baris_rak = button.data('baris_rak')
  var nomor_rak = button.data('nomor_rak')
  var keterangan = button.data('keterangan')
  var img = button.data('img')
  
  $(this).find('#kode_buku').val(kode_buku)
  $(this).find('#judul').val(judul)
  $(this).find('#pengarang').val(pengarang)
  $(this).find('#penerbit').val(penerbit)
  $(this).find('#tahun').val(tahun)
  $(this).find('#baris_rak').val(baris_rak)
  $(this).find('#nomor_rak').val(nomor_rak)
  $(this).find('#keterangan').val(keterangan)
  $(this).find('#img').val(img)
  $(this).find('#imgg').attr('src','uploads/img/buku/'+img)
})

</script>