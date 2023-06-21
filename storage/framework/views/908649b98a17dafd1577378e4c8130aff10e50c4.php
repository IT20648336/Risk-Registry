<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/Step.css" >
</head>

<body>
<div class="container">
	<a target="_blank" href="https://www.youtube.com/watch?v=WW6fEuheuas"><h1 class="text-center"></h1></a>
<div id="stepProgressBar">
	<div class="step">
		<p class="step-text">Portfolio <br>Selection</p>
		<div class="bullet">1</div>
	</div>
	<div class="step">
		<p class="step-text">Risk<br> Identification</p>
		<div class="bullet">2</div>
	</div>
	<div class="step">
		<p class="step-text">Risk<br> Analysis</p>
		<div class="bullet">3</div>
	</div>
	<div class="step">
		<p class="step-text">Risk<br> Evaluation</p>
		<div class="bullet ">4</div>
	</div>
 <div class="step">
		<p class="step-text">Risk <br>Treatment</p>
		<div class="bullet ">5</div>
	</div>
 <div class="step">
		<p class="step-text">Risk <br>Review</p>
		<div class="bullet ">6</div>
	</div>
</div>
<div id="main">
	<p id="content"  class="text-center"></p>
	<button id="previousBtn" >Previous</button>
	<button id="nextBtn">Next</button>
	<button id="finishBtn" >Finish</button>
 	
</div>
</div>


<!--Script-->

<script>
const  previousBtn  =  document.getElementById('previousBtn');
const  nextBtn  =  document.getElementById('nextBtn');
const  finishBtn  =  document.getElementById('finishBtn');
const  content  =  document.getElementById('content');
const  bullets  =  [...document.querySelectorAll('.bullet')];

const MAX_STEPS = 6;
let currentStep = 1;

nextBtn.addEventListener('click',  ()  =>  {
	bullets[currentStep  -  1].classList.add('completed');
	currentStep  +=  1;
	previousBtn.disabled  =  false;
	if  (currentStep  ===  MAX_STEPS)  {
		nextBtn.disabled  =  true;
		finishBtn.disabled  =  false;
	}
	//content.innerText  =  `Step Number ${currentStep}`;
});


previousBtn.addEventListener('click',  ()  =>  {
	bullets[currentStep  -  2].classList.remove('completed');
	currentStep  -=  1;
	nextBtn.disabled  =  false;
	finishBtn.disabled  =  true;
	if  (currentStep  ===  1)  {
		previousBtn.disabled  =  true;
	}
	//content.innerText  =  `Step Number ${currentStep}`;
});

finishBtn.addEventListener('click',  ()  =>  {
	location.reload();
});

</script>

</body><?php /**PATH /data/RiskRegistry/resources/views/Stepper.blade.php ENDPATH**/ ?>