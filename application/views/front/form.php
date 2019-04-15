<div class="container">
	<div class="row">

		<div class="col-lg-12 text-center">
			<div class="contactInner">


				<h3 class="magenta light">
					<?= isset($booking) ? lang('Booking  form') : lang('Supplier  form'); ?>

				</h3>


				<div class="contactForm">
					<form action="send.php" class="form-send" method="post">
						<div class="row">


							<input type="hidden" name="subject"
							value=" <?= isset($booking) ? lang('Booking  form') : lang('Supplier  form'); ?>"/>


							<?
							if(isset($booking)) : ?>
							<div class="col-sm-6">
								<div class="single_form">
									<label for="con_name"><?= lang('Tour date') ?></label>
									<input type="text" id="date" name="date" required class="required">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="single_form">
									<label for="con_phone"><?= lang('Time') ?></label>
									<input id="time" type="text" name="hour" required class="required">
								</div>
							</div>

							<? endif; ?>
							<div class="row">
								<div class="col-sm-6">
									<div class="single_form">
										<label for="con_company"><?= lang('Title') ?></label>
										<select name="title">
											<option value="<?= lang('Mr') ?>"><?= lang('Mr') ?></option>
											<option value="<?= lang('Mrs') ?>"><?= lang('Mrs') ?></option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="single_form">
										<label for="con_email"> <?= lang('Name Lastname') ?></label>
										<input type="text" name="name" required class="required">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="single_form">
										<label for="con_company"> <?= lang('Email') ?></label>
										<input type="email" required name="email">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="single_form">
										<label for="con_email"><?= lang('Phone') ?> </label>
										<input type="tel" required name="phone" class="required">
									</div>
								</div>
							</div>

							<?
							if(isset($booking)) : ?>
							<div class="row">
								<div class="col-sm-12">
									<div class="single_form">
										<label for="tours"><?= lang('Tours') ?></label>
										<select id="tour_select" name="tours">
											<?



											foreach($tours as $tour): ?>
											<option value="<?= $tour['id'] ?>">
											<?= $tour['title']?></option>
											<? endforeach; ?>

										</select>
									</div>
								</div>
							</div>  
							
							<!--<div class="row">
							
							<? //print_r($tours); ?>
							</div> -->
							<div class="row">
								<div class="col-sm-3">
									<div class="single_form">
										<label for="tours"><?= lang('Period')?> <b
                                                        id="time"><?= reset($tours)['period'] ?></b></label>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="single_form">
										<label for="tours"><?= lang('Price per person')?>: 
										<b id="price"><?=  reset($tours)['price'] ?>
											</b>
											&nbsp; <b id="minute"><?=  reset($tours)['per_min'] ?>  </b>
											<?= lang('eur/ 1 min') ?>
										</label>

									</div>
								</div>
								<div class="col-sm-3">
									<div class="single_form" style="display:none;"   >
										<label for="tours"> <b id="distance"><?=  reset($tours)['distance'] ?>
											</b>

											Km
										</label>

									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<div class="single_form">
											<label for="tours">

												<input name="meeting_point" value="meeting_point"
												data-toggle="collapse"
												data-target="#collapseOne"
												aria-expanded="false" aria-controls="collapseOne"
												type="checkbox" class="form-inline" checked/>
												&nbsp;&nbsp;
												<a style="  color: #fd0060;" title="<?= lang('view on map') ?>"
                                                       href="#geolocation"> <?= lang('I self go till meeting point') ?>
												</a> </label>
											<div id="collapseOne" aria-expanded="false" class="collapse">
												<div class="single_form">
													<label style=""
                                                               for="tours"><?= lang('Extra fees') ?></label>
													<input type="text"
													id="pick_up"
													placeholder="<?= lang('Pick up location') ?>"
													name="pick_up"/>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<div class="single_form">
											<label for="tours" data-toggle="collapse"
												data-target="#two"
												aria-expanded="false" aria-controls="two"  style=" color: #fd0060;" >

												<input  value="terms"
												
												type="checkbox" class="form-inline" checked/>
												&nbsp;&nbsp;
												required
                                                       <?= lang('I agree terms of user') ?>
												 </label>
											<div id="two" aria-expanded="false" class="collapse">
												
													<ul style="color:white;font-size:12px;">
														<? foreach(lang('terms') as $rule):?>
															<li><?= $rule ?></li>
														<? endforeach;?> 
													</ul>
														
												
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-9">
									<div class="single_form">
										<a href="#second_map" title="View map">
											<div id="desc" style="color:white;font-size: 12px;line-height: 20px;">

												<?=    reset($tours)['text']  ?>

											</div>

										</a>

									</div>
								</div>
								
						

								<div class="col-sm-3">
									<div class="single_form">
										<a>
											<img id="tour-img"   style="width: 200px;height: 200px ;
											 object-fit: cover;" src="<?=  reset($tours)['tour_img'][0] ?>" />
										</a>

									</div>
								</div>
							</div>


							<? endif; ?>

							<div class="row">
								<div class="col-sm-12">
									<div class="single_form">
										<div class="g-recaptcha" data-sitekey="6Leh_oUUAAAAACc9AQR1H08rIEuIhUTMwNHleH_B"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="single_form">
										<label for="con_msg"><?= lang('Message') ?></label>
										<textarea id="con_msg" required name="message" class="required" rows="4"
                                                  cols="50"></textarea>
									</div>
								</div>
							</div>
							<div class="col-sm-12 text-center">
								<input type="submit" value="<?= lang('Send') ?>" class="bes_button">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<br/>
<br/>
<?
if(isset($booking)):?>

<div id="second_map" style="height: 700px;">

</div>

<script>

	var secondMap;
	var flightPath


	function secondInit()
	{
		/* secondMap = new google.maps.Map(document.getElementById('second_map'), {
		zoom: 11,
		center: new google.maps.LatLng(43.7031691, 7.1827772),
		// mapTypeId: google.maps.MapTypeId.SATELLITE,
		disableDefaultUI: false,
		zoomControl: true
		});
		*/
	}


	function restore(arg)
	{


		secondMap = new google.maps.Map(document.getElementById('second_map'),
			{
				zoom: 14,
				center: new google.maps.LatLng(43.6971673,7.2713769),
				// mapTypeId: google.maps.MapTypeId.SATELLITE,
				disableDefaultUI: false,
				zoomControl: true
			});

		//let e = toursData.find(x=>x.id == arg);

		let e = toursData[arg];
		
		
		
		


	/*	var flightPath = new google.maps.Polyline(
			{
				path:JSON.parse(e.path),
				geodesic: true,
				strokeColor: '#FF0000',
				strokeOpacity: 1.0,
				strokeWeight: 2
			});


		if(arg == '7')
		return;

		flightPath.setMap(secondMap);
		if (JSON.parse(e.path))
		{
			zoomToObject(flightPath);
		}

		if (e.pointArray == undefined)
		return;*/
		
		console.log(e)

		e['points'].forEach(index =>
			{

    
				 let pointOnMap = new google.maps.Marker(
					{
						position:
						{
							lat: parseFloat(index.lat),
							lng: parseFloat(index.lng)
						},
						map: secondMap,
						title: index.title,

					});
				
				console.log(parseFloat(index.lat),parseFloat(index.lng))
					

				google.maps.event.addListener(pointOnMap, 'click', function ()
					{

						infowindowContent.children['place-title'].textContent = index.title  ;
						infowindowContent.children['place-desc'].innerHTML =index.text
						infowindowContent.children['place-img'].setAttribute('src',index.img[0].toString())  ;
						infowindow.setContent(infowindowContent);

						infowindow.close(); // Close previously opened infowindow
						infowindow.open(secondMap, pointOnMap);
					});

			})
	}

	<? if(isset($booking)) :?>
	restore("<?= reset($tours)['id'] ?>");
	<? endif; ?>

	function zoomToObject(obj)
	{
		var bounds = new google.maps.LatLngBounds();
		var points = obj.getPath().getArray();
		for (var n = 0; n < points.length ; n++)
		{
			bounds.extend(points[n]);
		}
		secondMap.fitBounds(bounds);
	}

</script>

<? endif;?>