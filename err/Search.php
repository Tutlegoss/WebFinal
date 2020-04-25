<?php 	
	function query($likeStr, $in) 
	{
		require_once 'pdoconfig.php';
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname",
							$username, $password);
			/*
				https://stackoverflow.com/questions/43568773/adding-mysql-result-in-php-array-has-duplicate-values
				This is to not have both numeric and text keys as a result from the SQL query                      
			*/
			$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 					
			
			if ($likeStr === "") {
				$sql = "SELECT Message, Title, PostID
						FROM travelpost
						ORDER BY Title ASC;";
			}
			else if ($in === "TITLE")
			{
				$likeStr = "%".$likeStr."%";
				$sql = "SELECT Message, Title, PostID
						FROM   travelpost
						WHERE  Title
						LIKE   :likeStr
						ORDER BY Title ASC;";
			}
			else 
			{
				$likeStr = "%".$likeStr."%";
				$sql = "SELECT Message, Title, PostID
						FROM   travelpost
						WHERE  Message
						LIKE   :likeStr
						ORDER BY Title ASC;";				
			}
			
			$statement = $conn->prepare($sql);
			$statement->bindValue(':likeStr', $likeStr);
			$statement->execute();
			
			$rowArray = array();
			while ($row = $statement->fetch())
				$rowArray[] = $row;
			
			$pdo = null;
			
			echo json_encode($rowArray);
		} catch (PDOException $pe) {
			die("Could not connect to the database $dbname :" .
				$pe->getMessage());
		}	
	}
	
	exit(query($_GET['search'], $_GET['in']));
	
