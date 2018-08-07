<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left info" style="position: initial;">
          <p>
          <?php echo $_SESSION['name'];;?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="?menu=home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li ><a href="transaksi.php?menu=home"><i class='fa fa-money'></i> <span>Transaksi</span></a></li>

        <?php if($_SESSION['role']=='pemilik'||$_SESSION['role']=='admin') {?>
        <li class="treeview">
            <a href="#"><i class='fa fa-link'></i> <span>Barang</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="?menu=addbarang">Tambah Barang</a></li>
                <li><a href="?menu=listbarang">List Barang</a></li>
                <li><a href="?menu=category">Category</a></li>
                <li><a href="?menu=subcategory">Sub Category</a></li>
                <li><a href="?menu=stok&id=0">Stok</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class='fa fa-table'></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="?menu=lappenjualan&tanggal=">Laporan Penjualan</a></li>
                <li><a href="?menu=lapkeuangan&tanggal=">Laporan Harian</a></li>
                <li><a href="?menu=lapbulanan&tanggal=">Laporan Bulanan</a></li>
                <!--<li><a href="?menu=laplabarugi&tanggal=">Laporan Laba Rugi</a></li>-->
                <!--<li><a href="?menu=lapgaji&tanggal=">Laporan Gaji</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class='fa fa-table'></i> <span>Log</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="?menu=logharga&tanggal=">Log Harga Barang</a></li>
                <li><a href="?menu=logstok&tanggal=">Log Stok</a></li>
                <li><a href="?menu=loguser&tanggal=">Log User</a></li>
                <li><a href="?menu=logvalidasi&tanggal=">Log Validasi</a></li>
            </ul>
        </li>
        <li>
          <a href="?menu=user&id=0">
            <i class="fa fa-user"></i> <span>Pegawai</span>
          </a>
        </li>
        <li>
          <a href="?menu=member&id=0">
            <i class="fa fa-user"></i> <span>Member</span>
          </a>
        </li>
        <li>
          <a href="?menu=setting&id=0">
            <i class="fa fa-user"></i> <span>Setting</span>
          </a>
        </li>
        <?php } elseif ($_SESSION['role']=='kasir') { ?>
        <li>
          <a href="?menu=stok&id=0">
            <i class="fa fa-link"></i> <span>Stok</span>
          </a>
        </li>
        <li class="treeview">
            <a href="#"><i class='fa fa-table'></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="?menu=lappenjualan&tanggal=">Laporan Penjualan</a></li>
                <li><a href="?menu=lapkeuangan&tanggal=">Laporan Harian</a></li>
                <li><a href="?menu=lapbulanan&tanggal=">Laporan Bulanan</a></li>
                <!--<li><a href="?menu=laplabarugi&tanggal=">Laporan Laba Rugi</a></li>-->
                <!--<li><a href="?menu=lapgaji&tanggal=">Laporan Gaji</a></li>-->
            </ul>
        </li>
        <li>
          <a href="?menu=member&id=0">
            <i class="fa fa-user"></i> <span>Member</span>
          </a>
        </li>
        <?php } ?>
        <li ><a href="?menu=omset&ket=0"><i class='fa fa-money'></i> <span>Input Omset</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>