<!-- Script that finds and displays data from database table, with option to delete each entry separately -->
<?php
	require 'connect.php';
	if(isset($_GET['criteria'])){
		if(!empty($_GET["criteria"])){  /* Display a warning message if no criteria are entered in the search field */
			$criteria = trim($_GET['criteria']);
			$criteria = mysqli_real_escape_string($conn, $criteria);
			/* Search entries in database table according to one entered criterion from the available ones */
			$query = "SELECT * FROM items WHERE iidn LIKE '%{$criteria}%' OR name LIKE '%{$criteria}%' OR type LIKE '%{$criteria}%' OR mark LIKE '%{$criteria}%'";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) > 0){  /* Display data if there are recorded entries in database table */
				while($row = mysqli_fetch_assoc($result)){
					$rowcount = mysqli_num_rows($result);
					?>
					<table>
						<tr>
							<td>ID:</td>
							<td>Name:</td>
							<td>Type:</td>
							<td>Mark:</td>
							<td>Quantity:</td>
							<td>Item</td>
						</tr>
						<tr>
							<td><?php echo $row['iidn']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['type']; ?></td>
							<td><?php echo $row['mark']; ?></td>
							<td><?php printf($rowcount); ?></td>
							<td><a href="database/remove.php?id=<?php echo $row["id"] ?>"><img src="images/delete.svg" style="width: 30px;" title="Remove item"></a></td>
						</tr>
					</table>
					<?php
				}
			}else{
				echo 'No data for that entry.'; /* Message displayed when there are no recorded entries in database table */
			}
		}else{
			echo 'Invalid data entry.';
		}
	}
?>