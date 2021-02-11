<?php
/**
 * The Template for displaying all single posts.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */
get_header();
?>
<style>
    /* chunk styles */
    .chunk {
        background:#8C8C8C;
        border:1px solid #A3A3A3;
        border-top-left-radius:0.8em;
        border-top-right-radius:0.8em;
        display:block;
        margin-bottom:2em;
        overflow:hidden;
        position:relative;
    }
    .chunk fieldset {
        border:none;
        margin:0;
        padding:0;
    }
    .chunk legend {
        border:none;
        margin:0;
        padding:0;
    }
    .chunk .hd {
        display:block;
        padding:0.5em 0 0.3em;
        width:100%; /* For IE8 */
    }
    .chunk .hd .text {
        color:#FFFFFF;
        font-family:helvetica,arial;
        font-size:18px;
        font-weight:bold;
        margin:0 0.5em;
        white-space:normal;
        display:block;zoom:1; /* For IE7 */
    }
    .chunk .bd {
        background: #eef;
        border-top:0.2em solid #8C8C8C;
        padding:1em 0.5em;
    }
    .chunk ol {
        margin:0;
        padding:0;
    }
    .chunk .fields li {
        list-style-type:none;
        margin-bottom:1em;
        overflow:hidden;
        position:relative;
    }
    .chunk .fields li.last-item{
        margin-bottom: 0px;
    }

    .chunk .list li {
        background:#edf;
        color:#336;
        padding:0.2em;
    }
    .chunk .list li:nth-child(2n) {
        background:#dce;
    }
    .chunk .fields .label {
        float:left;
        font-size:108%;
        width:25%;
        text-decoration: underline;
        font-style: italic;
    }
    .chunk .fields .field {
        font-size:108%;
        margin-left:30%;
        padding-right:7px;
        position:relative;
    }
    .chunk .fields .field input[type=text]{
        width:100%;
    }
    .chunk .fields .field.tiny input[type=text]{
        width:5em;
    }
    .chunk .fields .field.date input[type=text]{
        width:7em;
    }
    .chunk .fields .field.small input[type=text]{
        max-width:17em;
    }
    .chunk .fields .field textarea {
        height:6em;
        width:100%;
    }
</style>
<script data-ad-client="ca-pub-5286818578007218" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'single'); ?>
            <section class="chunk">
                <fieldset>
                    <legend class="hd">
                        <span class="text">Song's info</span>
                    </legend>
                    <div class="bd">
                        <ol class="fields">
                            <li>
                                <div class="label">Song name</div>
                                <div class="field"><b><?php the_title() ?></b></div>
                            </li>
                            <li>
                                <div class="label">Artist</div>
                                <div class="field small"><b><?php
                                        $terms = get_the_terms($post->id, 'artists');
                                        $term_name = array();
                                        foreach ($terms as $term) {
                                            $term_name[] = $term->name;
                                        }
                                        echo $term_name[0];
                                        ?></b>
                                </div>
                            </li>
                            <li>
                                <div class="label">Difficulty</div>
                                <div class="field small"><b><?php echo get_field('difficulty'); ?></b></div>
                            </li>
                            <li>
                                <div class="label">Price</div>
                                <div class="field small"><b><?php
                                        if (get_field('price') == 0)
                                            echo 'FREE';
                                        else
                                            echo '$' . get_field('price');
                                        ?></b></div>
                            </li>
                            <li class="last-item">
                                <div class="field small" style="opacity: 0.7"><?php
                                    if (get_field('price') == 0)
                                        echo '<a href="' . get_field('file_link') . '"><img src="wp-content/themes/vantage/images/download.png"></a>';
                                    else {
                                        $add_to_cart_shortcode = "[wp_cart_button name=\"" . get_the_title() . "\" price=\"" . get_field('price') . "\" file_url=\"" . get_field('file_link') . "\"]";
                                        echo do_shortcode($add_to_cart_shortcode);
                                    }
                                    ?></div>
                            </li>
                        </ol>
                    </div>
                </fieldset>
            </section>

            <section class="chunk">
                <fieldset>
                    <legend class="hd">
                        <span class="text">Tablature</span>
                    </legend>
                    <div class="bd">
                        <ol class="fields">
                            <li>
								<iframe name="<?php echo get_field('tab_link'); ?>" data-site_url="<?php echo site_url();?>" src="<?php echo site_url() . '/alphaTab/player.html'; ?>" width="100%" height="600">
                                    <p>Your browser does not support iframes.</p>
                                </iframe>
                            </li>
                        </ol>
                    </div>
                </fieldset>
            </section>

            <section class="chunk">
                <fieldset>
                    <legend class="hd">
                        <span class="text">Demo</span>
                    </legend>
                    <div class="bd">
                        <ol class="fields">
                            <li style="margin: 0; text-align:center">
                                <?php
                                    if(get_field('demo_link') == TRUE)
                                    {
                                        $youtube_demo_shortcode = '[embedyt]' . get_field('demo_link') . '[/embedyt]';
                                        echo do_shortcode($youtube_demo_shortcode);
                                    }
                                    else
                                    {
                                        echo "<center>Demo is not yet available</center>";
                                    }
                                ?>
                                <?php //else: ?>
                                    
                                <?php //endif; ?>
                                


                                    

                            </li>
                        </ol>
                    </div>
                </fieldset>
            </section>
            <?php //if( siteorigin_setting('navigation_post_nav') ) vantage_content_nav( 'nav-below' );   ?>
            <?php //if ( comments_open() || '0' != get_comments_number() ) :   ?>
            <?php //comments_template( '', true );  ?>
            <?php //endif;   ?>

        <?php endwhile; // end of the loop.   ?>

    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>