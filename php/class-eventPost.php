<?php 
/** Event Post Class **/
class eventPost {
	
    protected $post_id = null;

    public function __construct($post_id){
        $this->post_id = $post_id;
    }

	//get dates
	public function get_dates() {
		
		$start_date = get_field('start_date', $this->post_id);
		$end_date = get_field('end_date', $this->post_id);
		$start_time = get_field('start_time', $this->post_id);
		$end_time = get_field('end_time', $this->post_id);
		
		$has_multiple_dates  = get_field('has_multiple_dates', $this->post_id);
		$dates = [];
		
		$dates[0]['start'] = $start_date .' '. $start_time;
		if($end_date){
			$dates[0]['end'] = $end_date .' '. $end_time;
		}
		if($has_multiple_dates){
			$i = 1;
			if(have_rows('additional_event_dates',  $this->post_id)):
				while(have_rows('additional_event_dates',  $this->post_id)): the_row();
						$start_date = get_sub_field('start_date', $this->post_id);
						$end_date = get_sub_field('end_date', $this->post_id);
						$start_time = get_sub_field('start_time', $this->post_id);
						$end_time = get_sub_field('end_time', $this->post_id);
						
						$dates[$i]['start'] = $start_date .' '. $start_time;
							if(!empty($end_date)){
								$dates[$i]['end'] = $end_date .' '. $end_time;
							}
					$i++;
				endwhile;
			endif;
		}
		
		return $dates;
	}
	
	//display card dates
	public function display_card_dates() {
		$dates = $this->get_dates();
		$dates_formatted = [];
		foreach($dates as $d){
			foreach ($d as $key => $val){
				if($key != 'start') continue;
				$dates_formatted[] = '<time datetime="'.date('Y-m-d H:i:s', strtotime($val)).'" data-key="'.$key.'">'. date('D, M j, Y g:i A', strtotime($val)).'</time>';
			}
		}
		return implode('<br>', $dates_formatted);
	}
	
	//display single dates
	public function display_single_dates() {
		$dates = $this->get_dates();
		$dates_formatted = [];
		foreach($dates as $d){
				
			$start = date('l F j, Y', strtotime($d['start']));
			$end = (!empty($d['end'])) ? ' - '. date('l F j, Y', strtotime($d['end'])) : '';
			$dates_formatted[] = '<time datetime="'.date('Y-m-d H:i:s', strtotime($d['start'])).'">'.$start.$end.'</time>';
			
		}
		return implode(',<br>', $dates_formatted);
	}
	
	//display single address
	public function display_single_address() {
		
		$location_name = get_field('location_name', $this->post_id);
		$address = get_field('address', $this->post_id);
		$address_2 = get_field('address_2', $this->post_id);
		$city = get_field('city', $this->post_id);
		$prov = get_field('prov', $this->post_id);
		$postal_code = get_field('postal_code', $this->post_id);
		
		$address_formatted = '';
		
		if(!empty($location_name)) $address_formatted .= $location_name.'<br>';
		if(!empty($address)) $address_formatted .= $address;
		if(!empty($address_2)) $address_formatted .= ', '.$address_2;
		if(!empty($city)) $address_formatted .=  ', '.$city;
		if(!empty($prov)) $address_formatted .=  ', '.$prov;
		if(!empty($postal_code)) $address_formatted .= '<br>'.$postal_code;
		
		return $address_formatted;
	}
	
	//display single address
	public function display_single_sponsors() {
		
		$sponsors = '';
		if(have_rows('sponsors',  $this->post_id)):
			while(have_rows('sponsors',  $this->post_id)): the_row();
				$logo = get_sub_field('logo', $this->post_id);
				$name = get_sub_field('name', $this->post_id);
				$link = get_sub_field('link', $this->post_id);
				$link_open = (!empty($link)) ? '<a href="'.$link.'" title="'.$name.'" target="_blank">' : '';
				$link_close = (!empty($link)) ? '</a>' : '';
				
				$sponsors .= '<span class="sponsor">'.$link_open.wp_get_attachment_image($logo, 'medium').$link_close.'</span>';
			endwhile;
		endif;
		
		return $sponsors;
	}
	
	//display item
	public function display_item(){

		$terms = get_the_terms($this->post_id, 'cb_category'); 
		$link = get_the_permalink($this->post_id);
		$dates = $this->get_dates(); 
		?>
		<article <?php post_class('event-item grid-item card', $this->post_id);?> >
			<div class="inner">
				<div class="thumb-container">
					<a href="<?php echo $link;?>">
					<?php echo get_the_post_thumbnail($this->post_id, 'medium');?>
					</a>
				</div>
				<div class="card-content">
					<?php if($terms):?>
						<div class="post-terms">
							<?php foreach($terms as $term){
								echo '<a class="term-link" href="'.get_post_type_archive_link('event').'/?event_category='.$term->slug.'">'.$term->name.'</a>';
							}?>
						</div>
					<?php endif;?>
				
					<h4><a href="<?php echo $link;?>"><?php echo get_the_title($this->post_id);?></a></h4>
					<p><?php echo  wp_trim_words(get_the_excerpt($this->post_id), 18);?></p>
					
					<div class="dates">
						<p><?php echo $this->display_card_dates();?></p>
					</div>
					
					<div class="card-btn-container ">
						<a class="btn card-btn" href="<?php echo $link;?>"><?php echo __('Details', 'chinook_blast');?></a>
					</div>
				</div>
			</div>
		</article>
		<?php 
	}

}
