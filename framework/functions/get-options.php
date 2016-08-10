<?php
/**
 * Get Inti Options
 * based on get_theme_mod in wp-includes/theme.php
 * retrieves an option from the database or cache
 * can also get a value from post meta
 *
 * @package Inti
 * @since 1.0.0
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @param $field_name - name of field we're looking for
 * @param $option_array - name of option array in database the field is in
 * @param $default a default value if option is avialble
 * @param $meta_id post meta id to retrieve meta from database
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
if (!function_exists('get_inti_option')) {
    function get_inti_option( $field_name, $option_array, $default = false, $meta_id = null ) {
        
        // if meta_id isset then get the post meta
        if ( isset( $meta_id ) ) {
            $post_id = absint( get_queried_object_id() );
            
            // if posts page is set in reading settings get the page id
            if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') && is_home() ) {
                the_post();
                $post_id = get_option('page_for_posts');
                wp_reset_postdata();
            }
            
            // get the meta from the database
            $meta = ( get_post_meta( $post_id, $meta_id, true ) ) ? get_post_meta( $post_id, $meta_id, true ) : null;
            
            // if meta is an array check for the name in the array
            if ( is_array( $meta ) ) {
                $meta = $meta[ $field_name ];
            }
            
            // if meta isset return the value
            if ( isset( $meta ) ) {
                $meta = do_shortcode( $meta );
                return apply_filters( "inti_meta_$field_name", $meta );
            } 
        
        // if meta_id is null, then we're talking theme options, get the array of options
        } else {
            $options = ( get_option( $option_array ) ) ? get_option( $option_array ) : null;
        }
            
        // return the option if it exists
        if ( isset( $options[ $field_name ] ) ) {
            return $options[ $field_name ];
        }
            
        // return default if nothing else
        return $default;
    }
}
