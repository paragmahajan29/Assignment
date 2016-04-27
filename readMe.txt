Feature-List

	1. User should be able to select question, provide input in text-field and click Calculate Button to view answer.
	2. Question & Inputs provided by User and respective Answer calculated for  Question should be saved in database.

Deployment 

	1. Front-End

		* HTML5
		* CSS
		* JS Libraries - jQuery, Handlebar

	2. Middle Layer

		* PHP - Accepts ajax requests from client and fetches data from database and gives response to client.

	3. Backend

		* MySQL

	4. Database Schema

		4.1 Table-'problems' whose schema is below
			* problem_id (PK)
			* problem_name
			* problem_desc
			* no_of_inputs

		4.2 Table-'records' whose schema is below
			* problem_id (FK)
			* test_number
			* test_answer
			* total_runs
			* PK(problem_id, test_number)

	5.Deployment

		5.1 Deployment Steps
			a. Download zip file(Assignment.zip).
			b. Extract zip file.
			c. Copy extracted Assignment folder to Server.
			d. Open Assignment folder.
			e. Open setting.php file.
			f. Add host, user, password and databse_name at line numbers 9, 10, 11, 12 respectively.
			g. Save and close the file.
			h. Start the web server.
			i. Open server "<link>/Assignment/questions.html".
			
Development Notes

	1. HTML5 - It is used to create Question.html page.

	2. CSS- It is used to for styling of Question.html page.

	3. jQuery-  jQuery is used instead of javascript beacause jQuery is easy to read and lightweight with many buit-in functionalities.

	4. Handlebar.js- Handlebar is used because
				a. It is easy to develope single page site with handlebar.
				b. It is easy to manage important html content on page as we no longer need JavaScript code to contain important HTML markup.
				c. Handlebars is a logic-less templating engine, which means there is little to no logic in handlebar templates that are on the HTML page. Handlebars keep HTML pages simple and clean and decoupled from the logic-based JavaScript files. 
				
	Mysql- 	It is  used to store 'problems' and 'records of user input' into database.
			I created seperate table 'problems' (problem_id, problem_name, problem_desc, no_inputs) to store problem so that we need only a sql script to add more problems. I added 'no_of_inputs' column in this table to ensure, we can have complex problems in future. 

Assumptions	
	
	1. I  have done all mathematical calculations on client side(javascrpt, jQuery) and used a sever side scripting(PHP) to save and update data in database. I did this because I wanted to increase performance of server as there will be less processing on server.
	2. I foused only on single input questions with eye on future enhancements.
	3. I have written code to automatically generate tables and add questions into database when first time site loads. Response time of server improves second time onwards.

Future Enhancements that can be added

	1. Support for complex problems ( different views of complex problems with more than one input required)
	2. User registration and logins to create leader-boards.
	3. Discussion boards for each question.
	4. Feature to add questions and competitions by users.


		