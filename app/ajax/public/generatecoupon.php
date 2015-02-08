<?php
if (isset($_POST['kuponid'])){
	$kuponid = sanitize_string($_POST['kuponid']);
	$kupon = new kupon($kuponid);
}
?>

<!-- Kupon -->
<div class="simplelist" id="kupon">
	<div class="simplelist_tabs">
		<div class="simplelist_tab active">
			<div class="simplelist_title">Kupon</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="simplelist_content">
		<ul class="list-unstyled simplelist_ul selectedmatches">
		</ul>
		<!-- DESIGN -->
		<!-- keep deposit input(text) as input#totalbar_money_input -->
		<!-- keep play button as #playthis -->
		<!-- keep share button as #sharethis -->
		<div class="totalbar">
			<div class="totalbar_column" id="left">
				<div class="totalbar_element totalbar_rate">
					<div class="totalbar_element_child totalbar_rate_txt">Oran</div>
					<div class="totalbar_element_child totalbar_rate_rate">: <span class="ratetxt">1.00</span></div>
					<div class="clearfix"></div>
				</div>
				<div class="totalbar_element totalbar_money">
					<div class="totalbar_element_child totalbar_money_txt">Yatırım</div>
					<div class="totalbar_element_child totalbar_money_money">: <input type="text" name="totalbar_money_input" id="totalbar_money_input" class="totalbar_money_input"></div>
					<div class="clearfix"></div>
				</div>
				<div class="totalbar_element totalbar_earning">
					<div class="totalbar_element_child totalbar_earning_txt">Kazanç</div>
					<div class="totalbar_element_child totalbar_earning_earning">: <span class="earningtxt">0.00</span></div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="totalbar_column" id="right">
				<input type="button" class="btn btn-xs btn-default totalbar_button" id="playthis" value="Play This">
				<input type="button" class="btn btn-xs btn-default totalbar_button" id="clearcoupon" value="Clear">
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>