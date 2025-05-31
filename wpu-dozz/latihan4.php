<!-- WPU Domzz (Tugas Video 4) -->
<?php 
$data = file_get_contents('coba.json');
$menu = json_decode($data, true)['menu'];
$kategori = ['All Menu', 'Pizza', 'Pasta', 'Nasi', 'Minuman'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <title>WPU Dozz</title>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <img src="img/LOGO1.png" alt="Logo" class="d-inline-block align-top" style="height: 40px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php foreach($kategori as $kat): ?>
              <a class="nav-item nav-link filter-button" href="#" data-kategori="<?= strtolower($kat); ?>"><?= $kat; ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </nav>

    <!-- Content -->
    <div class="container">
      <div class="row mt-3">
        <div class="col">
          <h1 id="judul">All Menu</h1>
        </div>
      </div>

      <div class="row" id="menu-list">
        <?php foreach ($menu as $row) : ?> 
          <div class="col-md-4 mb-3 menu-item" data-kategori="<?= strtolower($row['Kategori']); ?>">
            <div class="card">
              <img src="img/<?= $row['gambar']; ?>" class="card-img-top" alt="<?= $row['Nama pesanan']; ?>">
              <div class="card-body">
                <h5 class="card-title"><?= $row['Nama pesanan']; ?></h5>
                <p class="card-text"><?= $row['Topping']; ?></p>
                <h5 class="card-title">Rp. <?= number_format($row['Harga'], 0, ',', '.'); ?></h5>
                <button class="btn btn-primary pesan-button" 
                        data-nama="<?= $row['Nama pesanan']; ?>" 
                        data-harga="<?= number_format($row['Harga'], 0, ',', '.'); ?>">Pesan</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Modal Pesan -->
    <div class="modal fade" id="pesanModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form>
            <div class="modal-header">
              <h5 class="modal-title" id="judulPesanan">Pesan Menu</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Pesanan</label>
                <input type="text" class="form-control" id="namaPesanan" readonly>
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" id="hargaPesanan" readonly>
              </div>
              <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" class="form-control" placeholder="Masukkan Nama Anda">
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" placeholder="Masukkan Jumlah Pesanan" min="1" value="1">
              </div>
              <div class="form-group">
                <label>Catatan Tambahan</label>
                <textarea class="form-control" rows="2" placeholder="(Opsional)"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Kirim Pesanan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        // Filter kategori
        $('.filter-button').click(function(e) {
          e.preventDefault();
          let kategori = $(this).data('kategori');
          let judul = $(this).text();
          $('#judul').text(judul);

          $('.filter-button').removeClass('active');
          $(this).addClass('active');

          if (kategori == 'all menu') {
            $('.menu-item').show();
          } else {
            $('.menu-item').hide();
            $('.menu-item').each(function() {
              if ($(this).data('kategori') == kategori) {
                $(this).show();
              }
            });
          }
        });

        // Set default active button
        $('.filter-button[data-kategori="all menu"]').addClass('active');

        // Modal Pesan
        $('.pesan-button').click(function() {
          let nama = $(this).data('nama');
          let harga = $(this).data('harga');

          $('#namaPesanan').val(nama);
          $('#hargaPesanan').val('Rp. ' + harga);

          $('#pesanModal').modal('show');
        });
      });
    </script>
  </body>
</html>
