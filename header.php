<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package dschool
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
<link rel="stylesheet" href="http://f.fontdeck.com/s/css/AWO2Ouor1Nflm48ej7gs0EL1BPU/dschool.stanford.edu/5774.css" type="text/css" />
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); // wp_head ?>

</head>

<body class="<?php hybrid_body_class(); ?><?php if (detect_mobile()) {echo " mobile";} ?>">

	<?php do_atomic( 'open_body' ); // dschool_open_body ?>

	<div id="container">

		<?php 
		if (!is_front_page()) {
		get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. 
		}
		?>

		<?php do_atomic( 'before_header' ); // dschool_before_header ?>

		<div id="header">

			<?php do_atomic( 'open_header' ); // dschool_open_header ?>

			<div class="wrap">

				<div id="branding">
					<?php dschool_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

				<?php do_atomic( 'header' ); // dschool_header ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); // dschool_close_header ?>

		</div><!-- #header -->

		<?php do_atomic( 'after_header' ); // dschool_after_header ?>

		<?php if (is_front_page()) { ?>
		
		<div id="banner">

			<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

			<div id="banner-feature">
					<?php 
					//Get First 2 Images for the banner then load the remaining in a JS array
					global $post, $wpdb; ?>
					<?php $img_id = $wpdb->get_results("SELECT ID, menu_order FROM $wpdb->posts where post_parent = " . $post->ID . " and (post_mime_type = 'image/jpeg' OR post_mime_type = 'image/gif' OR post_mime_type = 'image/png') and post_type = 'attachment' ORDER BY menu_order ASC");?>
					<?php  
					foreach ($img_id as $img_temp) {
						$img_array_temp = wp_get_attachment_image_src($img_temp->ID,'full',false);
						$img_array[] = $img_array_temp[0];
						$img_desc_temp = get_post($img_temp->ID);
						$img_desc[] =  $img_desc_temp->post_content;
					}
					$i = 0;
					while ($i <= 1) { 
						if (!empty($img_array[$i])) {
					?>		
			 		<div class="slide" style="background: url(<?php echo $img_array[$i]; ?>) no-repeat scroll top left;"><!-- <span><?php echo $img_desc[$i]; ?></span> --></div>
			 		<?php }
			 			$i++;	
					}		
					?>
					
					<script type="text/javascript">
					<?php
					$limit = isset( $img_array ) ? count($img_array) - 1 : 0;
					$i = 0;
					$display = '';
					$display2 = '';
					while ($i <= $limit) { 
						if ($i > 1) {
							$display .= "'" . $img_array[$i] . "'";
							$display2 .= "'" . $img_desc[$i] . "'";
							if ($i != $limit ) {
								$display .= ',';
								$display2 .= ',';
							}
						}
					$i++;	
					} ?>
					var winSlides = [<?php echo $display; ?>];
					var winSlideDesc = [<?php echo $display2; ?>];
					</script>
			 		
			</div><!-- #banner-feature -->
			
			<div id="banner-side">

			<?php foreach( array( 'top', 'bottom' ) as $position ) : ?>

				<div id="banner-side-<?php echo $position; ?>">
					<a href="<?php echo hybrid_get_setting( 'banner_side_'.$position.'_link' ); ?>" <?php echo ( 'on' == hybrid_get_setting( 'banner_side_'.$position.'_link_is_video' ) ) ? 'class="feature-vid"' : 'class="manifesto" rel="lightbox"'; ?>>
						<span class="title"><?php echo hybrid_get_setting( 'banner_side_'.$position.'_title' ); ?></span>
						<span><?php echo hybrid_get_setting( 'banner_side_'.$position.'_copy' ); ?></span>
					</a>
				</div><!-- #banner-side-<?php echo $position; ?> -->

			<?php endforeach; ?>
			
			<script>
			jQuery(document).ready(function(){jQuery(".feature-vid").colorbox({iframe:true, innerWidth:640, innerHeight:360});});
			</script>	

			</div><!-- #banner-sider -->
			
		</div><!-- #banner -->
		<div id="scroller-anchor"></div>
		<?php 
		get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. 
		
		} 
		?>

		<?php do_atomic( 'before_main' ); // dschool_before_main ?>

		<div id="main">

			<div class="wrap">

			<?php do_atomic( 'open_main' ); // dschool_open_main ?>