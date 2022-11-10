<?php
		// Preloader switch data.
if ( class_exists( 'Redux' ) ) {
		global $profund_opt;
	 
		$profund_opt['action_button'] = [];

		if( $profund_opt['is_menu_btn'] == true and !empty($profund_opt['menu_btn_label']) and !empty($profund_opt['menu_btn_url']) ){        
				$profund_opt['action_button']['button'] = '<a class="action-button mouse-dir" href="'.esc_url($profund_opt['menu_btn_url']).'" >'.wp_kses_post($profund_opt['menu_btn_label']).'<span class="dir-part" ></span></a>';
		}

		if( class_exists( 'WooCommerce' ) and $profund_opt['is_mini_cart'] == true ){        
				$profund_opt['action_button']['cart'] = profund_custom_mini_cart();
		}

		if( $profund_opt['is_search'] == true ){        
				$profund_opt['action_button']['search'] = '<a class="icon-button search-button" data-toggle="collapse" href="#menu-search-form" ><i class="flaticon-magnifying-glass"></i></a>';
		}

}else{
		$profund_opt = array();
		$profund_opt['action_button'] = array();
		$profund_opt['is_navbar_sticky'] = 
		$profund_opt['is_search'] = 
		$profund_opt['is_top_bar'] = false;
		$profund_opt['top_bar_mail_text'] =
		$profund_opt['top_bar_phone_text'] = '';
		$profund_opt['nav_layout'] = 'boxed';
}

switch ($profund_opt['nav_layout']) {
		case 'boxed':
				$nav_layout = 'container';
				break;
		case 'wide':
				$nav_layout = 'container custom_container';
				break;
		case 'full_width':
				$nav_layout = 'container-fluid';
				break;
}

if($profund_opt['is_top_bar'] == true ):
?>
<div class="tap-bar-area">
		<div class="<?php echo esc_attr($nav_layout); ?>">
				<div class="flex-item">
						<div class="top-bar">
								<?php echo do_shortcode( '[mfa_top_bar_lang /]' ); ?>
								<style>
									.flex-item .top-bar {
										display: flex;
										flex-wrap: wrap;
										justify-content: flex-start;
										//max-width: calc(100vw - 505px);
										max-height: 50px;
									}
									@media (max-width: 767px) {
										.flex-item .top-bar {
											width: 100%;
											max-height: 100px;
										}
										.tap-bar-area .social-menu {
											display: none;
										}
									}
									.flex-item .top-bar .menu {
										display: flex;
										justify-content: flex-end;
										align-items: center;
										padding: 0 0 0 0;
										margin: 0 0 0 10px;
										list-style: none;
										z-index: 100;
									}
									@media (max-width: 767px) {
										.flex-item .top-bar .menu {
											justify-content: center;
											//width: 100%;
											//max-width: 100%;
											//height: 50px;
											//margin: 10px auto 10px auto;
										}
									}
									.flex-item .top-bar .menu li {
										padding: 0 0 0 0;
										margin: 0 10px 0 0;
										line-height: 12px;
									}
									.flex-item .top-bar .menu a {
										color: #393939;
										font-size: 12px;
										line-height: 12px;
										-webkit-transition: color 1000ms linear;
										-ms-transition: color 1000ms linear;
										transition: color 1000ms linear;
										font-family: Gotham Pro,"Gotham A","Gotham B",Gotham,Helvetica,"Helvetica Neue",Arial,sans-serif;
										letter-spacing: 0px !important;
									}
									@media (max-width: 767px) {
										.flex-item .top-bar .menu a {
											font-size: 10px;
											line-height: 10px;
										}
									}
									.flex-item .top-bar .menu a:hover {
										color: #393939;
									}
									.flex-item .top-bar .menu .menu-item-has-children {
										position: relative;
									}
									.flex-item .top-bar .menu .sub-menu {
										display: none;
										position: absolute;
										top: 12px;
										left: -2px;
										padding: 2px;
										text-align: right;
										background-color: #ffffff;
										z-index: 112;
										list-style: none;
									}
									.flex-item .top-bar .menu .sub-menu li {
										margin: 0 0 0 0;
										font-size: 12px;
										line-height: 12px;
									}
									.flex-item .top-bar .menu .sub-menu a {
										padding: 5px 0 0 0;
										margin: 10px 0 0 0;
										color: #282728;
										-webkit-transition: color 1000ms linear;
										-ms-transition: color 1000ms linear;
										transition: color 1000ms linear;
										font-family: Gotham Pro,"Gotham A","Gotham B",Gotham,Helvetica,"Helvetica Neue",Arial,sans-serif;
										font-size: 12px;
										line-height: 16px;
										cursor: pointer;
									}
									@media (max-width: 767px) {
										.flex-item .top-bar .menu .sub-menu a {
											font-size: 10px;
											line-height: 10px;
										}
									}
									.flex-item .top-bar .menu .sub-menu a:hover {
										color: #393939;
									}
									.flex-item .top-bar .menu .menu-item-has-children:hover .sub-menu {
										display: block;
									}
									.flex-item .top-bar .menu .no-link {
										pointer-events: none;
										cursor: default;
									}
									.flex-item .top-bar .menu .no-link:hover {
										color: #282728;
									}
									/* overwrite weird styles */
									.flex-item .top-bar .menu a:first-of-type {
										margin-left: 0;
									}
									.flex-item .top-bar .menu a {
										margin-right: 0;
									}
								</style>
								<?php wp_nav_menu( array('theme_location' => 'top_nav', 'container' => 'top-nav') ); ?>
								<?php if(!empty($profund_opt['top_bar_mail_text'])): ?>
										<a href="mailto:<?php echo esc_attr(sanitize_email($profund_opt['top_bar_mail_text'])); ?>"><i class="flaticon-email"></i><?php echo esc_html($profund_opt['top_bar_mail_text']); ?></a>
								<?php endif; ?>
								<?php if(!empty($profund_opt['top_bar_phone_text'])): ?>
								<a href="callto:<?php echo esc_attr($profund_opt['top_bar_phone_text']); ?>"><i class="flaticon-call"></i><?php echo esc_html($profund_opt['top_bar_phone_text']); ?></a>
								<?php endif; ?>
						</div><!-- .top-bar -->
						<?php
							function_exists( 'mfa_profund_topbar_searchbox' ) && mfa_profund_topbar_searchbox();
						?>
						<?php 
								if( function_exists('profund_social_menu') ){
										echo profund_social_menu();
								}
						?>
				</div><!-- .flex-item -->
		</div>
</div>
<?php endif; ?>
<nav class="navbar mainmenu-area" <?php echo ( ( $profund_opt['is_navbar_sticky'] == 1 ) ? 'data-spy="affix" data-offset-top="100"' : '' ); ?> >
		<div class="<?php echo esc_attr($nav_layout); ?>">
			 <div class="row">
						<div class="col-xs-12 nav-alignmenu">
								<div class="site-branding">
										<?php
												if( !empty($profund_opt['main_logo']['url']) and !empty($profund_opt['sticky_logo']['url']) ){
														echo '<a href="'.esc_url(home_url('/')).'" class="mn-logo" ><img src="'.esc_url($profund_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
														echo '<a href="'.esc_url(home_url('/')).'" class="st-logo" aria-hidden="true" ><img src="'.esc_url($profund_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'"  ></a>';
												}elseif( !empty($profund_opt['main_logo']['url']) ){
														echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($profund_opt['main_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
												}elseif( !empty($profund_opt['sticky_logo']['url']) ){
														echo '<a href="'.esc_url(home_url('/')).'" ><img src="'.esc_url($profund_opt['sticky_logo']['url']).'" alt="'.get_bloginfo('name').'" ></a>';
												}elseif(has_custom_logo()){
														the_custom_logo();
												}else{
														echo '<a href="'.esc_url(home_url('/')).'" >'.get_bloginfo('title').'</a>';
												}
										 ?>
								</div>
								<div class="navbar-right">
								<div class="primary-menu" id="mainmenu" >               
										<?php
												if(has_nav_menu('primary_menu')){   
														wp_nav_menu(array(
																'theme_location' => 'primary_menu',
																'menu_class'     => 'nav',
																'container'      => ' ',
																'walker'         =>  new profund_Nav_Menu_Walker
														));
												}
										?>
								</div>
								<?php 
								if( !empty($profund_opt['action_button']) and count($profund_opt['action_button']) > 0 ): ?>
								<div class="menu-button-area">
										<?php
												echo '<div class="menu-buttons">';
												foreach( $profund_opt['action_button'] as $buttons ){
														if( !empty($buttons) ){
																echo wp_kses_post($buttons);
														}
												}/*
												if ( shortcode_exists( 'gtranslate' ) ) {
														echo '<div class="langu">';
														echo do_shortcode('[gtranslate]');
														echo '</div>';
												}*/
												echo '</div>';
										?>
								</div>
								<?php endif; ?>
								<!-- Mobile-Menu-Button -->
								<button id="mobile-toggle" role="button" aria-label="Main menu button" title="Main menu button">
										<span></span>
										<span></span>
										<span></span>
								</button>
								<!-- Mobile-Menu-Button -->
								</div>
						</div>
			 </div>
				<!-- Menu-Search-Form -->   
				<?php if( $profund_opt['is_search'] == 1 ): ?>
				<div class="row collapse fade" id="menu-search-form">
						<div class="col-xs-12">
											 <form action="<?php echo esc_url(home_url("/")); ?>" role="search" method="get" class="menu-search-form" >
										<input type="text" class="search-input" name="s" placeholder="<?php esc_attr_e("Search Here...","profund"); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
										<button class="search-button" type="submit" ><i class="flaticon-magnifying-glass"></i></button>
								</form>
						</div>
				</div>
				<?php endif; ?>
				 <!-- Menu-Search-Form / --> 
		</div>
</nav>