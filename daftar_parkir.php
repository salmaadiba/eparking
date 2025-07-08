<?php
session_start();
include 'src/koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$level = $_SESSION['level'] ?? 'petugas'; // Pastikan ada level
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h3 class="mb-3">Daftar Parkir</h3>

  <form class="row g-2 mb-3" method="get">
    <div class="col-md-3">
      <input type="text" name="plat" class="form-control" placeholder="Cari Plat Nomor" value="<?= htmlspecialchars($_GET['plat'] ?? '') ?>">
    </div>
    <div class="col-md-3">
      <input type="date" name="tgl" class="form-control" value="<?= htmlspecialchars($_GET['tgl'] ?? '') ?>">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary">Filter</button>
    </div>
  </form>

  <form method="post" action="hapus_parkir.php" onsubmit="return confirm('Yakin ingin menghapus data terpilih?')">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <?php if ($level === 'admin'): ?>
            <th><input type="checkbox" onclick="toggleCheckboxes(this)"></th>
          <?php endif; ?>
          <th>No</th>
          <th>Plat Nomor</th>
          <th>Jenis Kendaraan</th>
          <th>Waktu Masuk</th>
          <th>Waktu Keluar</th>
          <th>Petugas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $where = [];
      if (!empty($_GET['plat'])) {
        $p = $koneksi->real_escape_string($_GET['plat']);
        $where[] = "plat_nomor LIKE '%$p%'";
      }
      if (!empty($_GET['tgl'])) {
        $tgl = $koneksi->real_escape_string($_GET['tgl']);
        $where[] = "DATE(waktu_masuk) = '$tgl'";
      }

      $filter = $where ? "WHERE " . implode(" AND ", $where) : "";
      $query = "SELECT * FROM parkir $filter ORDER BY waktu_masuk DESC";
      $data = $koneksi->query($query);

      $no = 1;
      while ($row = $data->fetch_assoc()):
      ?>
        <tr>
          <?php if ($level === 'admin'): ?>
            <td><input type="checkbox" name="hapus_id[]" value="<?= $row['id'] ?>"></td>
          <?php endif; ?>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['plat_nomor']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
          <td><?= htmlspecialchars($row['waktu_masuk']) ?></td>
          <td><?= $row['waktu_keluar'] ? htmlspecialchars($row['waktu_keluar']) : '-' ?></td>
          <td>
            <?php
              if (!empty($row['waktu_keluar'])) {
                echo htmlspecialchars($row['petugas_keluar'] ?? '-') ?: '-';
              } else {
                echo htmlspecialchars($row['petugas_masuk'] ?? '-') ?: '-';
              }
            ?>
          </td>
          <td>
            <?php if (empty($row['waktu_keluar'])): ?>
              <a href="parkir_keluar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Keluar</a>
            <?php else: ?>
              <a href="struk.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Struk</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>

    <?php if ($level === 'admin'): ?>
      <button type="submit" class="btn btn-danger mt-2">Hapus Terpilih</button>
    <?php endif; ?>
  </form>

  <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

<script>
function toggleCheckboxes(source) {
  let checkboxes = document.querySelectorAll('input[name="hapus_id[]"]');
  checkboxes.forEach(chk => chk.checked = source.checked);
}
</script>

</body>
</html>
