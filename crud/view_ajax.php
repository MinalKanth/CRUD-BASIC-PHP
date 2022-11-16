<?php
include 'config.php';

?>
<link href="../link/style.min.css" rel="stylesheet">
<div id="table" class="table table-responsive">
	<table id="zero_config" class="table table-striped table bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Position</th>
				<th>Address</th>
				<th>Dob</th>
				<th>Action</th>
			</tr>
		</thead>

		<?
		$sql = "SELECT * FROM tb1 ORDER BY id ASC";
		$res = mysqli_query($conn, $sql);

		if ($res->num_rows > 0) {
			while ($row = mysqli_fetch_array($res)) {
		?>
				<tr>
					<td><? echo $row['name'] ?></td>
					<td><? echo $row['profession'] ?></td>
					<td><? echo $row['country'] ?></td>
					<td><? echo $row['DOB']  ?></td>
					<td><a href="profile.php?id=<? echo $row['id'] ?>" class="btn btn-primary">View</a></td>
				</tr>
		<?php
			}
		} else {
			echo "0 results";
		}
		mysqli_close($conn);
		?>
		</tbody>

	</table>
</div>


<script src="../link/jquery.min_.js"></script>
<script src="../link/perfect-scrollbar.jquery.min.js"></script>
<script src="../link/datatables.min.js"></script>
<script src="../link/datatable-basic.init.js"></script>