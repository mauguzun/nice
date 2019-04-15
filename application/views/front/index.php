<!DOCTYPE html>
<html lang="<?= isset($current_lang)?$current_lang:'en'?>">
	<head>
		<meta name="theme-color" content="#000">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--EDITED FILE-->
		<title> <?= lang('Discover Nice'); ?></title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
		integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<!-- ALL CSS -->
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/owl.carousel.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/owl.theme.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/animate.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/slick.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/flaticon.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/settings.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/style.css?<?= rand(0, 9999) ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/preset.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/css/responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/lib/themes/default.css?<?= rand(0, 9999) ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/lib/themes/default.date.css?<?= rand(0, 9999) ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url()?>static/front/lib/themes/default.time.css?<?= rand(0, 9999) ?>">
		<script type="text/javascript" src="<?= base_url()?>static/front/js/jquery.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE ?>&libraries=places"
             ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>		

		<!--[if lt IE 9]>
		<script src="<?= base_url()?>static/js/html5shiv.js"></script>
		<script src="<?= base_url()?>static/js/respond.min.js"></script>
		<![endif]-->
		<!--bot-->
		<link href="https://cdn.botframework.com/botframework-webchat/latest/botchat.css" rel="stylesheet"/>
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="<?= base_url()?>static/front/images/favicon.png">
		<!-- Favicon Icon -->
		<script>

			var  toursData =<?php echo json_encode($tours['tours'],JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) ?>

		</script>
		<script type="text/javascript" id="cookiebanner"
  src="https://cdnjs.cloudflare.com/ajax/libs/cookie-banner/1.2.2/cookiebanner.min.js"></script>
<!--		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4f30e0a36e2a9221"></script>-->
	</head>



	<body>




		<div class="music_pos">
			<a href="#" id="musicStop" style="display: none;"><i class="fas fa-volume-down"></i></a>
			<a href="#" id="musicHint"><i class="fas fa-volume-off"></i></a>
		</div>


		<div class="wsk-float">
			<a class=" phone pulse" href="tel:+<?= PHONE ?>" >
				<?= PHONE ?>

			</a>
		</div>
		<div class="botclass" id="bot_div">
			<div class="row" style="position:absolute; z-index:999; right:5px; top:0px;">
				<div class="col-lg-12 text-center">
					<h1 id="close_chat">
						<span aria-hidden="true">&times;</span>
					</h1>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="sectionTitle bigTitle2" id="bot" style="height: 100vh;">


					</div>
				</div>
			</div>
		</div>
		<div id="overlay" class="overclass white" >

			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="sectionTitle bigTitle2" style="margin-top: 20%;">
						<h1 class="magenta text-uppercase bold" id="sendresult">
							<img width="150px" src="<?= base_url()?>static/front/images/loader.gif"   alt="">
						</h1>
					</div>
				</div>
			</div>
		</div>
		
		
		<div id=""   class="overclass black  heartBeat slower" style="display: block;padding-top:25vh;z-index:9999;
		background:rgba(0,0,0,0.95)" >
			<div class="revCon"  >

									<p class="lead color_white shadow  ">Discount</p>
								<h2 class="lead color_white shadow    ">10 %  <span class="magenta    "> OFF</span></h2>
<img width="380px" src="https://www.travelfashiongirl.com/wp-content/uploads/2017/07/how-to-pack-for-nice-france.jpg" />
		

							</div>
		</div>

		<div id="overlay-lang"  class="overclass black" >
			<nav style="padding-top:10vh;">
				<?
				foreach($langs as $url => $name): ?>

				<a class="lang-class" href="<?= base_url() . '?lang=' . $url ?>">

					<img  title="<?= $name ?>" style='width:30px;heigh:20px;'
					src='<?= base_url() ?>static/front/country-flags/<?= $url ?>.png'>
					<?= $name ?>

					<? endforeach; ?>
				</a>

			</nav>
		</div>

		<div id="overlay-menu" class="overclass black" >
			<nav style="padding-top:10vh;">
				<div class="menu">
					<ul class="main_menu">
						<li class="scroll lang-class"><a href="#booking"><?= lang('Booking') ?></a></li>
						<li class="scroll lang-class"><a href="#ourwork"><?= lang('galery') ?></a></li>
						<!--<li><a download="presentation.pdf"
						href="< base_url() ?>/presentation/presentation.pdf//lang('Tours') ?></a></li> -->
						<li class="scroll lang-class"><a href="#chooseus"><?= lang('News') ?> </a>

							<ul class="sub-menu">
								<li><a   href="#chooseus"><?= lang('Who we are') ?></a></li>
								<li><a  href="#testmonialSec"><?= lang('Press') ?></a></li>
							</ul>
						</li>
						<li class="scroll lang-class"><a href="#geolocation"><?= lang('Geo Location') ?></a></li>

						<li class="scroll lang-class"><a href="#supplier"><?= lang('Become Supplier') ?></a></li>
						<li class="scroll lang-class "><a href="#contact"><?= lang('Contact') ?></a></li>

					</ul>

				</div>

			</nav>
		</div>
		<!--HEADER 01 START-->
		<header class="header isSticky" id="header">
			<div class="container-fluid">


				<div class="row">
					<div  class="top_half" >

						<a class="logo"  href="<?= base_url()?>"><img src="<?= base_url()?>static/front/images/logo.png" alt="
							" style="width:210px;"></a>



						<a    class="stickyLogo" href="<?= base_url() ?>">
							<img src="<?= base_url()?>static/front/images/flogo.png" style="width:170px;" alt=""></a>

					</div>
					
					<div  class="top_quart">

						<span class="" type="button" id="lang" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
							<img style='width:30px; margin:5px; ' src='<?= base_url()?>static/front/country-flags/<?= $current_lang ?>.png'>
						</span>


					</div>
					<div   class="top_quart">
						<button onclick="$('#overlay-menu').fadeIn()"
id="menu"
						style="width: 40px;
    height: 40px;
    color: white;
    font-size: 30px;
    background: #c90090;"
>							<i class="fas fa-bars"></i>
						</button>
					</div>
				</div>
				<div class="collapse" id="navbarToggleExternalContent">
					<div class="menu">
						<ul class="main_menu">
							<li class="scroll"><a href="#booking"><?= lang('Booking') ?></a></li>
							<li class="scroll"><a href="#ourwork"><?= lang('galery') ?></a></li>
							<!--<li><a download="presentation.pdf"
							href="< base_url() ?>/presentation/presentation.pdf//lang('Tours') ?></a></li> -->
							<li class="scroll"><a href="#chooseus"><?= lang('News') ?> </a>

								<ul class="sub-menu">
									<li><a href="#chooseus"><?= lang('Who we are') ?></a></li>
									<li><a href="#testmonialSec"><?= lang('Press') ?></a></li>
								</ul>
							</li>
							<li class="scroll"><a href="#geolocation"><?= lang('Geo Location') ?></a></li>

							<li class="scroll"><a href="#supplier"><?= lang('Become Supplier') ?></a></li>
							<li class="scroll"><a href="#contact"><?= lang('Contact') ?></a></li>

						</ul>
					</div>
				</div>

			</div>
		</header>
		<!--HEADER 01 END-->


		<!--SLIDER START-->
		<section class="slider" id="slider">
			<div class="tp-banner">
				<ul>
					<?
					foreach($images as $value) : ?>


					<li data-transition="fade" data-slotamount="7" data-masterspeed="500">
						<img src="<?= base_url()?>/static/front/bg/<?= $value ?>" alt="">
						<div class="tp-caption sfb"
                             data-x="center"
                             data-y="center"
                             data-hoffset="0"
                             data-voffset="-40"
                             data-speed="1600"
                             data-start="1000"
                             data-easing="easeInOutCubic">
							<div class="revCon">
								<h5 class="text-uppercase color_white"><?= lang('Tricypolitain') ?></h5>
							</div>
						</div>
						<div class="tp-caption sfb"
                             data-x="center"
                             data-y="center"
                             data-hoffset="0"
                             data-voffset="35"
                             data-speed="2000"
                             data-start="1500"
                             data-easing="Power4.easeOut">
							<div class="revCon">
								<h2 class="lead color_white shadow"><?= lang('Discover Nice'); ?></h2>


							</div>
						</div>
						<div class="tp-caption sfb"
                             data-x="center"
                             data-y="center"
                             data-hoffset="0"
                             data-voffset="148"
                             data-speed="2000"
                             data-start="2000"
                             data-easing="Power4.easeOut">
							<div class="revCon revBtn">
								<a href="#booking" class="bes_button shadow"><?= lang('Booking') ?> <i
                                            class="flaticon-arrows"></i></a>
							</div>
						</div>
					</li>



					<? endforeach; ?>
				</ul>
			</div>

		</section>
		<!--SLIDER END-->

		<!--ABOUT START-->
		<section id="geolocation">

			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="sectionTitle bigTitle2">
						<br>
						<h5 class="magenta text-uppercase bold"><?= lang('Points on map ') ?></h5>

					</div>
				</div>
			</div>
			<div id="infowindow-content">


				<img id="place-img" src="" width="150px" style="float: right;margin-left: 40px"/>

				<strong id="place-title" style="font-size: 20px"></strong><br>
				<span id="place-desc"></span>
			</div>

			<div style="height: 100vh;" id="map">

			</div>

		</section>
		<!--ABOUT END-->

		<section class="contact" id="contact">

			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="contactInner">


							<h3 class="magenta light"><?= lang('Have a question? or just say hello!') ?></h3>

							<div class="contactForm">



								<form action="send.php" class="form-send" method="post" id="contactForm">
									<div class="row">


										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_email"><?= lang('Name Lastname'); ?></label>
												<input type="text" name="name" required class="required">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_email"><?= lang('Subject'); ?></label>
												<input type="text" name="subject" required class="required">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_company"><?= lang('Email'); ?></label>
												<input type="email" name="email" required id="email">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_email"><?= lang('Phone'); ?></label>
												<input type="tel" name="phone" required class="required">
											</div>
										</div>


										<div class="col-sm-12">
											<div class="single_form">
												<label for="con_msg"><?= lang('Message'); ?>:</label>
												<textarea name="message" required class="required"></textarea>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="single_form">
												<div class="g-recaptcha" data-sitekey="6Leh_oUUAAAAACc9AQR1H08rIEuIhUTMwNHleH_B"></div>
											</div>
										</div>
										<div class="col-sm-12 text-center">
											<input type="submit" value="<?= lang('Send'); ?>" class="bes_button">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--CONTACT END-->

		<!--OUR WORK START-->
		<section class="ourwork" id="ourwork">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="sectionTitle">

						<h5 class="magenta text-uppercase bold"><?= lang('Gallery') ?></h5>

					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 noPadding">
						<div id="workCarousel">

							<?
							foreach($images as $value) : ?>


							<div class="singleWork">
								<img src="<?= base_url() ?>static/front/bg/<?= $value ?>" alt="">
								<div class="singleWorkContent">
									<h6 class="color_yellow text-uppercase bold"> <?= lang('Discover Nice') ?></h6>

									<div class="workTag">
										<a href="#"> <?= lang('Tricypolitain') ?></a>

									</div>

								</div>
							</div>

							<?  endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
		</section>
		<!--OUR WORK END-->

		<!--CHOOSE US START-->
		<section class="chooseus" id="chooseus">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="sectionTitle">
							<h5 class="magenta text-uppercase bold"><?= lang('Who we are') ?>?</h5>
							<h2 class="lead" style="font-size:40px;"><?= lang('Discover Nice') ?></h2>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-5">
						<div class="chooseUsContent">
							<h3 class="magenta normal"><?= lang('press_title') ?></h3>
							<p><?= lang('press_text') ?></p>
							<div class="signatureandname">

							</div>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="imagesDiv chooseUsImg">
							<img src="<?= base_url() ?>/static/front/bg/main.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--CHOOSE US END-->


		<!-- supplier -->
		<section class="contact" id="supplier">
			<?= $form ?>
		</section>


		<!--TESTMONIAL START-->
		<section class="testmonialSec" id="testmonialSec">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div id="testmonialCaro">
							<div class="singleTestmn">
								<p><?= lang('press_text') ?></p>
								<div class="testAut">
									<!--  <h4>Jack Lawson</h4>-->
									<p><?= lang('press_title'); ?></p>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
		<!--TESTMONIAL END-->


		<!--CONTACT START-->
		<section class="contact" id="booking">
			<?= $book_form ?>

		</section>


		<!--COPY RIGHT START-->
		<section class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<p class="copyPera">&COPY; 2018 <?= lang('Discover Nice') ?></p>
					</div>
				</div>
			</div>
		</section>
		<!--COPY RIGHT END-->


		<a id="backToTop" href="#"><i class="fa fa-angle-double-up"></i></a>

		<!-- ALL JS -->
		<script type="text/javascript" src="<?= base_url()?>static/front/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/owl.carousel.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/slick.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/theme.js?<?= rand(0, 9999) ?>"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/lib/picker.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/lib/picker.date.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/lib/picker.time.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/lib/legacy.js"></script>
		
		<?
		if($current_lang != 'en') :?>
		<script src="<?= base_url()?>static/front/lib/translations/<?= $current_lang == 'fr' ? 'fr':'en' ?>.js"></script>


		<? endif; ?>


		<script>
		
		
		     
			let map


			var points = '<?php echo json_encode($points,JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) ?>'

			points = JSON.parse(points);

			console.log(points);


			let
			infowindow;
			let infowindowContent = document.getElementById('infowindow-content');


			$('#tour_select').change(function ()
				{

					let selected = $(this).val();


					let tour = toursData[selected]

					drawTour(tour);
					restore(tour.id);

				});
			$('.form-send').submit(function ()
				{
					//
					$('#overlay').fadeIn();
					let form = $(this).serialize();
					var submit =  $(this).closest('form').find(':submit');




					let result = $.post("<?= base_url() ?>send", form);
					result.then(e =>
						{

							if (e == 1)
							{
								$('#sendresult').text('<?= lang('Message sended,thank you')?>');

							} else
							{
								$('#sendresult').text('<?= lang('Some error please try one more tine')?> ');

							}
							submit.fadeIn();

						});
					result.error(e =>
						{
							$('#sendresult').text('<?= lang('Some error please try one more tine')?> ');
							$('#overlay').fadeIn();
							submit.fadeIn();
						})
					return false;
				})


			$('#date').pickadate(
				{
					format: 'dd/mm/yyyy',
					min: new Date()
				})

			$('#time').pickatime(
				{
					min: [7, 30], max: [21, 0],
					format:'H:i'
				})


			$(".overclass").click(function ()
				{

					$('#sendresult').text('');
					$(this).fadeOut();
				})


			/*	BotChat.App(
			{
			directLine:
			{
			secret: 'eOLiH3vaOdE.cwA.Ja4.QVdnCmjSxrkX-oN8ZA1R7vGCL6dlv-woxPBVlMo_-gg'
			},
			user:
			{
			id: 'userid'
			},
			bot:
			{
			id: 'botid'
			},
			locale: '<?= $current_lang ?>',
			resize: 'detect'
			}, document.getElementById("bot"));
			*/
			function initMap()
			{
				map = new google.maps.Map(document.getElementById('map'),
					{
						center:
						{
							lat: 43.6976763, lng: 7.268197
						},
						zoom: 14
					});

				infowindow = new google.maps.InfoWindow();

				drawPoints();

				var autocomplete = new google.maps.places.Autocomplete(document.querySelector("#pick_up"));
				autocomplete.bindTo('bounds', map);
				autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);


				autocomplete.addListener('place_changed', function ()
					{


						var place = autocomplete.getPlace();
						if (!place.geometry)
						return;


						var address = '';
						if (place.address_components)
						{
							address = [
								(place.address_components[0] && place.address_components[0].short_name || ''),
								(place.address_components[1] && place.address_components[1].short_name || ''),
								(place.address_components[2] && place.address_components[2].short_name || '')
							].join(' ');
						}


						// show button
					});
			};

			function drawPoints()
			{
				if(points == undefined)
				return;



				points.forEach(index =>
					{






						let pointOnMap = new google.maps.Marker(
							{
								position:
								{
									lat: parseFloat(index.lat),
									lng: parseFloat(index.lng)
								},
								map: map,
								title: index.title,

							});

						google.maps.event.addListener(pointOnMap, 'click', function ()
							{

								infowindowContent.children['place-title'].textContent = index.title;
								infowindowContent.children['place-desc'].innerHTML = (index.text.length == undefined) ? "" : index.text;
								infowindowContent.children['place-img'].setAttribute('src', index.img.toString());
								infowindow.setContent(infowindowContent);

								infowindow.close(); // Close previously opened infowindow
								infowindow.open(map, pointOnMap);
							});

					})

			}
			function drawTour(tour)
			{

				$('b#time').text(tour['period'])
				$('b#minute').text(tour['per_min'])
				$('b#price').text(tour['price']);
				$('#distance').html(tour['distance']);
				$('#desc').html(tour['text']);
				if (tour['tour_img'])
				$('#tour-img').attr("src",tour['tour_img'][0])
			}

		
			window.onload = function ()
			{
				initMap();

				var audio = new Audio("<?= base_url()?>/static/front/avici.mp3");


				function musicHint()
				{
					console.log("music start button working!");
					if (audio.paused || audio.currentTime === 0)
					{
						audio.play()
					}
				}

				//music stop
				function musicStop()
				{
					console.log("music start button problems");
					audio.pause();
				}

				audio.oncanplay = function ()
				{

					document.getElementById("musicHint")
					.onclick = musicHint;

					document.getElementById("musicStop")
					.onclick = musicStop;
				}

				$("#lang").click(e=>
					{
						$("#overlay-lang").fadeIn()
					});

				$("#menu").click(e=>
					{
						$("#overlay-menu").fadeIn()
					});

				$("#musicHint").click(function ()
					{
						$("#musicHint").css("display", "none");
						$("#musicStop").css("display", "block");

					});
				$("#musicStop").click(function ()
					{
						$("#musicStop").css("display", "none");
						$("#musicHint").css("display", "block");

					});
			}



		</script>

	</body>
</html>  