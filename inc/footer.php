<div class="container-fluid mt-5 pt-5">
    <div class="row my-5">
        <div class="col-md-8 mb-5" style="margin-bottom: 500px;">
			<div data-aos="zoom-in">
                <div class="gmap_canvas">
                    <iframe width="100%" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=P4OP&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
			</div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card" data-aos="zoom-in">
                <div class="card-body">
                    <h5>Statistik Pengunjung</h5>
                    <hr>
                    <table class="table table-responsive table-bordered w-100">
                        <tbody>
                            <tr>
                                <td>Hari Ini</td>
                                <td>:</td>
                                <td>
									<?php
									$queryPengunjungHariIni = mysqli_query($conn, "SELECT * FROM pengunjung WHERE visited_at='$date'");
									echo mysqli_num_rows($queryPengunjungHariIni);
									?>
								</td>
                            </tr>
                            <tr class="table-primary">
                                <td>Kemarin</td>
                                <td>:</td>
                                <td>
									<?php
									$kemarin = date('Y-m-d', strtotime('-1 day', strtotime($date))); // kurangi 1 hari dari tanggal sekarang
									$queryPengunjungKemarin = mysqli_query($conn, "SELECT * FROM pengunjung WHERE visited_at='$kemarin'");
									echo mysqli_num_rows($queryPengunjungKemarin);
									?>
								</td>
                            </tr>
                            <tr>
                                <td>Total Pengunjung</td>
                                <td>:</td>
                                <td>
									<?php
									$queryTotalPengunjung = mysqli_query($conn, "SELECT * FROM pengunjung");
									echo mysqli_num_rows($queryTotalPengunjung);
									?>
								</td>
                            </tr>
                            <tr class="table-primary">
                                <td>Sistem Operasi</td>
                                <td>:</td>
                                <td><?php echo $os_platform; ?></td>
                            </tr>
                            <tr class="table-primary">
                                <td>Browser</td>
                                <td>:</td>
                                <td><?php echo $browser; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5 pt-5">
				<div class="row">
					<div class="col-md-2 my-auto">
						<img src="<?php echo $baseUrl; ?>assets/images/logo_dki_jakarta.png" class="mb-3 me-5" width="65" height="80" alt="">
					</div>
					<div class="col-md-10">
						<h6 class="fw-bold">Pusat Pelayanan Pendanaan Personal dan Operasional Pendidikan (P4OP)</h6 class="fw-bold">
						<p class="">
							Jl. Jatinegara Timur IV No.55, Rawabunga, Jatinegara (Samping SMA Negeri 54 Jakarta) Jakarta Timur
							<br>Telp : (021) 8571012    
							<br>Fax : (021) 8516505
							<br>SMS Pengaduan : 089525767869
							<br>
							<div class="mt-3">
								<a href=""><i class="fa fa-whatsapp text-white" style="font-size: 36px;"></i></a>
								<a href="" class="ms-2"><i class="fa fa-instagram text-white" style="font-size: 36px;"></i></a>
							</div>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-7 pt-5">
				<div class="row">
					<div class="col-md-6">
						<h6 class="text-uppercase footer-title">Bansos Pendidikan</h6>
						<ul class="list-unstyled">
							<li><a href="" class="submenu-footer">KJP Plus</a></li>
							<li><a href="" class="submenu-footer">KJMU</a></li>
							<li><a href="" class="submenu-footer">BPMS</a></li>
							<li><a href="" class="submenu-footer">Beasiswa Anak Nokes</a></li>
						</ul>
					</div>
					<div class="col-md-6">
						<h6 class="text-uppercase footer-title">Kepegawaian</h6>
						<ul class="list-unstyled">
							<li><a href="" class="submenu-footer">Kasubag TU</a></li>
							<li><a href="" class="submenu-footer">Kasatpel Pendanaan Personal</a></li>
							<li><a href="" class="submenu-footer">Kasatpel Pendanaan Operasional</a></li>
						</ul>
					</div>
					<div class="col-md-6">
						<h6 class="text-uppercase footer-title">Hubungi Kami</h6>
						<ul class="list-unstyled">
							<li><a href="" class="submenu-footer">Profil P4OP</a></li>
							<li><a href="" class="submenu-footer">Form Pengaduan</a></li>
						</ul>
					</div>
					<div class="col-md-6">
						<h6 class="text-uppercase footer-title">Lainnya</h6>
						<ul class="list-unstyled">
							<li><a href="" class="submenu-footer">Berita & Pengumuman</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<hr class="" style="border: 0.5px solid #fff; opacity: 1;">
		<div class="text-center pb-2">
			<span class="text-white">&copy; 2022 Copyright P4OP. All Right Reserved</span>
		</div>
	</div>
</div>

	<!-- CKEDITOR -->
	<script>
		CKEDITOR.replace( 'form-ckeditor' );
	</script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?php echo $baseUrl; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>assets/aos/aos.js"></script>
    <script>
		AOS.init();
	</script>
    <script>
		window.onscroll = function() {myFunction()};

		var navbar = document.getElementById("navbar-2");

		var sticky = navbar.offsetTop;
		function myFunction() {
		  if (window.pageYOffset >= sticky) {
		    navbar.classList.add("sticky-top")
		  } else {
		    navbar.classList.remove("sticky-top");
		  }
		}
    </script>
  </body>
</html>