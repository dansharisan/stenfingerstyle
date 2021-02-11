<?php
/**
 * Template Name: Tabs
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */
 
get_header();
?>
<style>
    .datagrid table {
        border-collapse: collapse;
        text-align: left;
        width: 100%;
        ;
    }

    .datagrid {
        font: normal 12px/150% Arial, Helvetica, sans-serif;
        background: #fff;
        overflow: hidden;
        border: 1px solid #8C8C8C;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 5px;
        ;
    }

    .datagrid table td,.datagrid table th {
        padding: 3px 10px;
        text-align: center;
        ;
    }

    .datagrid table thead th {
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #8C8C8C
            ), color-stop(1, #7D7D7D) );
        background: -moz-linear-gradient(center top, #8C8C8C 5%, #7D7D7D 100%);
        filter: progid : DXImageTransform.Microsoft.gradient ( startColorstr =
            '#8C8C8C', endColorstr = '#7D7D7D' );
        background-color: #8C8C8C;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: bold;
        border-left: 1px solid #A3A3A3;
        text-align: center;
        ;
    }

    .datagrid table thead th:first-child {
        border: none;
        ;
    }

    .datagrid table tbody td {
        color: #7D7D7D;
        border-left: 1px solid #DBDBDB;
        font-size: 12px;
        font-weight: normal;
        vertical-align: middle;
        ;
    }
    /*
    .datagrid table tbody .alt td  {
             background: #EBEBEB;
             color: #7D7D7D;
             ;
    }
    */
    .datagrid table tbody td:first-child {
        border-left: none;
        ;
    }

    .datagrid table tbody tr:last-child td {
        border-bottom: none;
        ;
    }

    .datagrid table tfoot td div {
        border-top: 1px solid #8C8C8C;
        background: #EBEBEB;
    }

    .datagrid table tfoot td {
        padding: 0;
        font-size: 12px;
    }

    .datagrid table tfoot td div {
        padding: 2px;
        ;
    }

    .datagrid table tfoot td ul {
        margin: 0;
        padding: 0;
        list-style: none;
        text-align: right;
        ;
    }

    .datagrid table tfoot  li {
        display: inline;
        ;
    }

    .datagrid table tfoot li a {
        text-decoration: none;
        display: inline-block;
        padding: 2px 8px;
        margin: 1px;
        color: #F5F5F5;
        border: 1px solid #8C8C8C;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #8C8C8C
            ), color-stop(1, #7D7D7D) );
        background: -moz-linear-gradient(center top, #8C8C8C 5%, #7D7D7D 100%);
        filter: progid : DXImageTransform.Microsoft.gradient ( startColorstr =
            '#8C8C8C', endColorstr = '#7D7D7D' );
        background-color: #8C8C8C;
        ;
    }

    .datagrid table tfoot ul.active,.datagrid table tfoot ul a:hover {
        text-decoration: none;
        border-color: #7D7D7D;
        color: #F5F5F5;
        background: none;
        background-color: #8C8C8C;
    }

    .datagrid table tr:hover {
        background-color: #BFBFBF;
    }

    div.dhtmlx_window_active,div.dhx_modal_cover_dv {
        position: fixed !important;
        ;
        #primary
        {
            width:90% !important;
        }
    }
    .views {
        display: none;
    }
    td.paging {
        background: #8C8C8C;
    }
    td.paging span {
        color: white;
        font-weight: bolder;
        font-size: large;
    }
    td.paging a {
        color: white;
        font-weight: bold;
        font-size: larger;
    }
    td.paging a:hover {
        color: white;
        opacity: 0.5;
    }
</style>

<div id="primary" class="content-area"
     style="width: 100%">
    <div id="content" class="site-content" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
        <?php endwhile; // end of the loop. ?>

        
        <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $custom_args = array(
            'post_type' => 'tabs',
            'paged' => $paged,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        
        //Sort by Difficulty: $custom_args = array('post_type' => 'tabs','paged' => $paged,'meta_key'=>'difficulty','orderby' => 'meta_value','order' => 'ASC');

        
        $custom_query = new WP_Query($custom_args);
        ?>

        <?php if ($custom_query->have_posts()) : ?>
        <div id="left-content" style="float: left; min-width: 65%">
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Song Name</th>
                            <th scope="col">Artist</th>
                            <th scope="col">Difficulty</th>
                            <th scope="col" class="views">Views</th>
                            <th scope="col">Modified Date</th>
                            <!-- <th scope="col">Price</th>
                            <th scope="col">Action</th> -->
                        </tr>
                    </thead>
            <!-- the loop -->
                    <tbody>
            <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>                 
                        <tr>
                            <td style="text-align: left"><a href="?tabs=<?php echo $post->post_name ?>"><?php the_title(); ?>
                                </a></td>
                            <td style="text-align: left"><?php
                                $terms = get_the_terms($post->id, 'artists');
                                if (!empty($terms))
                                {
                                    $term_name = array();
                                    foreach ($terms as $term) {
                                        $term_name[] = $term->name;
                                    }
                                    echo $term_name[0];
                                } else {
                                    echo "<i>Unknown</i>";
                                }                       
                                ?>
                            </td>
                            <td style="text-align: left"><?php echo get_field('difficulty'); ?></td>
                            <td class="views"><?php do_shortcode('[kpvc_loop post_id=' . get_the_ID() . ' today="no" ] '); ?>
                            </td>
                            <td><?php
                                $last_modified_date = date("j M Y", strtotime(get_field('last_modified_date')));
                                echo $last_modified_date;
                                ?>
                            </td>
                            <!-- <td>
                                <?php
                                // if (get_field('price') == 0)
                                //     echo 'FREE';
                                // else
                                //     echo '$' . get_field('price');
                                ?>
                            </td> -->
                            <!-- <td style="opacity: 0.6">
                                <?php
                                // if (get_field('price') == 0)
                                //     echo '<a href="' . get_field('file_link') . '"><img src="wp-content/themes/vantage/images/download.png"></a>';
                                // else {
                                //     $add_to_cart_shortcode = "[wp_cart_button name=\"" . get_the_title() . "\" price=\"" . get_field('price') . "\" file_url=\"" . get_field('file_link') . "\"]";
                                //     echo do_shortcode($add_to_cart_shortcode);
                                // }
                                ?>
                            </td> -->
                        </tr>
            <?php endwhile; ?>
                    </tbody>
            <!-- end of the loop -->
                <?php if ($custom_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                    <tfoot>
                        <tr>
                            <td class="paging" colspan="12" style="background: #8C8C8C">
                                <?php for ($page = 1; $page <= $custom_query->max_num_pages; $page++) 
                                {
                                    
                                    if (get_query_var('paged') == $page || ($page == 1 && get_query_var('paged') == 0))
                                    {
                                        echo "<span>" . $page . "&nbsp;&nbsp;</span>";
                                    } else {
                                        $link = "<a href='" . preg_replace("/&paged=\d*/", "", $_SERVER['REQUEST_URI']) . "&paged=" . $page . "'>" . $page . "</a>&nbsp;&nbsp;";
                                        echo $link;
                                    }  
                                }
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                <?php } ?>
                </table>
                </div>
            </div>
            <div id="right-content" style="float: right; min-width: 25%">
                <div>
                    <?php echo do_shortcode('[show_wp_shopping_cart]'); ?>
                </div>
            </div>
        </div>
        <!-- #content .site-content -->
    </div>
   
        <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>


<!-- #primary .content-area -->

<?php get_footer(); ?>