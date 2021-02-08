<?php
function wpexplorer_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'goldprice_dashboard_widget', // Widget slug.
		'Price Calculation Dashboard', // Title.
		'gold_price_dashboard_widget_function' // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'wpexplorer_add_dashboard_widgets' );

function gold_price_dashboard_widget_function() {
    $gold_price = get_option( 'gold_price_today');
    $silver_price = get_option( 'silver_price_today');
    $platinum_price = get_option( 'platinum_price_today');
	echo "<button style='float:right;' class='button-primary' onclick='call_edit_price();'>Edit</button><form method='post' onsubmit='return false;'><label>Gold Price:</label><input type='number' value='".$gold_price."' name='gold_price' class='gold_price read_price' readonly><input type='submit' name='submit_price' class='submit_price_btn button-primary' style='display:none;'></form>";
	echo "<div class='hide-loader-gold' style='display:none;'><img src='http://www.evaanta.com/wp-content/uploads/2020/10/loader.gif' width='50' height='50'></div>
	<br><button style='float:right;' class='button-primary' onclick='call_edit_price1();'>Edit</button><form method='post' onsubmit='return false;'><label>Silver Price:</label><input type='number' value='".$silver_price."' name='silver_price' class='silver_price read_price1' readonly><input type='submit' name='submit_price' class='submit_price_btn1 button-primary' style='display:none;'></form>
	<div class='hide-loader-silver' style='display:none;'><img src='http://www.evaanta.com/wp-content/uploads/2020/10/loader.gif' width='50' height='50'></div>
	<br><button style='float:right;' class='button-primary' onclick='call_edit_price2();'>Edit</button><form method='post' onsubmit='return false;'><label>Platinum Price:</label><input type='number' value='".$platinum_price."' name='platinum_price' class='platinum_price read_price2' readonly><input type='submit' name='submit_price' class='submit_price_btn2 button-primary' style='display:none;'></form>
	<div class='hide-loader-platinum' style='display:none;'><img src='http://www.evaanta.com/wp-content/uploads/2020/10/loader.gif' width='50' height='50'></div>
	
	
	<script>
	jQuery(document).on('click', '.submit_price_btn',function(){
	var gold_price = jQuery('.gold_price').val();
	jQuery('.hide-loader-gold').show();
	if(gold_price != ''){
	    jQuery.ajax({
	        type:'post',
	        url:'".admin_url('admin-ajax.php')."',
	        data:{action:'update_gold_price',gold_price:gold_price},
	        success:function(res){
	            jQuery('.hide-loader-gold').hide();
	        }
	    })
	}
	});
	jQuery(document).on('click', '.submit_price_btn1',function(){
	var silver_price = jQuery('.silver_price').val();
	jQuery('.hide-loader-silver').show();
	if(silver_price != ''){
	    jQuery.ajax({
	        type:'post',
	        url:'".admin_url('admin-ajax.php')."',
	        data:{action:'update_silver_price',silver_price:silver_price},
	        success:function(res){
	            jQuery('.hide-loader-silver').hide();
	        }
	    })
	}
	});
	jQuery(document).on('click', '.submit_price_btn2',function(){
	var platinum_price = jQuery('.platinum_price').val();
	jQuery('.hide-loader-platinum').show();
	if(platinum_price != ''){
	    jQuery.ajax({
	        type:'post',
	        url:'".admin_url('admin-ajax.php')."',
	        data:{action:'update_platinum_price',platinum_price:platinum_price},
	        success:function(res){
	            jQuery('.hide-loader-platinum').hide();
	        }
	    })
	}
	});
	function call_edit_price(){ jQuery('.read_price').removeAttr('readonly'); jQuery('.submit_price_btn').show();  }
	function call_edit_price1(){ jQuery('.read_price1').removeAttr('readonly'); jQuery('.submit_price_btn1').show();  }
	function call_edit_price2(){ jQuery('.read_price2').removeAttr('readonly'); jQuery('.submit_price_btn2').show();  }</script>";

}

add_action("wp_ajax_update_gold_price", "update_gold_price");
function update_gold_price(){
    if(!empty($_POST['gold_price'])){
	        update_option( 'gold_price_today', $_POST['gold_price'] );
	        $arg = array(
                      'post_type' => 'product',
                      'numberposts' => -1,
                      'post_status' => 'publish',
                      //'post__in'=>array('10011'),
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'product_cat',
                          'field' => 'slug', 
                          'terms' => array('gold'), /// Where term_id of Term 1 is "1".
                        )
                      )
                    );
            $gold_pro = get_posts($arg);
            
            if(!empty($gold_pro)){
                foreach($gold_pro as $single){
                    
                    $product = wc_get_product( $single->ID );
                    $carat = $product->get_attribute('pa_carat');
                    
                    
                    if(!empty($carat)){
                        //$variations = $product->get_available_variations();
                        $variations = $product->get_children();
                         $gram_size = get_field('size',$single->ID);
                         //$other_price = get_field('price',$single->ID);
                         $making_price = get_post_meta($single->ID,"price_making_price", true);
                         $des_price = get_post_meta($single->ID,"price_design_price", true);
                        
                        if(!empty($variations)){
                            foreach($variations as $s_var){
                                if(get_post_type($s_var)=='product_variation'):
                                $carat_val = '';
                                $product_variation = wc_get_product( $s_var ); 
                                $cart_value_of_db = $product_variation->get_attribute( 'carat' ); 
                                if(!empty($cart_value_of_db)):
                                    $carat_val = $cart_value_of_db; //$s_var['attributes']['attribute_pa_carat'];
                                    $get_carat = floatval($carat_val/24);
                                    
                                    $gram_val = !empty($gram_size['gram']) ? $gram_size['gram'] : 1;
                                    $gold_raw_val = $_POST['gold_price']*$get_carat;
                                    
                                    $with_gram_val = $gold_raw_val*$gram_val;
                                    
                                    $mk_price = !empty($making_price) ? $making_price : 1;
                                    $design_price = !empty($des_price) ? $des_price : 0;
                                    $add_mk_price = $mk_price * $gram_val;
                                    $add_design_price = $add_mk_price + $design_price;
                                    
                                    $gold_last_val = $with_gram_val + $add_design_price;
                                    //echo $gold_last_val; die;
                                    update_post_meta($s_var, '_price', $gold_last_val);
                                    update_post_meta($s_var, '_regular_price', $gold_last_val);
                                    update_post_meta($s_var, '_sale_price', '');
                                    
                                    wc_delete_product_transients( $s_var['variation_id'] );
                                endif;
                        
                                endif;
                            }
                            wc_delete_product_transients( $single->ID );
                        }
                    }
                    
                }
            }
	 }
    die;
}