<div id="carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel" data-slide-to="0" class="active"></li>
		<li data-target="#carousel" data-slide-to="1"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="<?php echo image('slider/slide1.jpg'); ?>" alt="" />
			<div class="carousel-caption hidden-xs">
				<h2>Faction : Le Capitole</h2>
				<p class="lead">De terrifiantes rumeurs entourent le Capitole et son mysterieux leader, l'Oracle. Oserez vous, vous en rapprocher ?</p>
				<a href="http://www.lyseria.com/forum/topic/11/background-le-capitole" class="btn btn-primary">Background</a>
			</div>
		</div>
		<div class="item">
			<img src="<?php echo image('slider/slide2.jpg'); ?>" alt="" />
			<div class="carousel-caption hidden-xs">
				<h2>Faction : Fox Company</h2>
				<p>Un groupe de soldats surentrainés, mais personne n'était suffisament prêt pour ce qu'il s'est passé ...</p>
				<a href="http://www.lyseria.com/forum/topic/16/bg-fox-company-fox-co" class="btn btn-primary">Background</a>
			</div>
		</div>
	</div>
	<a class="left carousel-control hidden-xs" href="#carousel" role="button" data-slide="prev">
		<i class="fa fa-angle-left"></i>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control hidden-xs" href="#carousel" role="button" data-slide="next">
		<i class="fa fa-angle-right"></i>
		<span class="sr-only">Next</span>
	</a>
</div>
