<html>
	<head><title></title></head>
	<body>



<!--
	
	orange: #f99338
	blue: #0666f2
	
	
<style>
	html, body, .abramos-las-jaulas {
		background-color: #FFFFFF;
	}
	.abramos-las-jaulas .row {
		width: 100%;
		max-width: 965px;
		padding: 0 20px;
		margin: 0 auto;
	}
	.abramos-las-jaulas strong {
		font-weight: 600;
	}
</style>
-->
<main role="main" class="abramos-las-jaulas">





	<style>
		.hero {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			width: 100%;
			padding: 211px 20px;
			background-color: #FFFFFF;
			background-image: url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/abramos-las-jaulas-hero-v2-scaled.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
		}
		.hero h1 {
			margin-bottom: 50px;
			color: #FFFFFF;
			font-family: "Gotham Pro","Gotham A","Gotham B",Gotham,Helvetica,"Helvetica Neue",Arial,sans-serif;
			-webkit-font-smoothing: antialiased;
			font-size: 3.4375em;
			font-weight: 700;
		}
		.hero a {
			padding: 16px 57px 14px;
			color: #FFFFFF;
			background-color: #f99339;
			border-radius: 0px 0px 0px 0px;
			text-align: center;
			font-size: 22.57px;
			line-height: 25.26px;
			font-weight: 700;
			cursor: pointer;
		}
		.hero a:hover {
			
		}
		@media only screen and (max-width: 965px) {
			.hero .row {
				flex-wrap: wrap;
			}
		}
	</style>
	<section class="hero">
		<h1>Abramos las jaulas.</h1>
		<a href="#peticion">Actúa ahora</a>
	</section>


	<style>
		.petition {
			width: 100%;
			padding: 113px 20px 89px;
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}
		.petition .row {
			flex-wrap: wrap;
			justify-content: center;
		}
		@media (max-width: 975px) {
			.petition .row {
				align-items: center;
			}
		}
		@media (max-width: 600px) {
			.petition .row {
				flex-direction: column;
			}
		}
		.petition .title-wrap {
			display: flex;
			justify-content: center;
			width: 100%;
		}
		.petition .title-wrap h2 {
			width: 100%;
			max-width: 820px;
			margin-bottom: 50px;
			color: #f99338;
			text-transform: uppercase;
			text-align: center;
			font-size: 28px;
			line-height: 32px;
			font-weight: 500;
		}
		.petition .sub-head-wrap {
			display: flex;
			justify-content: center;
			width: 100%;
		}
		.petition .sub-head-wrap .sub-head {
			width: 100%;
			max-width: 820px;
			margin-bottom: 20px;
			text-align: center;
			font-size: 32px;
			line-height: 34px;
			font-weight: 500;
		}
		.petition .text-wrap {
			justify-content: center;
			width: 100%;
			max-width: 820px;
			margin: 0 auto;
			text-align: center;
			font-size: 20px;
			line-height: 30px;
		}
		.petition .petition-info-wrap {
			width: 100%;
			max-width: 820px;
			margin: 0 auto 30px;
			font-size: 20px;
			line-height: 30px;
		}
		.petition .petition-info-wrap .accordion {
			width: 100%;
			padding: 18px;
			transition: 0.4s;
			color: #262626;
			background: none;
			border: none;
			outline: none;
			text-align: center;
			cursor: pointer;
		}
		.petition .petition-info-wrap i {
			margin-left: 10px;
		}
		.petition .petition-info-wrap .panel {
			display: none;
			width: 100%;
			padding: 0 18px 20px;
			margin-bottom: 30px;
			overflow: hidden;
			text-align: center;
		}
		.petition .petition-info-wrap p {
			margin-bottom: 20px;
		}
		.petition .petition-info-wrap p:last-child {
			margin-bottom: 0;
		}
	</style>
	<section id="peticion" class="petition">
		<div class="title-wrap">
			<h2>¡Abramos las jaulas juntos!</h2>
		</div>
		<div class="sub-head-wrap">
			<div class="sub-head">Firma la petición</div>
		</div>
		<div class="text-wrap">
			Ayuda a las gallinas y pronunciate en contra de esta crueldad
		</div>
		<div class="petition-info-wrap">
			<button class="accordion">Lee la petición aquí<i class="fa fa-caret-right"></i></button>
			<div class="panel">
				Seitan habanero golden bruschetta green tea lime cayenne cocoa crispy iceberg lettuce Italian linguine puttanesca apricot potato blood orange smash blueberry chia seed jam summer lemon tahini dressing red pepper apples tempeh kale.
			</div>
		</div>
		<div class="form-wrap">
			<iframe id="iframe_petition" style="width:1px;min-width:100%;height:290px;border:0" src="https://mymfa.mercyforanimals.org/page/29845/subscribe/1"></iframe>
		</div>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.2.11/iframeResizer.min.js" async></script>
	<script>
		var acc = document.getElementsByClassName("accordion");
		var i;
		for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
				/* Toggle between adding and removing the "active" class,
				to highlight the button that controls the panel */
				this.classList.toggle("active");
				/* Toggle between hiding and showing the active panel */
				var panel = this.nextElementSibling;
				if (panel.style.display === "block") {
					panel.style.display = "none";
				} else {
					panel.style.display = "block";
				}
			});
		}
		function loop_iframe_resize() {
			if (!window.iFrameResize) {
				setTimeout(function(){
					loop_iframe_resize();
				}, 1000);
				return;
			}
			iFrameResize({ checkOrigin: ['https://mymfa.mercyforanimals.org'], log: false }, '#iframe_petition');
		}
		loop_iframe_resize();
	</script>


	<style>
		.video-player {
			width: 100%;
		}
		.video-player .video-wrapper {
			width: 100%;
			height: 0;
			position: relative;
			padding: 30px 20px 45.25%;
			margin: 0 auto;
			overflow: hidden;
		}
		@media (max-width: 600px) {
			.video-player .video-wrapper {
				padding: 30px 20px 70%;
			}
		}
		.video-player .video-wrapper iframe {
			left: 0;
			top: 0;
			height: 100%;
			width: 100%;
			position: absolute;
		}
		.video-player .vimeo-video-wrapper {
			height: 0;
			overflow: hidden;
			max-width: 100%;
			height: auto;
			position: relative;
			padding-bottom: 56.25%;
		}
		.video-player .vimeo-video-wrapper iframe, .video-player .vimeo-video-wrapper object, .video-player .vimeo-video-wrapper embed {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	</style>
	<section class="video-player video-player-<?php echo $widget_id ?>">
		<div class="video-wrapper">
			<iframe width="1200" height="675" src="https://www.youtube.com/embed/2lXD0vv-ds8?rel=0&wmode=transparent&autoplay=0&mute=0" frameborder="0" allowfullscreen></iframe>
		</div>
	</section><!-- .video-player -->

	<style>
		.percentage {
			width: 100%;
			box-sizing: border-box;
			padding: 145px 20px;
			background-color: #f0f0f0;
		}
		.percentage .row {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			max-width: 960px;
			margin: 0 auto;
		}
		.percentage .text {
			width: 100%;
			max-width: 536px;
			margin-right: 40px;
			color: #000000;
			text-transform: uppercase;
			text-align: center;
			font-size: 28px;
			line-height: 35.61px;
		}
		.percentage .orange {
			color: #f99338;
		}
		.percentage .image {
			width: 330px;
		}
		.percentage .image img {
			max-width: 100%;
		}
		.percentage .subtext {
			width: 100%;
			max-width: 575px;
			margin: 50px auto 0;
			font-size: 17.05px;
			line-height: 26.92px;
		}
		.percentage .subtext p {
			text-align: center;
		}
	</style>
	<section class="percentage">
		<div class="row">
			<div class="text">
				Alrededor del <span class="orange">90%</span> de las gallinas usadas para la producción de huevos en México se encuentran enjauladas.
			</div>
			<div class="image">
				<img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/ninety-percent-graph.png" alt="Ninety Percent Graph">
			</div>
		</div>
		<div class="subtext">
			<p>Las gallinas son animales sensibles e inteligentes con capacidad de sentir dolor.</p>
			<p><strong>¡Ayúdalas a estar fuera de las jaulas!</strong></p>
		</div>
	</section>

	<style>
		.slider {
			width: 100%;
			padding: 120px 20px 130px;
			color: #000;
			background-color: #FFFFFF;
		}
		@media (max-width: 615px) {
			.slider {
				padding: 117px 20px 65px 20px;
			}
		}
		.slider h2 {
			width: 100%;
			max-width: 700px;
			margin: 0 auto 100px;
			text-transform: uppercase;
			text-align: center;
		}
		.slider .slides {
			width: 100%;
			max-width: 1024px;
			margin: 0 auto;
		}
		.slider i {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			z-index: 5;
			color: #010101;
			cursor: pointer;
			font-size: 1.5rem;
		}
		.slider .fa-chevron-left {
			left: 20px;
		}
		.slider .fa-chevron-right {
			right: 20px;
		}
		.slider .slide {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		@media (max-width: 615px) {
			.slider .slide {
				flex-wrap: wrap;
				justify-content: center;
			}
		}
		.slider .slide .image {
			width: 350px;
			min-width: 350px;
			height: 350px;
			min-height: 350px;
			border: 10px solid #f0f0f0;
			border-radius: 50%;
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}
		@media (max-width: 615px) {
			.slider .slide .image {
				margin: 0 auto;
			}
		}
		.slider .slide .text {
			max-width: 544px;
			margin-left: 85px;
		}
		@media (max-width: 950px) {
			.slider .slide .text {
				margin-left: 40px;
			}
		}
		@media (max-width: 615px) {
			.slider .slide .text {
				margin: 40px auto 0 auto;
			}
		}
		.slider .slide .name {
			margin-top: 27px;
			font-size: 16px;
		}
	</style>
	<section class="slider">
		<h2>La producción de huevo bajo el sistema de gallinas enjauladas</h2>
		<div id="slider">
			<div class="slide">
				<div class="image" style="background-image:url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/chicken-slide-one-v2.jpg');"></div>
				<div class="text">
					<p>A las pollitas les cortan el pico sin aplicarles ningún tipo de anestesia. Usualmente se realiza con una cuchilla caliente, por lo que es un procedimiento extremadamente doloroso.</p>
					<p>Los gallos ni siquiera existen. Los pollitos machos son asesinados apenas a un día de nacidos por ser considerados desecho por la industria del huevo.</p>
				</div>
			</div><!-- .slide -->
			<div class="slide">
				<div class="image" style="background-image:url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/chicken-slide-two.jpg');"></div>
				<div class="text">
					<p>Cada ave pasa toda su vida en un espacio no mayor a una hoja de papel. Las gallinas no pueden caminar, extender sus alas, anidar, posarse en ramas, ni realizar cualquier otro comportamiento natural de su especie.</p>
				</div>
			</div><!-- .slide -->
			<div class="slide">
				<div class="image" style="background-image:url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/chicken-slide-three.jpg');"></div>
				<div class="text">
					<p>Debido a la falta de espacio, algunas gallinas pueden llegar a ser pisoteadas hasta la muerte.</p>
					<p>Estar encerradas en jaulas les provoca cojera, fragilidad ósea y debilidad muscular.</p>
				</div>
			</div><!-- .slide -->
			<div class="slide">
				<div class="image" style="background-image:url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/chicken-slide-four.jpg');"></div>
				<div class="text">
					<p>Densidades altas de población, mucho estrés, condiciones insalubres y el uso indiscriminado de antibióticos facilitan que las enfermedades crucen especies e infecten a los humanos.</p>
				</div>
			</div><!-- .slide -->
			<div class="slide">
				<div class="image" style="background-image:url('https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/chicken-slide-five.jpg');"></div>
				<div class="text">
					<p>Las gallinas padecen deficiencias inmunológicas, lo cual hace que sean susceptibles a sufrir enfermedades. A causa de esto, se hace un uso excesivo de antibióticos, no solo para tratar infecciones, sino también para que puedan sobrevivir a las precarias condiciones a las que son sometidas.</p>
				</div>
			</div><!-- .slide -->
		</div><!-- #slider -->
	</section>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#slider').slick({
				dots: false,
				infinite: true,
				speed: 1000,
				fade: false,
				cssEase: 'linear',
				lazyLoad: 'ondemand',
				lazyLoadBuffer: 0,
				nextArrow: '<i class="fa fa-chevron-right"></i>',
				prevArrow: '<i class="fa fa-chevron-left"></i>',
			});
		});
	</script>

	<style>
		.chicken-info-desktop {
			width: 100%;
			box-sizing: border-box;
			padding: 145px 20px;
			background-color: #f0f0f0;
		}
		.chicken-info-desktop h2 {
			width: 100%;
			max-width: 700px;
			margin: 0 auto 0;
			text-transform: uppercase;
			text-align: center;
		}
		.chicken-info-desktop .subhead {
			width: 100%;
			max-width: 820px;
			margin: 20px auto;
			text-align: center;
			font-size: 18px;
			line-height: 24px;
			font-weight: 500;
		}
		.chicken-buttons {
			margin: 40px auto;
		}
		.top-border {
			width: 100%;
			max-width: 842px;
			height: 55px;
			margin: 0 auto 20px;
			border-top: 10px solid #FFFFFF;
			border-right: 10px solid #FFFFFF;
			border-left: 10px solid #FFFFFF;
		}
		.bottom-border {
			width: 100%;
			max-width: 842px;
			height: 55px;
			margin: 20px auto 0;
			border-right: 10px solid #FFFFFF;
			border-bottom: 10px solid #FFFFFF;
			border-left: 10px solid #FFFFFF;
		}
		.buttons {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			max-width: 1020px;
			margin: 0 auto;
		}
		.buttons div {
			cursor: pointer;
		}
		.chicken-text {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.chicken-text div {
			color: #000000;
		}
		.chicken-text .show {
			display: block;
		}
		.chicken-text .hide {
			display: none;
		}
		@media (max-width: 615px) {
			.chicken-info-desktop {
				display: none;
			}
		}
	</style>
	<section class="chicken-info-desktop">
		<h2>¡Descubre la vida de las gallinas fuera de las jaulas!</h2>
		<div class="subhead">Haz clic en cada imagen.</div>
		<div class="chicken-buttons">
			<div class="top-border"></div>
			<div class="buttons">
				<div id="chicken-one" class="chicken-one chicken-button"><img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/Gallina_01_chica.gif"></div>
				<div id="chicken-two" class="chicken-two chicken-button"><img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/Gallina_02_chica.gif"></div>
				<div id="chicken-three" class="chicken-three chicken-button"><img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/Gallina_03_chica.gif"></div>
				<div id="chicken-four" class="chicken-four chicken-button"><img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/Gallina_04_chica.gif"></div>
				<div id="chicken-five" class="chicken-five chicken-button"><img src="https://mercyforanimals.lat/mercy4animals.wpengine.com/sites/519/2021/05/Gallina_05_chica.gif"></div>
			</div>
			<div class="bottom-border"></div>
		</div><!-- .chicken-buttons -->
		<div id="chicken-text" class="chicken-text">
			<div id="text-default" style="display: block;">
				Al estar enjauladas, las gallinas no pueden realizar estos comportamientos naturales de su especie.
			</div>
			<div id="text-one" style="display: none;">
				chicken one
			</div>
			<div id="text-two" style="display: none;">
				chicken two
			</div>
			<div id="text-three" style="display: none;">
				chicken three
			</div>
			<div id="text-four" style="display: none;">
				chicken four
			</div>
			<div id="text-five" style="display: none;">
				chicken five
			</div>
		</div>
		<div class="button-wrap">
			<a href="">Únete para que las gallinas puedan estar fuera de las jaulas</a>
		</div>
	</section>
	<script>
		jQuery(document).ready(function($){
			$("#chicken-one").click(function(){
				$("#text-two").toggleClass('hide show');
				$("#text-two").siblings().removeClass('show');
				$("#text-two").siblings().addClass('hide');
			});
			$("#chicken-two").click(function(){
				$("#text-two").toggleClass('hide show');
				if ($("#text-two").siblings().style.display === "none") {
				} else {
					$("#text-two").siblings().style.display = "none";
				}
			});
		});
	</script>



</main>






</body>
</html>
