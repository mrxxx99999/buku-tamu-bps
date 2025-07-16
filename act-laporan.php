<title>Form Print</title>
<?php
	include 'koneksi.php';
?>
	<style type="text/css">
		body {
			font-size: 12px!important;
			color: #212121;
		}
		.header {
			text-align: center;
			margin: -.5rem 0;
		}
		.text {
			font-size: 15px!important;
			font-weight: bold;
			text-transform: uppercase;
		}
		#table tr th {
			font-size: 11px;
	    }
		#table tr td {
			font-size: 10px;
		}
		#lead {
			width: auto;
			position: fixed;
			bottom: 0;
			right: 0 ;
			margin: 15px 0 0 75%;
			margin-right: auto;
		 }
		 .lead {

		 	font-weight: bold;
		 	text-decoration: underline;
		 	margin-bottom: -10px;
		 }
		hr {
			height: 5px;
			border: 0;
			border-top: 3px double #8c8c8c;
			box-shadow: 0 5px 5px -5px #8c8c8c inset;
		}
		#box{
			width: 150px;
			height: 90px;
			border : solid 1px;
			margin-bottom: 30px;
		}
	</style>

	


			<center> 
				<div id="box">
					<h4><strong>Laporan Data Tamu <br>
							Balai Diklat Keagamaan <br>
							Semarang</strong></h4>
				</div>
			</center>
			<table id="table" border="1" cellspacing="0" cellpadding="5" width="80%">
				<thead>
					<tr>
						<th width="1">No</th>
						<th>Tanggal</th>
						<th>Instansi</th>
						<th>Kepada</th>
						<th>Nama</th>
						<th>No Telepon</th>
						<th>Pesan</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$no = 1 ;
						if (isset($_GET['tanggal'])) {
							$tgl = $_GET['tanggal'];
							$sql = mysqli_query($host,"SELECT * FROM tamu WHERE date_created='$tgl'");
						}else{
							$sql = mysqli_query($host,"SELECT * FROM tamu ");
						}
							while($data = mysqli_fetch_array($sql)){?>
					<tr>

						<td width="1"><?php echo $no++; ?></td>
						<td><?php echo $data['date_created']?></td>
						<td><?php echo $data['instansi']?></td>
						<td><?php echo $data['kepada']?></td>
						<td><?php echo $data['nama']?></td>
						<td><?php echo $data['tlp']?></td>
						<td><?php echo $data['pesan']?></td>

					</tr>

				<?php } ?>
				</tbody>

			</table>
			<br>
			<div id="lead">
				<p>KA. BAGIAN TATA USAHA,<br>
					<div style="height: 50px"></div>
						<p class="lead">H.Darwiyanto,SPd.,M.,Ed</p>
						<p>NIP. 1967020519970310001</p>
					</div>
			</div>	
	</div>
	<script type="text/javascript">
		window.print();
	</script>
