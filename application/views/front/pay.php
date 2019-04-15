<!DOCTYPE html>
<html lang="en">
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

		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" id="cookiebanner"
  src="https://cdnjs.cloudflare.com/ajax/libs/cookie-banner/1.2.2/cookiebanner.min.js"></script>
		<!-- Favicon Icon -->
		<style>
			.row
			{
				margin-right: 0px;
				margin-left: 0px;
			}
		</style>

	</head>



	<body>
		

	<div id="overlay" class="overclass" >

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

		<div class="wsk-float">
			<a href="#help" class="pulse-button">
				<h1 class="fas fa-comments " id="open_chat" style="top: 16px;left: 14px;color: white;"></h1>

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
		<div id="overlay" class="overclass">

			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="sectionTitle bigTitle2" style="margin-top: 20%;">

						<h1 class="magenta text-uppercase bold" id="sendresult"></h1>

					</div>
				</div>
			</div>
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
						<span class="dropdown">
							<span class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
								<img style='width:30px; margin:5px;' src='<?= base_url()?>static/front/country-flags/<?= $current_lang ?>.png'>
							</span>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<?
								foreach($langs as $url => $name): ?>

								<a class="lang-class" href="<?= base_url() . '?lang=' . $url ?>">

									<img title="<?= $name ?>" style='width:30px;heigh:20px;'
									src='<?= base_url() ?>static/front/country-flags/<?= $url ?>.png'>
									<?= $name ?>
								</a>
								<br>
								<? endforeach; ?>
							</div>
						</span>
					</div>
					<div   class="top_quart">
						
					</div>
				</div>
				<div class="collapse" id="navbarToggleExternalContent">
					<div class="menu">
						<ul class="main_menu">
							<li class="scroll"><a href="#booking"><?= lang('Booking') ?></a></li>
								<li class="scroll"><a href="#ourwork"><?= lang('galery') ?></a></li>
								<li><a download="presentation.ppt"
                               href="<?= base_url() ?>/presentation/presentation.ppt"><?= lang('Tours') ?></a></li>
								<li class="scroll"><a href="#"><?= lang('News') ?> </a>

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



		<section class="contact" id="contact">

			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="contactInner" style="min-height: 100vh;"  >


							<h3 class="magenta light"><?= $query['tour'] ?></h3>					
							<h5 class="magenta light"><?= $query['order_date'] ?></h5>	
									
  
							<?
							if($query['payed'] > 0 ) :?>
							<h2 class="magenta light"><?= lang('alredy payed') ?> </h2>
	<a href="<?= base_url() ?>" style="color:#fff;"><?= lang('Discover Nice') ?></a>
							<?
							else :?>
							<h4 class="magenta light"><?= lang('total')?> <b><?= $query['price'] ?>  € </b></h4>
							<div class="contactForm">
								<form
								v-on:submit.prevent="pay"
								class="form-send" >
									<div class="row">


										<div class="col-sm-12">
											<div class="single_form">
												<label for="con_email"><?= lang('Credit card'); ?></label>
												<input  
												autocomplete="cc-number"
												 @input="credit" v-model="number" 
												  minlength="19" maxlength="19"   required class="required">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_email"><?= lang('Exp Year'); ?></label>
												<select name="expYear" v-model="expYear" >
													<?
													for($i = 2019 ; $i < 2070 ; $i++):?>
													<option value="<?= $i ?>">
														<?= $i ?>
													</option>>

													<? endfor;?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_company"><?= lang('Exp Month'); ?></label>
												<select v-model="expMonth"  >
													<?
													for($i = 1 ; $i < 13 ; $i++):?>
													<option value="<?  printf("%02d", $i); ?>">
														<?  printf("%02d", $i); ?>
													</option>>

													<? endfor;?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="single_form">
												<label for="con_email"><?= lang('Cvc'); ?></label>
												<input
												minlength="3"
												maxlength="3"
												type="tel"
												name="cvc"
												 autocomplete="cc-csc"
												required class="required">

											</div>
										</div>
<div class="col-sm-6">
											<div class="single_form">
											<img  src="<?= base_url()?>/static/front/image001.jpg" style="width:250px" />
											</div>
										</div>


										<div class="col-sm-12 text-center">
											<div class="single_form">
												<label  :display="infoText != null " >
													{{ infoText }}

												</label>
											</div>


											<input id="send"  type="submit" value="<?= lang('Send'); ?>" class="bes_button">
											<br />
											<br />
											<br />
											<a href="<?= base_url() ?>" style="color:#fff;"><?= lang('Discover Nice') ?></a>
										</div>
									</div>
								</form>
							</div>
							<? endif ;?>




						</div>
					</div>
				</div>
			</div>
		</section>
		<!--CONTACT END-->

		<!--OUR WORK START-->


		<!--COPY RIGHT START-->
		<section class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<p class="copyPera">&COPY; <?= date('Y') ?> <?= lang('Discover Nice') ?></p>
					</div>
				</div>
			</div>
		</section>
		<!--COPY RIGHT END-->


		
		<!-- ALL JS -->
		<script type="text/javascript" src="<?= base_url()?>static/front/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/owl.carousel.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/slick.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/front/js/theme.js?<?= rand(0, 9999) ?>"></script>


		<script src="https://cdn.botframework.com/botframework-webchat/latest/botchat.js"></script>
		<script src="https://cdn.botframework.com/botframework-webchat/latest/CognitiveServices.js"></script>


		<script>

			$("#overlay").click(function ()
				{

					$('#sendresult').text('');
					$(this).fadeOut();
				})

			new Vue(
				{
					el: "#contact",
					data:
					{

						infoText: null,
						number : null ,
						expMonth: null ,
						expYear: null ,
						cvc: null ,

					},
					methods:
					{	
						credit(e){
						
							this.number =  e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
						},
						pay ()
						{
							
							$('#overlay').fadeIn();
							
							
							Stripe.setPublishableKey('<?= STRIPE_PK ?>');
							Stripe.card.createToken(
								{
									number: this.number, // 16-digit credit card number
									expMonth: this.expMonth, // expiry month
									expYear: this.expYear, // expiry year
									cvc: this.cvc,
								}, (status, response)=>
								{
									if (response.error)
									{
										this.infoText = response.error.message
									}
									else
									{

										var token = response.id;

										let pay = $.post("<?= base_url().'/manage/pay/'.$id ?>",
											{
												token:token
											});

										pay.then(e=>
											{



												let res = JSON.parse(e);
												this.infoText = res.message;
											
												/*if(res.result == true)
												{
													
													//location.reload();
												}*/
												$('#overlay').fadeOut();
													
											})
									}
								}
							);
							
						}
					}
				});

			

		</script>

	</body>
</html>  