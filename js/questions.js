/*
 Author:Parag Mahajan
 Title: questions.js
 
 this file includes main functionality of assignment.
 */

$(window).load(function() {
      init();
});

var currentQuestion;

function init(){
	getQuestions();// to get question on page load.
	$("#calculate-button").on('click', calculateAnswer);
	$( "#select-question" ).click(function (){
		currentQuestion = $(this).val();
	});
}

//validates user input and calls respective function.
function calculateAnswer(){
	var number = $("#text"+currentQuestion).val();
	if(number == null){
		$("#answer").html("");
		$(".error-message").html("Please enter number grater than 1.");
		return false;
	}
	if(!isNaN(number)){	
		if(number < 1){
			$("#answer").html("");
			$(".error-message").html("Please enter number grater than 1.");
			return false;
		}
		$(".error-message").html("");
		switch(currentQuestion)
		{
			case "1":	calculateLargestPrimeFactor();
						break;
			case "2":	calculateSmallestMultiple();
						break;
			case "3":	calculateSumOfMutiple3Or5();
						break;
		}
	}else{
		$("#answer").html("");
		$(".error-message").html("Please enter valid number.");
		return false;
	}
		
}

//handles question selection by user.
function showQuestion(){
	$(".error-message").html("");
	$("#q"+currentQuestion).addClass('hidden');
	var questionNo = $(this).val();
	currentQuestion = questionNo;
	$("#q"+currentQuestion).removeClass('hidden');
}

//function to calculate largest prime factor of number.
function calculateLargestPrimeFactor(){
	var number = $("#text"+currentQuestion).val();
	var answer;
	if(number >1){
		for (var i = 2; i <= number;) {
			if (number % i == 0){ 
				number = number/i;
				if(number == 1)
					break;
			}else
				i++;
		}
		answer = i;
	}else
		answer = number;
	saveResult(currentQuestion, $("#text"+currentQuestion).val(), answer );
}

// function to calculate smalledst multiple of number.
function calculateSmallestMultiple(){
	var number = $("#text"+currentQuestion).val();
    var lcm=1;
	
    for(var i=2;i<=number;i++)
		lcm *= i/calculateGcd(lcm,i);
	
	saveResult(currentQuestion, $("#text"+currentQuestion).val(), lcm );
}

// function to calculate gcd of two numbers.
function calculateGcd(x, y){
    while(y > 0) {
        x %= y;
        if (x == 0) 
			return y;
        y %= x;
    }
    return x;
}

// function to calculate sum of numbers multiple of 3 or 5.
function calculateSumOfMutiple3Or5(){
	var number = $("#text"+currentQuestion).val();
	var total = 0;
	for(var i = 0; i < number; i++) {
	  if(i % 3 == 0 || i % 5 == 0) 
		total += i;
	}
	saveResult(currentQuestion, number, total );
}

// AJAX call to get questions from database.
function getQuestions()
{
	$.ajax({
      type: "POST",
      url: "process.php",   
      data: {getQuestions: "1"
			},
      success: function (data) {
		  data = jQuery.parseJSON( data );
		  var questions = data.questions;
		  renderQuestions(data);
	  }
	});
}

// function to load questions in handlebar templates.
function renderQuestions(questions){
	var source = $("#questions-template").html(); 
	var template = Handlebars.compile(source); 
	$('#questions').append(template(questions));
	var source2 =  $("#questions-no-template").html(); 
	var template2 = Handlebars.compile(source2); 
	$('.select-class').append(template2(questions));
	currentQuestion = $( "#select-question" ).val();
	$( "#select-question" ).on('change', showQuestion);
}

// function to send AJAX request to save user inputs and answer alongwith question number.
function saveResult(currentQuestion,number, answer ){
	$.ajax({
      type: "POST",
      url: "save_result.php",   
      data: {
			  questionNo: currentQuestion
			, testNumber: number
			, testAnswer: answer
			},
      success: function (data) {
		  data = jQuery.parseJSON( data );
		  $("#answer").html("<strong> "+answer+ "</strong><br><strong>"+data.totalRuns+"</strong> times/time "+number+" is used as input for Question "+currentQuestion);
	  }
	});
}