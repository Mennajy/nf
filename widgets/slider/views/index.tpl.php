<div id="carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel" data-slide-to="0" class="active"></li>
		<li data-target="#carousel" data-slide-to="1"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="<?php echo image('slide1.jpg'); ?>" alt="..." />
			<div class="carousel-caption hidden-xs">
				<h3>Faction : Le Capitole</h3>
				<p>De terrifiantes rumeurs entourent le Capitole et son mysterieux leader, l'Oracle. Oserez vous, vous en rapprocher ?</p>
			</div>
		</div>
		<div class="item">
			<img src="<?php echo image('slide2.jpg'); ?>" alt="..." />
			<div class="carousel-caption hidden-xs">
				<h3>Faction : Fox Company</h3>
				<p>Un groupe de soldats surentrainés, mais personne n'était suffisament prêt pour ce qu'il s'est passé ...</p>
			</div>
		</div>
	</div>
	<a class="left carousel-control hidden-xs" href="#carousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control hidden-xs" href="#carousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>