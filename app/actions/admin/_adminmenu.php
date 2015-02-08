<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}

function giveSelected($key){
	if (isset($_GET['b']) && $key == sanitize_string($_GET['b'])){ return " class='active'"; }
	else{ return ""; }
}
function giveSelecteds($keyarr){
	foreach($keyarr as $key){
		if (isset($_GET['b']) && $key == sanitize_string($_GET['b'])){ return " active"; }
	}
	return "";
}

?>
<div class="container">
	<div class="row adminrow">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
			<li class="dropdown <?php echo giveSelecteds(array('oyunlar', 'oyunekle')); ?>">
				<a href="#" data-toggle="dropdown">Oyun</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li <?php echo giveSelected('oyunlar'); ?>><a href="/index.php?a=administration&b=oyunlar">Oyunlar</a></li>
					<li <?php echo giveSelected('oyunekle'); ?>><a href="/index.php?a=administration&b=oyunekle">Oyun Ekle</a></li>
				</ul>
			</li>
			<li class="dropdown <?php echo giveSelecteds(array('takimlar')); ?>">
				<a href="#" data-toggle="dropdown">Takım</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li <?php echo giveSelected('takimlar'); ?>><a href="/index.php?a=administration&b=takimlar">Takımlar</a></li>
				</ul>
			</li>
			<li class="dropdown <?php echo giveSelecteds(array('maclar', 'macekle')); ?>">
				<a href="#" data-toggle="dropdown">Maç</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li <?php echo giveSelected('maclar'); ?>><a href="/index.php?a=administration&b=maclar">Maçlar</a></li>
					<li <?php echo giveSelected('macekle'); ?>><a href="/index.php?a=administration&b=macekle">Maç Ekle</a></li>
				</ul>
			</li>
			<li class="dropdown <?php echo giveSelecteds(array('specialbetekle', 'specialbets')); ?>">
				<a href="#" data-toggle="dropdown">Special Bet</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li <?php echo giveSelected('specialbetekle'); ?>><a href="/index.php?a=administration&b=specialbetekle">Special Bet Ekle</a></li>
				</ul>
			</li>
			<li class="dropdown <?php echo giveSelecteds(array('stats')); ?>">
				<a href="/index.php?a=administration&b=stats">İstatistikler</a>
			</li>
		</ul>
	</div>
</div>