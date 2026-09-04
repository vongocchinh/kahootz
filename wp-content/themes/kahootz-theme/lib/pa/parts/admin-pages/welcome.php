<?php
/*
Page: pa
*/
?>

<div class="wrap about-wrap">

<h1><?php echo __('Welcome to Pa','pa') . '&nbsp;'  . pa::$version; ?></h1>

<div class="about-text"><?php _e('The most powerful framework available for WordPress.','pa'); ?></div>

<div class="pa-badge">
  <?php printf(__('%sP%sIKLIST%s','pa'),'<span>','</span>','<br>');?>
  <?php printf(__('Version %s', 'pa'), pa::$version); ?>
</div>

<?php if (!empty(pa_admin::$pa_dependent)): ?>

    <div class="dependent-on-pa">

        <h3><?php _e('Currently Powered by Pa on', 'pa'); ?> <?php echo get_bloginfo('name');?></h2>

            <?php $dependencies = pa_admin::$pa_dependent; ?>

            <?php foreach ($dependencies as $type => $item): ?>

                <?php if($type == 'theme') : ?>

                    <p>

                        <strong><?php _e('Active Theme', 'pa');?></strong>: <?php echo ($item[0]);?>

                    </p>

                <?php endif;?>

                <?php if($type == 'plugins') : ?>

                    <p>

                        <?php foreach ($item as $key => $value) : ?>

                            <?php $plugin_list[] = $value['name']; ?>

                        <?php endforeach;?>

                        <strong><?php _e('Active Plugins', 'pa');?></strong> : <?php echo implode(', ', $plugin_list); ?>

                    </p>

                <?php endif; ?>

            <?php endforeach; ?>

    </div>

<?php endif; ?>



<div class="pa-social-links">
  <a class="facebook_link" href="http://facebook.com/pa">
    <span class="dashicons dashicons-facebook-alt"></span>
  </a>
  <a class="twitter_link" href="http://twitter.com/pa">
    <span class="dashicons dashicons-twitter"></span>
  </a>
  <a class="google_plus_link" href="https://plus.google.com/u/0/b/108403125978548990804/108403125978548990804/posts">
    <span class="dashicons dashicons-googleplus"></span>
  </a>
</div><!-- .pa-social-links -->

<div class="section">
  <h2 class="about-headline-callout"><?php _e('Now even more powerful than before.','pa'); ?></h2>
</div>

<div class="section">
  <div class="feature-section col two-col">
    <div>
      <h3><?php _e('Post relationships', 'pa');?></h3>
      <h4><?php _e('You\'ll wish all relationships were this easy.','pa');?></h4>
      <p><?php printf(__('Post relationships are standard with Pa and easy to setup. Displaying them in your theme is even easier, since you can use the standard WordPress %sget_posts%s function.','pa'),'<code>','</code>');?></p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('pa/parts/img/post-relationships@2x.jpg');?>">
    </div>
  </div>
</div>



<div class="section">
  <div class="feature-section col two-col">
    <div class="alt-feature">
      <h3><?php _e('Add mores');?></h3>
      <h4><?php _e('The infinite repeater field.','pa');?></h4>
      <p><?php _e('Pa AddMore fields are the repeater field you always dreamed of. Group together as many fields as you want and make them repeat indefinitely. Or place an Add more within an Add more within an Add more...','pa');?></p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('pa/parts/img/add-mores@2x.jpg');?>">
    </div>
  </div>
</div>



<div class="section">
  <div class="feature-section col two-col">
    <div>
      <h3><?php _e('WorkFlows','pa');?></h3>
      <h4><?php _e('The tab system you never knew was possible.','pa');?></h4>
      <p><?php printf(__('Pa WorkFlows allows you to place tabs anywhere... and with %sanything%s. Tabs can include content from any page or even custom views you create.','pa'),'<strong>','</strong>');?></p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('pa/parts/img/workflow-user@2x.jpg');?>">
    </div>
  </div>
</div>



<div class="section">
  <div class="feature-section col two-col">
    <div class="alt-feature">
      <h3><?php _e('Multiple user roles','pa');?></h3>
      <h4><?php _e('Better security, more flexibility.','pa');?></h4>
      <p><?php _e('Powerful web sites and applications require multiple user roles and Pa supports this out of the box. Standard WordPress functions can be used to validate a user\'s permissions and provide appropriate access to data.','pa');?></p>
    </div>
    <div class="last-feature about-colors-img">
      <img class="screenshot" src="<?php echo plugins_url('pa/parts/img/user-roles@2x.jpg');?>">
    </div>
  </div>
</div>



<div class="section">
  <h2 class="about-headline-callout"><?php _e('Intelligent field system','pa');?></h2>
  <p class="about-description"><?php _e('Easily create powerful fields just the way you want... and place them wherever you want.','pa');?></p>

  <div class="feature-section col three-col">

    <div class="col-1">
      <h3><?php _e('Conditional Logic','pa');?></h3>
        <ul>
          <li><?php _e('Hide/show fields based on another fields value.','pa');?></li>
          <li><?php _e('Auto-update another field.','pa');?></li>
        </ul>
    </div>

    <div class="col-2">
      <h3><?php _e('Validate data','pa');?></h3>
        <ul>
          <li><?php _e('Built in validation rules.','pa');?></li>
          <li><?php _e('Easily add your own.','pa');?></li>
          <li><?php _e('Apply multiple rules.','pa');?></li>
        </ul>
    </div>

    <div class="col-3 last-feature">
      <h3><?php _e('Sanitize before saving','pa');?></h3>
        <ul>
          <li><?php _e('Use WordPress sanitization functions.','pa');?></li>
          <li><?php _e('Create your own.','pa');?></li>
        </ul>
    </div>

  </div>

</div>





<div class="section">
  <h2 class="about-headline-callout"><?php _e('Customize everything in WordPress.','pa');?></h2>
  <p class="about-description"><?php _e('Post Types, Taxonomies, User Profiles, Settings, Admin Pages, Widgets, Dashboard, Contextual Help, and more...','pa');?></p>

  <div class="feature-section col three-col">

    <div class="col-1">
      <h3><?php _e('Fields','pa');?></h3>
        <ul>
          <li><?php _e('Lock field values.','pa');?></li>
          <li><?php _e('Define field scopes.','pa');?></li>
          <li><?php _e('Add Tooltip Help.','pa');?></li>
          <li><?php _e('Customize field templates.','pa');?></li>
        </ul>
    </div>

    <div class="col-2">
      <h3><?php _e('Meta Boxes','pa');?></h3>
        <ul>
          <li><?php _e('Lock meta boxes','pa');?></li>
          <li><?php _e('Show/hide by user capability or role','pa');?></li>
          <li><?php _e('Set the order of meta boxes','pa');?></li>
          <li><?php _e('Hide meta box when creating a new post/term','pa');?></li>
        </ul>
    </div>

    <div class="col-3 last-feature">
      <h3><?php _e('Post Types','pa');?></h3>
        <ul>
          <li><?php _e('Create custom post statuses','pa');?></li>
          <li><?php _e('Change the "Enter title here" text','pa');?></li>
          <li><?php _e('Custom admin body classes','pa');?></li>
          <li><?php _e('Hide meta boxes','pa');?></li>
        </ul>
    </div>

  </div>

  <div class="feature-section col three-col">

    <div class="col-1">
      <h3><?php _e('List Tables','pa');?></h3>
        <ul>
          <li><?php _e('Change column headings','pa');?></li>
          <li><?php _e('Show post states','pa');?></li>
          <li><?php _e('Hide the post row actions','pa');?></li>
        </ul>
    </div>

    <div class="col-2">
      <h3><?php _e('User Profiles','pa');?></h3>
        <ul>
          <li><?php _e('Profiles can taken advantage of any Pa field','pa');?></li>
          <li><?php _e('Show/hide fields by user capability or role','pa');?></li>
          <li><?php _e('Easily add User Taxonomies','pa');?></li>
        </ul>
    </div>

    <div class="col-3 last-feature">
      <h3><?php _e('Widgets, Dashboard & Help','pa');?></h3>
        <ul>
          <li><?php _e('Simply create complex widgets','pa');?></li>
          <li><?php _e('No object oriented programming required','pa');?></li>
          <li><?php _e('No help needed to create contextual help','pa');?></li>
        </ul>
    </div>

  </div>

</div>



<div class="section">
  <div class="feature-section col three-col">
    <div class="col-1">
      <h2 class="about-headline-callout"><?php _e('Get Started','pa');?></h2>
      <p class="about-description"><?php _e('The built in demos are a great way to see what Pa can do, and comes with tons of sample code.','pa');?></p>
      <a href="<?php echo admin_url('admin.php?page=pa-core-addons');?>"><?php printf(__('Activate Demos %s','pa'),'&#8594;');?></a>
    </div>
    <div class="col-2">
      <h2 class="about-headline-callout"><?php _e('Get Help','pa');?></h2>
      <p class="about-description"><?php _e('Visit the Pa community forums to get answers to your questions, and suggest new features.','pa');?></p>
      <a href="https://pa.com/support/"><?php printf(__('Visit Forums %s','pa'),'&#8594;');?></a>
    </div>
    <div class="col-3 last-feature">
      <h2 class="about-headline-callout"><?php _e('Get News','pa');?></h2>
      <p class="about-description"><?php _e('Pa updates in your inbox.','pa');?></p>
        <form action="http://pa.us5.list-manage.com/subscribe/post?u=48135d6d0775070599e9ddaee&amp;id=19ac927f9d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <label for="mce-EMAIL">
          <?php _e('Send to:', 'pa');?>
        </label>
        <input type="email" value="<?php echo $current_user->user_email; ?>" name="EMAIL" class="regular-text email" id="mce-EMAIL" placeholder="Enter email address" required>
        <input type="hidden" name="SIGNUP" id="SIGNUP" value="plugin-pa" />
        <div class="clear">
        <input type="submit" value="<?php _e('Subscribe','pa');?>" name="subscribe" id="mc-embedded-subscribe" class="button">
        </div><!-- .clear -->
        </form>
    </div>
  </div>
</div>




<p class="about-description">
  <?php _e('Pa is created by a team of passionate individuals.','pa');?>
</p>

<h4 class="wp-people-group"><?php _e('Project Leaders','pa');?></h4>

<ul class="wp-people-group " id="wp-people-group-project-leaders">

<li class="wp-person" id="wp-person-miller">
  <a href="http://profiles.wordpress.org/p51labs/">
    <img src="http://0.gravatar.com/avatar/ed33891ef54d14d71cee542af5c64aa3?s=60" style="padding:0 5px 5px 0;" class="gravatar" alt="Kevin Miller" />
  </a>
  <a class="web" href="http://profiles.wordpress.org/p51labs/">Kevin Miller</a>
  <span class="title"><?php _e('Lead Developer','pa');?></span>
</li>

<li class="wp-person" id="wp-person-bruner">
  <a href="http://profiles.wordpress.org/sbruner">
    <img src="http://www.gravatar.com/avatar/909371185bf3c3cd783b9580f394bd7f?s=60" class="gravatar" alt="Steve Bruner" />
    </a>
  <a class="web" href="http://profiles.wordpress.org/sbruner">Steve Bruner</a>
  <span class="title"><?php _e('Lead Developer','pa');?></span>
</li>

</ul>

<h4 class="wp-people-group"><?php _e('Contributing Developers','pa');?></h4>

<ul class="wp-people-group " id="wp-people-group-project-leaders">

  <li class="wp-person" id="wp-person-menard">
    <img src="https://s.gravatar.com/avatar/81f9841b95f38689faf73f1db763e754?s=60" class="gravatar" alt="Jason Adams" />
    <span>Jason Adams</span>
  </li>


  <li class="wp-person" id="wp-person-menard">
    <img src="http://1.gravatar.com/avatar/7b199884c1b4530d05aca31db88b19f6?s=60" class="gravatar" alt="Marcus Eby" />
    <span>Marcus Eby</span>
  </li>

  <li class="wp-person" id="wp-person-menard">
    <img src="http://1.gravatar.com/avatar/fa3dfd09d81f6c8b3494c2f75ef4139d?s=60" class="gravatar" alt="Daniel Ménard" />
    <span>Daniel Ménard</span>
  </li>

  <li class="wp-person" id="wp-person-menard">
    <img src="https://s.gravatar.com/avatar/02120fb28fa6ff0222f939e840e3c970?s=60" class="gravatar" alt="Daniel Rampanelli" />
    <span>Daniel Rampanelli</span>
  </li>

</ul>





<p class="about-description">
  <?php _e('Follow Pa','pa');?>
</p>


<div class="pa-social-links">
  <a class="facebook_link" href="http://facebook.com/pa">
    <span class="dashicons dashicons-facebook-alt"></span>
  </a>
  <a class="twitter_link" href="http://twitter.com/pa">
    <span class="dashicons dashicons-twitter"></span>
  </a>
  <a class="google_plus_link" href="https://plus.google.com/u/0/b/108403125978548990804/108403125978548990804/posts">
    <span class="dashicons dashicons-googleplus"></span>
  </a>
</div><!-- .pa-social-links -->

</div>

<script type="text/javascript">
var addthis_share = {
    url_transforms : {
        shorten: {
             twitter: 'bitly'
        }
    },
    shorteners : {
        bitly : {}
    }
}
var addthis_config = {"data_track_addressbar":false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fc6697407a3afe4"></script>
<!-- AddThis Button END -->

<style type="text/css">

  html,
  #wpcontent {
    background-color: #fff;
  }

  ul#adminmenu a.wp-has-current-submenu:after,
  ul#adminmenu > li.current > a.current:after {
    border-right-color: #fff;
  }

  .about-wrap .feature-section {
    padding-bottom: 0;
  }

  .about-wrap .feature-section.two-col > div.alt-feature {
    float: right;
  }

  .wrap > h2 {
    display: none;
  }

  img.screenshot {
    width: 75%;
  }

  .section {
      padding: 10px 0;
  }


  .icon16.icon-comments:before {
    font-size: 40px;
    padding: 0;
  }

  .pa-badge {
    color: #DD3726;
    background: url('<?php echo pa::$add_ons['pa']['url']; ?>/parts/img/pa-logo.png') no-repeat center 0px transparent !important;
    margin-top: 0;
    padding-top: 85px;
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    height: 40px;
    text-align: center;
    text-rendering: optimizelegibility;
    width: 150px;
    position: absolute;
    right: 0;
    top: 0;
  }

    .pa-badge span {
      font-size: 16px;
    }

  #mce-EMAIL {
    font-family: monospace;
    font-size: 14px;
    padding: 5px 2px;
    margin: 5px 0;
    width: 100%;
  }

  .pa-social-links a {
    padding: 5px;
    color: #fff;
    text-decoration: none;
  }

  .pa-social-links a:hover {
    text-decoration: none;
    color: #F0F0F0;
  }

  .pa-social-links a.facebook_link {
    background: #3460A1;
  }

  .pa-social-links a.twitter_link {
    background: #29AAE3;
  }

  .pa-social-links a.google_plus_link {
    background: #3460A1;
  }

  .pa-social-links a span.dashicons {
    display: inline-block;
    -webkit-font-smoothing: antialiased;
    line-height: 1;
    font-family: 'Dashicons';
    text-decoration: none;
    font-weight: normal;
    font-style: normal;
    vertical-align: middle;
  }

  /* 3.7 style helpers */
  body.branch-3-7 .about-wrap .feature-section.col {
    margin-bottom: 0;
  }

  body.branch-3-7 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-7 img.screenshot {
    vertical-align: bottom;
  }

  body.branch-3-7 .wrap h2 {
    text-align: center;
  }

  body.branch-3-7 .about-wrap .feature-section.two-col {
    padding-bottom: 0;
  }

  /* 3.6 style helpers */
  body.branch-3-6 .about-wrap .feature-section img {
    border: none;
    box-shadow: none;
    margin: 0;
    vertical-align: bottom;
  }

  body.branch-3-6 .about-wrap .feature-section.two-col {
    padding-bottom: 0px;
  }

  body.branch-3-6 .about-wrap hr {
    border: 0;
    height: 0;
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
  }

  body.branch-3-6 .about-wrap h3 {
    font-size: 22px;
  }

  .about-wrap .feature-section.col .last-feature {
      margin-bottom: 0px;
  }

  .dependent-on-pa {
      text-align: center;
      border-top: 1px solid #000;
      border-bottom: 1px solid #000;
      padding: 10px 0;
      margin-bottom: 20px;
  }

  .dependent-on-pa h3 {
      margin: 0;
  }

  @media (max-width: 782px) {

    html,
    #wpwrap {
      background-color: transparent;
    }

    .about-wrap .feature-section.two-col > div.alt-feature {
      float: none;
    }
  }

</style>
