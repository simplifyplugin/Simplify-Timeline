<?php
/*
	Plugin Name: Simplify Timeline
	Version: 1.0.0.0
	Author: Tristonsoft
	Description: Simplify Timeline is WordPress plugin that provides a timeline.When user have history data then have to display data and date for that particular time.Its easy to use and configure.
	License: GPLv2 or later
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if(!class_exists('SM_Timeline')){
	class SM_Timeline{

			public function __construct()
			{
					add_action( 'init', array( $this, 'zpt_init' ) );
					
					
			}
			public function zpt_init(){
						
					$args=array(
						'public'=>true,
						'label'=>'SM Timeline',
						'supports'=>array('title','page-attributes','editor','custom-fields'),			
						'rewrite'=>array('slug'=>'zeb_timeline'),
						'menu_icon' => 'dashicons-calendar'
						
						
					);
					register_post_type('SM_Timeline',$args);
			}
		
		}
}
if(is_admin()){
	$tsa=new SM_Timeline();
}

function zpt_load_script()
{
	$styleurl=plugins_url( 'css/style.css', __FILE__ );
	wp_enqueue_style('zpt_style',$styleurl);
}
add_action('wp_enqueue_scripts','zpt_load_script');				

function sbt_loop_shortcode( $atts ) {
			    
			    $args = array(
			        'post_type' => 'SM_Timeline',			        
			        'sort_column'   => 'menu_order',
					'orderby' => 'menu_order',
			    );
			    $sbt_query = new  WP_Query( $args );
				$output = '<div class="align"><div id="btc-timeline">';
			    while ( $sbt_query->have_posts() ) : $sbt_query->the_post();
				$time_field=get_post_custom_values('zpdate', $sbt_query->ID);
				$output .= '<div class="entry">';
				$output .= '<div class="entry-date">'.$time_field[0].'</div>';
				$output .= '<div class="entry-info">';
				$output .= '<div class="circle"></div>';
				$output .= '<h4>'.get_the_title().'</h4>';
				$output .= '<p>'.get_the_excerpt().'</p> </div> </div>';
			    endwhile;
			    wp_reset_query();
			    $output .= '</div></div>';
			    return $output;
			}
add_shortcode('sp_timeline','sbt_loop_shortcode');
