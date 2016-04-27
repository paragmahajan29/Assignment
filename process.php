<?php
/*
 Author:Parag Mahajan
 Title: process.php
 This file creates table (if not created), adds questions into database and returns questions to UI 
 */
 
	require_once ("setting.php"); //connection info 
	
	if(isset($_POST['getQuestions'])){
		//Below lines of code execute only one time to create tables if not present and adds 3 questions to problem table, as of now.
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db); //creates connection
		$sql_table="problems";
		$query = "show tables like '$sql_table'";
		$result = @mysqli_query($conn, $query);
		if(mysqli_num_rows($result)==0) {
			$fieldDefinition="problem_id INT AUTO_INCREMENT
							, problem_name VARCHAR(30) NOT NULL
							, problem_desc VARCHAR(500) NOT NULL
							, no_of_inputs INT
							,PRIMARY KEY(problem_id)
							";
			$query = "create table " . $sql_table . "(" . $fieldDefinition . ")";
			$result2 = @mysqli_query($conn, $query);
			
			$query = "INSERT INTO problems( problem_name, problem_desc, no_of_inputs) 
			VALUES ('Largest prime factor','Enter the number whose largest prime factor you want to find?',1)
			, ('Smallest multiple','Enter a number, say N, in order to  generate smallest positive number which can be evenly divisible from 1 to N?',1)
			,('Multiples of 3 and 5','Enter a number, say N, to  find the sum of all the multiples of 3 or 5 below N?',1);";
			$result6 = @mysqli_query($conn, $query);
						
		}
		$sql_table="records";
		$query = "show tables like '$sql_table'";  
		$result3 = @mysqli_query($conn, $query);
		if(mysqli_num_rows($result3)==0) {
			$fieldDefinition="problem_id INT
							, test_number BIGINT NOT NULL
							, test_answer BIGINT NOT NULL
							, total_runs INT		
							,FOREIGN KEY (problem_id) REFERENCES problems(problem_id)
							,PRIMARY KEY(problem_id,test_number)
							";
			$query = "create table " . $sql_table . "(" . $fieldDefinition . ")";
			$result4 = @mysqli_query($conn, $query);
		}
		
		//query to get questions from database 	
		$query = "SELECT problem_id
						, problem_name
						, problem_desc
				FROM  problems";
				
			$result5 = mysqli_query($conn, $query);
			$questions = array();
			$count = 0;
			while ($row = mysqli_fetch_assoc($result5)){
				$question = array(); 
				$question['questionNo'] = $row['problem_id'];
				$question['questionName'] = $row['problem_name'];
				$question['questionDesc'] = $row['problem_desc'];
				if($count == 0)
					$question['show'] = 1;
				$questions[] = $question;
				$count++;
			}
			
			// close the database connection
			mysqli_close($conn);
			//return questions to Front-End
			echo json_encode(array('questions' => $questions));
	}
		
	

	
?>