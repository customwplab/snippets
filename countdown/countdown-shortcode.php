<?php 
//Countdown
add_shortcode('cb_countdown', 'cb_countdown_sc');
function cb_countdown_sc($atts){
	
	$atts = shortcode_atts(
        array(
            'id' => '',
        ), $atts);
 
		ob_start();
	$row_id = (!empty($atts['id'])) ? $atts['id'] : false;
	

	/* Timezone acf bug fix */
	//date_default_timezone_set('America/Edmonton');
	$now_h = date('H', time());
	$now_gmt_h = gmdate('H', time());	
	$diff = $now_h - $now_gmt_h; //Hours to offset ACF date/time value 
	$offset = $diff .' hours';
	
	$countdown_end = get_field('countdown_end', 'option');
	$countdown_end_time =  strtotime($countdown_end .' '.$offset);

	if(time() < $countdown_end_time ){
		//Output countdown
		?>
		<div id="cb-countdown" class="countdown-container">
			<div class="countdown-heading">
				<h4>Blowing in</h4>
			</div>
			
			<?php if(time() < strtotime($countdown_end)):?> 
			<div id="countdown-timer" class="countdown-timer"
				data-start="<?php echo date('Y/m/d H:i:s', time());?>" 
				data-end="<?php echo  date('Y/m/d H:i:s', $countdown_end_time);?>"
				data-label-days="Days"
				data-label-hours="Hours"
				data-label-hours-sm="Hr"
				data-label-minutes="Minutes"
				data-label-minutes-sm="Min"
				data-label-seconds="Seconds"
				data-label-seconds-sm="Sec"
				data-url="<?php echo get_the_permalink();?>">
			</div>
			<?php endif;?>
		</div>
		<?php 
	}

	return ob_get_clean();

}
