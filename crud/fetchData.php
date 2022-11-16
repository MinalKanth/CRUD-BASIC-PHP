
		<?
        include 'config.php';
		 $sql1 = "SELECT reg.*, countries.name as country, states.name as state, cities.name as city 
		 from reg
		 Inner join countries on reg.country = countries.id
		 Inner join states on reg.state= states.id
		 Inner join cities on reg.city = cities.id";
		$res1 = mysqli_query($conn, $sql1);

		//create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($res1))
        {
            $emparray[] = $row;
        }
    
        print_r($emoarray[]);
        echo json_encode($emparray);

		?>
		</tbody>

	</table>