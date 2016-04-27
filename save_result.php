<?php
	require_once ("setting.php"); //connection info 
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db); //creates connection
	if(isset($_POST['questionNo'])&&isset($_POST['testNumber'])&&isset($_POST['testAnswer'])){
		$questionNo = $_POST['questionNo'];
		$testNumber = $_POST['testNumber'];
		$testAnswer = $_POST['testAnswer'];
			
		//Query to update records table on user inputs
		$query = "UPDATE records
				SET total_runs = total_runs + 1 
				WHERE problem_id = $questionNo 
				AND test_number = $testNumber";
				
		$result = mysqli_query($conn, $query);
		
		$rows_updated = mysqli_affected_rows($conn);
		if($rows_updated == 0){
			$query = " insert into records values(
			 $questionNo
			,$testNumber
			,$testAnswer
			,1
			)";
			$result1 = mysqli_query($conn, $query);		
		}
		
		//query to get  total runs of test_number and Question
		$query = "SELECT total_runs
				FROM  records
				WHERE problem_id = $questionNo 
				AND test_number = $testNumber";
		
		$result2 = mysqli_query($conn, $query);
		if ($row = mysqli_fetch_assoc($result2)){
			$total_runs = $row['total_runs'];
		}
		// close the database connection
		mysqli_close($conn);
		//return total runs to Front-End
		echo json_encode(array('totalRuns' => $total_runs));
	}
	
?>	