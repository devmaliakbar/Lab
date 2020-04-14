<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Money Landing Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,600,600i,700,700i,800,800i,900&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

</head>
<body>
<?php 

	$msg = '';
	$msgClass = '';
	$messag = 'DONE';

?>



<?php 
	if (filter_has_var(INPUT_POST, 'submit')) {
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);
		$gender = htmlspecialchars($_POST['gender']);

		if (!empty($name) && !empty($email) && !empty($message)) {

			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

				$msg = 'please enter an valid email';
				$msgClass = 'alert-danger';
			}
			else {
				$toEmail = 'salmanahmedqure@gmail.com';
				$subject = 'Contact request from' .$name;
				$body = 'Name:'.$name.'
					Email'.$email.'
					Message:'.$message.'
					Gender:'.$gender.'
				';

				$header = "MINE-Version: 1.0" ."\r\n";
				$header .="content-Type:text/html;charset=UTF-8" ."\r\n";

				$headers .="From: " .$name. "<".$email.">". "\r\n";

				if (mail($toEmail, $subject, $body, $headers)) {
						
						$msg = 'Your Email has been Sent';
						$msgClass = 'alert-success';		
				}
				else {
					$msg = 'Your Email not sent';
					$msgClass = 'alert-danger';		
				}
			}
		} 
		else {
			$msg = 'please fill in the fields';
			$msgClass = 'alert-danger';
		}


	}	
?>
			<?php if ($msg != ''): ?>
				<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
			<?php endif ?>


    <section class="top_section">
		<div class="container">
			<div class="row header">
				<div class="logo_div col-md-6 col-sm-6 col-xs-6">
					<h6>Logo</h6>
				</div>
				<div class="btn_div col-md-6 col-sm-6 col-xs-6">
					<a href="#">Sign In</a>
				</div>
			</div>
			<div class="row top_content_div">
				<div class="top_content col-sm-6 col-md-6 col-xs-12 padding0">
					<h2>
						Make Money <br>
						<span>Online $300/Month</span>
					</h2>
					<div class="content_lines">
						<h5><img src="images/tick.png">Take Survys online and get paid in cash  or gift cards.</h5>
						<h5><img src="images/tick.png">It’s fast, easy and free!.</h5>
						<h5><img src="images/tick.png">Limited places available</h5>
						<h5><img src="images/tick.png">UK’s highest paying surveys</h5>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1 col-md-1 padding0">
					
				</div>
				<div class="form_div col-sm-5 col-md-5 col-xs-12 padding0">
					<h1>Start Earning Now</h1>
					<h6><img src="images/clock.jpg">Join in 3 sconds!</h6>
					<div class="col-sm-10 col-10 padding0">
	    				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		    				<div class="form-group">
		    					<label>Name</label>
		    					<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name: ''; ?>">
		    				</div>
		    				<div class="form-group">
		    					<label>Email</label>
		    					<input type="" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email: ''; ?>">
		    				</div>
		    				<div class="form-group">
		    					<label>Message</label>
		    					<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
		    				</div>
		    				<br>
		    				<label style="margin-bottom: 3px;"><img src="images/gender.png"> Gender*</label>
		                    <div class="form-group radio_div">
		                    	<div class="radio_btns col-sm-12 padding0">
			                    	<div class="radio_div">
										<div class="radio">
										    <input type="radio" name="gender" value="male" checked><?php echo isset($_POST['gender']) ? $gender : ''; ?>Male<br>
										    <!-- <label for="radio-1" class="radio-label">Male</label> -->
										    <img src="images/male.png">
								  		</div>
								  	</div>
								  	<div class="radio_div">
										<div class="radio">
										    <input type="radio" name="gender" value="female"><?php echo isset($_POST['gender']) ? $gender : ''; ?> Female<br>
										    <!-- <label for="radio-1" class="radio-label">Male</label> -->
										    <img src="images/male.png">
								  		</div>
								  	</div>
		                    	</div>
		                    </div>
		    				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	    				</form>
    		</div>
			</div>
		</div>
	</section>
	<br><br><br>
	<section class="slider_section">
		<div class="container">
			<div class="owl-carousel owl-theme">
			    <div class="item"><img src="images/slide1.jpg"></div>
			    <div class="item"><img src="images/slide2.jpg"></div>
			    <div class="item"><img src="images/slide3.jpg"></div>
			    <div class="item"><img src="images/slide4.jpg"></div>
			    <div class="item"><img src="images/slide5.jpg"></div>
			    <div class="item"><img src="images/slide6.jpg"></div>
			    <div class="item"><img src="images/slide1.jpg"></div>
			    <div class="item"><img src="images/slide2.jpg"></div>
			    <div class="item"><img src="images/slide3.jpg"></div>
			    <div class="item"><img src="images/slide4.jpg"></div>
			    <div class="item"><img src="images/slide5.jpg"></div>
			</div>
		</div>
	</section>
	<section class="work_section">
		<div class="container text-center">
			<h1 class="heading">How It Work</h1>
			 <div class="row">
			 	<div class="col-xs-12 work_div">
			 		<div class="number">
			 			<img src="images/1.png">
			 		</div>
			 		<img src="images/icon1.png">
			 		<h4>Join for Free</h4>
			 		<p>
			 			Register and get connected to the highest paid survey companies in the UK, 100% FREE!
			 		</p>
			 	</div>
			 	<div class="col-xs-12 work_div">
			 		<div class="number">
			 			<img src="images/2.png">
			 		</div>
			 		<img src="images/icon2.png">
			 		<h4>Take Surveys</h4>
			 		<p>
			 			You will recieved in your inbox as other offers like product testing. The Choice is yours
			 		</p>
			 	</div>
			 	<div class="col-xs-12 work_div">
			 		<div class="number">
			 			<img src="images/3.png">
			 		</div>
			 		<img src="images/icon3.png">
			 		<h4>Earn Rewards</h4>
			 		<p>
			 			Register and get connected to the highest paid survey companies in the UK, 100% FREE!
			 		</p>
			 	</div>
			 </div>
		</div>
	</section>
	<section class="faq_section">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 padding0">
					<h3 class="heading_white text-center">Frequently Asked Questions</h3>
					<div id="accordion" class="panel-group">
					    <div class="panel">
					      <div class="panel-heading">
					      <h4 class="panel-title">
					        <a href="#panelBodyOne" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><span class="num_faq">1</span>What is Branded Surveys?</a>
					        </h4>
					      </div>
					      <div id="panelBodyOne" class="panel-collapse collapse in">
					      <div class="panel-body">
					          <p>
					          	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
					        </div>
					      </div>
					    </div>
					    <div class="panel">
					      <div class="panel-heading">
					      <h4 class="panel-title">
					        <a href="#panelBodyTwo" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"><span class="num_faq">2</span>What is Branded Surveys?</a>
					        </h4>
					      </div>
					      <div id="panelBodyTwo" class="panel-collapse collapse">
					      <div class="panel-body">
					          <p>Energistically drive standardized communities through user friendly results. Phosfluorescently initiate superior technologies vis-a-vis low-risk high-yield solutions. Objectively facilitate clicks-and-mortar partnerships vis-a-vis superior partnerships. Continually generate long-term high-impact methodologies via wireless leadership. Holisticly seize resource maximizing solutions via user friendly outsourcing.</p>
					        </div>
					      </div>
					    </div>
					    <div class="panel">
					      <div class="panel-heading">
					      <h4 class="panel-title">
					        <a href="#panelBodyThree" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"><span class="num_faq">3</span>What is Branded Surveys?</a>
					        </h4>
					      </div>
					      <div id="panelBodyThree" class="panel-collapse collapse">
					      <div class="panel-body">
					          <p>Energistically drive standardized communities through user friendly results. Phosfluorescently initiate superior technologies vis-a-vis low-risk high-yield solutions. Objectively facilitate clicks-and-mortar partnerships vis-a-vis superior partnerships. Continually generate long-term high-impact methodologies via wireless leadership. Holisticly seize resource maximizing solutions via user friendly outsourcing.</p>
					        </div>
					      </div>
					    </div>
					    <div class="panel">
					      <div class="panel-heading">
					      <h4 class="panel-title">
					        <a href="#panelBodyFour" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion"><span class="num_faq">4</span>What is Branded Surveys?</a>
					        </h4>
					      </div>
					      <div id="panelBodyFour" class="panel-collapse collapse">
					      <div class="panel-body">
					          <p>Energistically drive standardized communities through user friendly results. Phosfluorescently initiate superior technologies vis-a-vis low-risk high-yield solutions. Objectively facilitate clicks-and-mortar partnerships vis-a-vis superior partnerships. Continually generate long-term high-impact methodologies via wireless leadership. Holisticly seize resource maximizing solutions via user friendly outsourcing.</p>
					        </div>
					      </div>
					    </div>
					  </div>
				</div>
			</div>
		</div>
	</section>
	<section class="brand_section">
		<div class="container">
				<h3 class="heading_white text-center">Ready to Join Branded Surveys?</h3>
				<div class="spacer"></div>
				 <a href="#" class="join_btn">Join Now</a>
		</div>
	</section>
	<section class="slider_section2 for_desktop">
		<div class="container">
			<h5 class="sub_heading">Happy Members</h5>
			<h1 class="heading text-center">Testimonials</h1>
			<div class="spacer"></div>
			<div class="container">
  			<div class="row">
		    <div id="carousel" class="carousel slide" data-ride="carousel">
			    <ol class="carousel-indicators">
			        <li data-target="#carousel" data-slide-to="0" class="active"></li>
			        <li data-target="#carousel" data-slide-to="1"></li>
			    </ol>
  				<div class="carousel-inner">
		        	<div class="carousel-item active">
		          		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
				    				<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
				            	<div class="testi_item text-center">
				            		<img src="images/client_2.png">
							    	<p>
							    		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
							    	</p>
							    	<h6 class="name">- Ambira N, Earn $27k+</h6>		
				            	</div>
				            	<div class="testi_item text-center">
				            		<img src="images/client_1.png">
							    	<p>
							    		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
							    	</p>
							    	<h6 class="name">- Ambira N, Earn $27k+</h6>		
				            	</div>
		            		</div>
		          		</div>
		        	</div>
		        	<div class="carousel-item">
		         		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
					    			<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
				            	<div class="testi_item text-center">
				            		<img src="images/client_1.png">
							    	<p>
							    		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
							    	</p>
							    	<h6 class="name">- Ambira N, Earn $27k+</h6>		
				            	</div>
			            		<div class="testi_item text-center">
			            			<img src="images/client_1.png">
						    		<p>
						    			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
						    		</p>
						    		<h6 class="name">- Ambira N, Earn $27k+</h6>		
			            		</div>
	            			</div>
		        		</div>
      				</div>
			    	<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			        	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			        	<span class="sr-only">Previous</span>
			      	</a>	
				    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
				        <span class="carousel-control-next-icon" aria-hidden="true"></span>
				        <span class="sr-only">Next</span>
		      		</a>
    			</div>
  			</div>
		</div>
	</section>
	<section class="slider_section2 for_mobile">
		<div class="container">
			<h5 class="sub_heading">Happy Members</h5>
			<h1 class="heading text-center">Testimonials</h1>
			<div class="spacer"></div>
			<div class="container">
  			<div class="row">
		    <div id="carousel" class="carousel slide" data-ride="carousel">
			    <ol class="carousel-indicators">
			        <li data-target="#carousel" data-slide-to="0" class="active"></li>
			        <li data-target="#carousel" data-slide-to="1"></li>
			    </ol>
  				<div class="carousel-inner">
		        	<div class="carousel-item active">
		          		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
				    				<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
		            		</div>
		          		</div>
		        	</div>
		        	<div class="carousel-item">
		         		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
					    			<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
	            			</div>
		        		</div>
      				</div>
      				<div class="carousel-item">
		         		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
					    			<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
	            			</div>
		        		</div>
      				</div>
      				<div class="carousel-item">
		         		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
					    			<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
	            			</div>
		        		</div>
      				</div>
      				<div class="carousel-item">
		         		<div class="d-none d-lg-block">
		            		<div class="slide-box">
		            			<div class="testi_item text-center">
		            				<img src="images/client_1.png">
					    			<p>
					    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
					    			</p>
					    			<h6 class="name">- Ambira N, Earn $27k+</h6>		
		            			</div>
	            			</div>
		        		</div>
      				</div>
			    	<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			        	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			        	<span class="sr-only">Previous</span>
			      	</a>	
				    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
				        <span class="carousel-control-next-icon" aria-hidden="true"></span>
				        <span class="sr-only">Next</span>
		      		</a>
    			</div>
  			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<h1>Logo</h1>
			<h4>Top 10 Best Paid Surveys</h4>
			<h3>In the United Kingdom (UK)</h3>
			<h3>Terms & Condition  &nbsp;&nbsp;&nbsp;  l  &nbsp;&nbsp;&nbsp;  Privacy Policy</h3>
			<h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>
		</div>
	</footer>

</body>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		/*
 *  jQuery Date Dropdowns - v1.0.0
 *  A simple, customisable date select plugin
 *  https://github.com/IckleChris/jquery-date-dropdowns
 *  Made by Chris Brown
 *  Under MIT License
 */
!function(a,b,c,d){"use strict";function e(b,c){return this.element=b,this.$element=a(b),this.config=a.extend({},g,c),this.internals={objectRefs:{}},this.init(),this}var f="dateDropdowns",g={defaultDate:null,defaultDateFormat:"yyyy-mm-dd",displayFormat:"dmy",submitFormat:"yyyy-mm-dd",minAge:0,maxAge:120,minYear:null,maxYear:null,submitFieldName:"date",wrapperClass:"date-dropdowns",dropdownClass:null,daySuffixes:!0,monthSuffixes:!0,monthFormat:"long",required:!1,dayLabel:"Day",monthLabel:"Month",yearLabel:"Year",monthLongValues:["January","February","March","April","May","June","July","August","September","October","November","December"],monthShortValues:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],initialDayMonthYearValues:["Day","Month","Year"],daySuffixValues:["st","nd","rd","th"]};a.extend(e.prototype,{init:function(){this.checkForDuplicateElement(),this.setInternalVariables(),this.setupMarkup(),this.buildDropdowns(),this.attachDropdowns(),this.bindChangeEvent(),this.config.defaultDate&&this.populateDefaultDate()},checkForDuplicateElement:function(){return!a('input[name="'+this.config.submitFieldName+'"]').length||(a.error("Duplicate element found"),!1)},setInternalVariables:function(){var a=new Date;this.internals.currentDay=a.getDate(),this.internals.currentMonth=a.getMonth()+1,this.internals.currentYear=a.getFullYear()},setupMarkup:function(){var b,c;if("input"===this.element.tagName.toLowerCase()){this.config.defaultDate||(this.config.defaultDate=this.element.value),c=this.$element.attr("type","hidden").wrap('<div class="'+this.config.wrapperClass+'"></div>');var d=this.config.submitFieldName!==g.submitFieldName,e=this.element.hasAttribute("name");e||d?d&&this.$element.attr("name",this.config.submitFieldName):this.$element.attr("name",g.submitFieldName),b=this.$element.parent()}else c=a("<input/>",{type:"hidden",name:this.config.submitFieldName}),this.$element.append(c).addClass(this.config.wrapperClass),b=this.$element;return this.internals.objectRefs.pluginWrapper=b,this.internals.objectRefs.hiddenField=c,!0},buildDropdowns:function(){var a,b,c;return e.message={day:this.config.initialDayMonthYearValues[0],month:this.config.initialDayMonthYearValues[1],year:this.config.initialDayMonthYearValues[2]},a=this.buildDayDropdown(),this.internals.objectRefs.dayDropdown=a,b=this.buildMonthDropdown(),this.internals.objectRefs.monthDropdown=b,c=this.buildYearDropdown(),this.internals.objectRefs.yearDropdown=c,!0},attachDropdowns:function(){var a=this.internals.objectRefs.pluginWrapper,b=this.internals.objectRefs.dayDropdown,c=this.internals.objectRefs.monthDropdown,d=this.internals.objectRefs.yearDropdown;switch(this.config.displayFormat){case"mdy":a.append(c,b,d);break;case"ymd":a.append(d,c,b);break;case"dmy":default:a.append(b,c,d)}return!0},bindChangeEvent:function(){var a=this.internals.objectRefs.dayDropdown,b=this.internals.objectRefs.monthDropdown,c=this.internals.objectRefs.yearDropdown,d=this,e=this.internals.objectRefs;e.pluginWrapper.on("change","select",function(){var f,g,h=a.val(),i=b.val(),j=c.val();return(f=d.checkDate(h,i,j))?(e.dayDropdown.addClass("invalid"),!1):("00"!==e.dayDropdown.val()&&e.dayDropdown.removeClass("invalid"),e.hiddenField.val(""),f||h*i*j===0||(g=d.formatSubmitDate(h,i,j),e.hiddenField.val(g)),void e.hiddenField.change())})},populateDefaultDate:function(){var a=this.config.defaultDate,b=[],c="",d="",e="";switch(this.config.defaultDateFormat){case"yyyy-mm-dd":default:b=a.split("-"),c=b[2],d=b[1],e=b[0];break;case"dd/mm/yyyy":b=a.split("/"),c=b[0],d=b[1],e=b[2];break;case"mm/dd/yyyy":b=a.split("/"),c=b[1],d=b[0],e=b[2];break;case"unix":b=new Date,b.setTime(1e3*a),c=b.getDate()+"",d=b.getMonth()+1+"",e=b.getFullYear(),c.length<2&&(c="0"+c),d.length<2&&(d="0"+d)}return this.internals.objectRefs.dayDropdown.val(c),this.internals.objectRefs.monthDropdown.val(d),this.internals.objectRefs.yearDropdown.val(e),this.internals.objectRefs.hiddenField.val(a),!0===this.checkDate(c,d,e)&&this.internals.objectRefs.dayDropdown.addClass("invalid"),!0},buildBaseDropdown:function(b){var c=b;return this.config.dropdownClass&&(c+=" "+this.config.dropdownClass),a("<select></select>",{class:c,name:this.config.submitFieldName+"_["+b+"]",required:this.config.required})},buildDayDropdown:function(){var a,b=this.buildBaseDropdown("day"),d=c.createElement("option");d.setAttribute("value",""),d.appendChild(c.createTextNode(this.config.dayLabel)),b.append(d);for(var e=1;e<10;e++)a=this.config.daySuffixes?e+this.getSuffix(e):"0"+e,d=c.createElement("option"),d.setAttribute("value","0"+e),d.appendChild(c.createTextNode(a)),b.append(d);for(var f=10;f<=31;f++)a=f,this.config.daySuffixes&&(a=f+this.getSuffix(f)),d=c.createElement("option"),d.setAttribute("value",f),d.appendChild(c.createTextNode(a)),b.append(d);return b},buildMonthDropdown:function(){var a=this.buildBaseDropdown("month"),b=c.createElement("option");b.setAttribute("value",""),b.appendChild(c.createTextNode(this.config.monthLabel)),a.append(b);for(var d=1;d<=12;d++){var e;switch(this.config.monthFormat){case"short":e=this.config.monthShortValues[d-1];break;case"long":e=this.config.monthLongValues[d-1];break;case"numeric":e=d,this.config.monthSuffixes&&(e+=this.getSuffix(d))}d<10&&(d="0"+d),b=c.createElement("option"),b.setAttribute("value",d),b.appendChild(c.createTextNode(e)),a.append(b)}return a},buildYearDropdown:function(){var a=this.config.minYear,b=this.config.maxYear,d=this.buildBaseDropdown("year"),e=c.createElement("option");e.setAttribute("value",""),e.appendChild(c.createTextNode(this.config.yearLabel)),d.append(e),a||(a=this.internals.currentYear-(this.config.maxAge+1)),b||(b=this.internals.currentYear-this.config.minAge);for(var f=b;f>=a;f--)e=c.createElement("option"),e.setAttribute("value",f),e.appendChild(c.createTextNode(f)),d.append(e);return d},getSuffix:function(a){var b="",c=this.config.daySuffixValues[0],d=this.config.daySuffixValues[1],e=this.config.daySuffixValues[2],f=this.config.daySuffixValues[3];switch(a%10){case 1:b=a%100===11?f:c;break;case 2:b=a%100===12?f:d;break;case 3:b=a%100===13?f:e;break;default:b="th"}return b},checkDate:function(a,b,c){var d;if("00"!==b){var e=new Date(c,b,0).getDate(),f=parseInt(a,10);d=this.updateDayOptions(e,f),d&&this.internals.objectRefs.hiddenField.val("")}return d},updateDayOptions:function(a,b){var d=parseInt(this.internals.objectRefs.dayDropdown.children(":last").val(),10),e="",f="",g=!1;if(d>a){for(;d>a;)this.internals.objectRefs.dayDropdown.children(":last").remove(),d--;b>a&&(g=!0)}else if(d<a)for(;d<a;){e=++d,f=e,this.config.daySuffixes&&(f+=this.getSuffix(d));var h=c.createElement("option");h.setAttribute("value",e),h.appendChild(c.createTextNode(f)),this.internals.objectRefs.dayDropdown.append(h)}return g},formatSubmitDate:function(a,b,c){var d,e;switch(this.config.submitFormat){case"unix":e=new Date,e.setDate(a),e.setMonth(b-1),e.setYear(c),d=Math.round(e.getTime()/1e3);break;default:d=this.config.submitFormat.replace("dd",a).replace("mm",b).replace("yyyy",c)}return d},destroy:function(){var a=this.config.wrapperClass;if(this.$element.hasClass(a))this.$element.empty();else{var b=this.$element.parent(),c=b.find("select");this.$element.unwrap(),c.remove()}}}),a.fn[f]=function(b){return this.each(function(){if("string"==typeof b){var c=Array.prototype.slice.call(arguments,1),d=a.data(this,"plugin_"+f);if("undefined"==typeof d)return a.error("Please initialize the plugin before calling this method."),!1;d[b].apply(d,c)}else a.data(this,"plugin_"+f)||a.data(this,"plugin_"+f,new e(this,b))}),this}}(jQuery,window,document);


/*inicializar*/
$(document).ready(function() {
  $("#example1").dateDropdowns(
    //$("#example1 select").select2()
  );
  
  $("#example2").dateDropdowns({
    submitFieldName: 'example2',
    submitFormat: "dd/mm/yyyy"
  });
  
  $("#example3").dateDropdowns({
    submitFieldName: 'example3',
    defaultDate: '2010-02-17'
  });
  
  $("#example4").dateDropdowns({
    submitFieldName: 'example4',
    minAge: 18
  });
  
  $("#example5").dateDropdowns({
    submitFieldName: 'example5',
    displayFormat: 'mdy'
  });
  
  $("#example6").dateDropdowns({
    submitFieldName: 'example6',
    monthFormat: 'short'
  });
  
  $("#example7").dateDropdowns({
    submitFieldName: 'example7',
    submitFormat: 'unix',
    defaultDateFormat: 'unix'
  });
  
  $("#example8").dateDropdowns({
    submitFieldName: 'example8',
    submitFormat: 'unix',
    defaultDateFormat: 'unix',
    defaultDate: 456692066
  });
  
  $("#example9").dateDropdowns({
    submitFieldName: 'example9',
    submitFormat: 'unix',
    defaultDateFormat: 'unix'
  });
  
  $("#example10").dateDropdowns({
    submitFieldName: 'example10',
    required: true
  });
                
  $("#example11").dateDropdowns({
    yearLabel: 'Anno',
    monthLabel: 'Mense',
    dayLabel: 'Die',
    submitFieldName: 'example11',
  });
                
	// Set all hidden fields to type text for the demo
	$('input[type="hidden"]').attr('type', 'text').attr('readonly', 'readonly');
});


	</script>




	<script>
		$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay:true,
    autoplayHoverPause:true,
    autoplayTimeout:2000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
	</script>
	</script>

</html>