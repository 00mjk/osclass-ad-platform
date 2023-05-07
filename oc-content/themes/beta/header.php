<?php osc_goto_first_locale(); ?>

<header>
  <div class="inside">
    <div class="left">
      <div class="logo">
        <a href="<?php echo osc_base_url(); ?>"><?php echo logo_header(); ?></a>
      </div>
    </div>

    <div class="right isDesktop isTablet">



      <a class="publish btn" href="<?php echo osc_item_post_url(); ?>">
        <span><?php _e('Post an ad', 'beta'); ?></span>
      </a>

      <div class="header-user">
        <?php if(osc_is_web_user_logged_in()) { ?>
          <a class="logout" href="<?php echo osc_user_logout_url(); ?>"><?php _e('Log out', 'beta'); ?></a>

          <a class="profile is-logged" href="<?php echo osc_user_dashboard_url(); ?>">
            <span><?php _e('My account', 'beta'); ?></span>
          </a>

          <span class="username is-logged"><?php _e('Hi', 'beta'); ?> <?php echo osc_logged_user_name(); ?>!</span>


        <?php } else { ?>
          <a class="profile not-logged" href="<?php echo osc_register_account_url(); ?>"><?php _e('Register', 'beta'); ?></a>
          <a class="profile not-logged" href="<?php echo osc_user_login_url(); ?>"><?php _e('Log in', 'beta'); ?></a>
          <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact us', 'beta'); ?></a>

        <?php } ?>

      </div>

      <?php if(function_exists('blg_home_link')) { ?>
        <a href="<?php echo blg_home_link(); ?>"><?php _e('Blog', 'beta'); ?></a>
      <?php } ?>

      <?php if(function_exists('bpr_companies_url')) { ?>
        <a href="<?php echo bpr_companies_url(); ?>"><?php _e('Companies', 'beta'); ?></a>
      <?php } ?>

      <?php if(function_exists('frm_home')) { ?>
        <a href="<?php echo frm_home(); ?>"><?php _e('Forums', 'beta'); ?></a>
      <?php } ?>

      <?php if(function_exists('im_messages') && osc_is_web_user_logged_in()) { ?>
        <a href="<?php echo osc_route_url('im-threads'); ?>"><?php _e('Messages', 'beta'); ?></a>
      <?php } ?>


      <!-- PLUGINS TO HEADER -->
      <div class="plugins">
        <?php osc_run_hook('header_links'); ?>
      </div>

    </div>   

    <div class="mobile-block isMobile">
      <a href="#" id="m-options" class="mobile-menu" data-menu-id="#menu-options">
        <div class="inr">
          <span class="ln ln1"></span>
          <span class="ln ln2"></span>
          <span class="ln ln3"></span>
        </div>
      </a>

      <a href="#" id="m-search" class="mobile-menu" data-menu-id="#menu-search">
        <div class="inr">
          <span class="ln ln1"></span>
          <span class="ln ln3"></span>
          <span class="rd"></span>
          <span class="cd"></span>
        </div>
      </a>
    </div>
  </div>
</header>

<div class="header-search-mobile" id="menu-search" style="display:none;">
  <form action="<?php echo osc_base_url(true); ?>" method="get" class="nocsrf" >
    <input type="hidden" name="page" value="search" />

    <input type="text" name="sPattern" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" placeholder="<?php echo osc_esc_html(__('What are you looking for?', 'beta')); ?>" autocomplete="off" />
    <button type="submit" class="mbBg"><?php _e('Search', 'beta'); ?></button>
  </form>
</div>

<?php 
  $loc = (osc_get_osclass_location() == '' ? 'home' : osc_get_osclass_location());
  $sec = (osc_get_osclass_section() == '' ? 'default' : osc_get_osclass_section());
?>

<section class="content loc-<?php echo $loc; ?> sec-<?php echo $sec; ?>">

<?php
  if(osc_is_home_page()) { 
    osc_current_web_theme_path('inc.search.php'); 
    osc_current_web_theme_path('inc.category.php');
  }
?>



<div class="flash-box">
  <div class="flash-wrap">
    <?php osc_show_flash_message(); ?>
  </div>
</div>


<?php
  osc_show_widgets('header');
  $breadcrumb = osc_breadcrumb('/', false);
  $breadcrumb = str_replace('<span itemprop="title">' . osc_page_title() . '</span>', '<span itemprop="title">' . __('Home', 'beta') . '</span>', $breadcrumb);
?>

<?php if($breadcrumb != '') { ?>
  <div id="bread">
    <?php echo $breadcrumb; ?>
  </div>
<?php } ?>