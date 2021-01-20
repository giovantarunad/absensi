		<!-- Begin Page Content -->
		<div class="container-fluid">

			<!-- Page Heading -->
			<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

			<span id="span" class="display-1 text-dark d-flex justify-content-center"></span>
			<div class="row">
				<div class="col-lg-8">
					<?= form_error('presensi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger" role="alert">
							<?= validation_errors(); ?>
						</div>
					<?php endif; ?>
					<?= $this->session->flashdata('message'); ?>
					<form action="<?= base_url('user/presensi') ?>" method="POST" id="presensi">
						<!-- <div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Pertanyaan</label>
							<div class="col-sm-10">
								<select name="pertanyaan" id="pertanyaaan" class="form-control">
									<option selected>Pilih Pertanyaan Dibawah Ini !</option>
									<?php foreach ($pertanyaan as $p) { ?>
									<option value="<?= $p['pertanyaan'] ?>"><?= $p['pertanyaan']; ?></option>
									<?php
									} ?>
								</select>
								<?= form_error('pertanyaan', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div> -->
						<div class="form-group row">
							<!-- <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label> -->
							<div class="col-sm-10">
								<!-- <input type="text" class="form-control" id="jawaban" name="jawaban" autocomplete="off"> -->
								<!-- <?= form_error('jawaban', '<small class="text-danger pl-3">', '</small>'); ?> -->

								<input type="hidden" class="form-control form-control-user" id="email" name="email" value="<?= $user['email']; ?>">
								<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

								<input type="hidden" class="form-control form-control-user" id="id_user" name="id_user" value="<?= $user['id']; ?>">
								<?= form_error('id_user', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<!-- <div id="my_camera"></div>
						<input type="hidden" id="image" name="image" value="">
						<input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
						<!-- <input type=button value="Save Snapshot" onClick="saveSnap()"> -->
						<!-- <div id="results"></div> -->
						<div class="form-group row">
							<div class="col-sm-10">
								<div id="my_camera">
								</div>
								<br>
								<!-- <p class="lead">NB : Wajib direload setelah submit gagal !</p> -->
								<button type="submit" class="btn btn-primary">Absen</button>
								<!-- <button type="submit" onclick="document.location.reload(true)"
									class="btn btn-warning">Reload</button> -->
							</div>
						</div>
						<br><br>
						<br>
					</form>
					<form action="<?= base_url('user/presensi') ?>" method="POST" id="cari">
						<div class="form-group row">
							<div class="col-sm-10">
								<input type="date" class="form-contorl" name="startdate" placeholder="Start Date">
								<input type="date" class="form-contorl" name="enddate" placeholder="End Date">
								<button type="submit" class="btn btn-primary" id="cari">Cari</button>
							</div>
						</div>
					</form>
					<table class="table table-bordered table-striped" id="dataTables" width="100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama </th>
								<th scope="col">Tanggal</th>
								<th scope="col">Status</th>
								<th scope="col">Kelas</th>
								<th scope="col">Image</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($presensi as $p) : ?>
								<tr>
									<th scope="row"><?= $i; ?></th>
									<td><?= $p['nama_depan'] . " " . $p['nama_belakang']; ?></td>
									<td><?= $p['tanggal']; ?></td>
									<td><?= $p['status']; ?></td>
									<td><?= $p['kelas']; ?></td>
									<td><img src="<?= base_url() . '/uploads' . '/' . $p['image']; ?>" alt="" srcset=""></td>
								</tr>
								<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->

		</div>

		<script lang="text/javascript">
			var span = document.getElementById('span');

			function time() {
				var d = new Date();
				var s = d.getSeconds();
				var m = d.getMinutes();
				var h = d.getHours();
				span.textContent = h + ":" + m + ":" + s;
			}

			setInterval(time, 1000);
		</script>

		<!-- Code to handle taking the snapshot and displaying it locally -->
		<script type="text/javascript">
			$('#presensi').on('submit', function(event) {
				event.preventDefault();
				var image = '';
				Webcam.snap(function(data_uri) {
					image = data_uri;
				});
				$.ajax({
						url: '<?php echo site_url("user/presensi"); ?>',
						type: 'POST',
						dataType: 'json',
						data: {
							image: image
						},
					})
					.done(function(data) {
						if (data > 0) {
							alert('insert data sukses');
							$('#presensi')[0].reset();
						}
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
			});
		</script>



		<!-- End of Main Content -->
		