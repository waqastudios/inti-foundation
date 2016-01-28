<?php 
/**
 * Inti Shortcodes
 * Add shortcodes to theme
 *
 * @package Inti
 * @author Stuart Starrs
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.9
 * @author Thomas Griffin
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function inti_shortcode_empty_paragraph_fix( $content ) { 
	$array = array( '<p>[' => '[', ']</p>' => ']', ']<br />' => ']' ); 
	return strtr( $content, $array ); 
}
add_filter( 'the_content', 'inti_shortcode_empty_paragraph_fix' ); 


/* ---------------------------------------------------------------------- */
/*	Foundation 6 Grid Columns
/* ---------------------------------------------------------------------- */



/* ---------------------------------------------------------------------- */
/*	Buttons
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_button')) {
	function inti_shortcode_button( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'url' => '',
			'target' => '',
			'type' => '', // success, alert, disabled, info, secondary
			'style' => '', // tiny, small, default, large, expanded
		), $atts ) );
		return '<a href="'. $url .'" class="button '. $type .' '. $style .'" role="button" target="'. $target .'">'. $content .'</a>';
	}
	add_shortcode('button', 'inti_shortcode_button');
}

if (!function_exists('inti_shortcode_dropdown_button')) {
	function inti_shortcode_dropdown_button( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';	
		extract( shortcode_atts( array(
			'type' => '', // success, alert, disabled, info, secondary
			'style' => '', // tiny, small, default, large, expanded, 
			'align' => '', //default(bottom), top, left, right
			'hover' => '',
			'icon' => '',
			'title' => '' //button text
		), $atts ) );
		$id = md5(uniqid(rand(), true));

		$html = '<button class="button';

		if ($style) $html .= ' ' . $style;
		if ($icon) $html .= ' ' . $icon;

		$html .= '" type="button" data-toggle="inti-dropdown-' . $id . '">' . $title . '</button>';

		$html .= '<div class="dropdown-pane" id="inti-dropdown-' . $id . '" data-dropdown ';

		if ($hover == "true") $html .= 'data-hover="true"';
		$html .= '>' . $content . '</div>';

		return $html;

	}
	add_shortcode('dropdown-button', 'inti_shortcode_dropdown_button');
}



/* ---------------------------------------------------------------------- */
/*	Flex Video
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_flex_video')) {
	function inti_shortcode_flex_video( $atts, $content = null ) {	
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'aspect' => '', // widescreen
			'source' => '', // youtube, vimeo, wistia
			'id' => ''
		), $atts ) );
		$html = '<div class="flex-video '. $aspect .' '. $source .'">';
		switch ($source) {
			case 'youtube' :
				$html .= '<iframe src="http://www.youtube.com/embed/'. $id .'?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0" allowfullscreen></iframe>';
				break;
			case 'vimeo' :
				$html .= '<iframe src="http://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				break;
			case 'wistia' :
				$html .= '<iframe src="http://fast.wistia.net/embed/iframe/'. $id .'?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>';
				break;
		}
		$html .= '';
		$html .= '</div>';

		return $html;
	}
	add_shortcode('flex-video', 'inti_shortcode_flex_video');
}


/* ---------------------------------------------------------------------- */
/*	Callout
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_callout')) {
	function inti_shortcode_callout( $atts, $content = null ) {	
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'type' => '', // secondary, primary, success, warning, alert
			'style' => '',
			'closeable' => '' // true, false
		), $atts ) );

		$html = '<div class="';
		if ($closeable == 'true') {
			$html .= ' callout ' . $type . ' ' . $style . '" data-closable>';
			$html .= $content . '<button class="close-button" aria-label="Dismiss Alert" type="button" data-close><span aria-hidden="true">&times;</span></button>';
		} else {
			$html .= ' callout ' . $type . ' ' . $style . '">' . $content;
		}
		$html .= '</div>';

		return $html;
	}
	add_shortcode('callout', 'inti_shortcode_callout');
}


/* ---------------------------------------------------------------------- */
/*	Accordion
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_accordion')) {
	function inti_shortcode_accordion( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';	
		extract( shortcode_atts( array(
			'allowmultiexpand' => '',
			'allowallclosed' => ''
		), $atts));
		$id = md5(uniqid(rand(), true));
		$html = '<ul class="accordion" data-accordion role="tablist" id="accordion-'. $id .'"';
		
		if ($allowmultiexpand == "true") {
			$html .= ' data-multi-expand="true"';
		}		
		if ($allowallclosed == "true") {
			$html .= ' data-allow-all-closed="true"';
		}
		
		$html .= '>' . $content .'</ul>';

		return $html;
	}
	add_shortcode('accordion', 'inti_shortcode_accordion');
}

if (!function_exists('inti_shortcode_accordion_item')) {
	function inti_shortcode_accordion_item( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'title' => ''
		), $atts));
		$id = md5(uniqid(rand(), true));
		return '<li class="accordion-item">
					<a href="#accordion-panel-'. $id .'" role="tab" id="accordion-panel-'. $id .'-heading" class="accordion-title" aria-controls="accordion-panel-'. $id .'">'. $title .'</a>' .
					'<div class="accordion-content" roll="tabpanel" data-tab-content aria-labelledby="accordion-panel-heading">'. $content .
				'</li>';
	}
	add_shortcode('accordion-item', 'inti_shortcode_accordion_item');
}


/* ---------------------------------------------------------------------- */
/*	Tabs
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_tab')) {
	function inti_shortcode_tabs( $atts, $content = null ) {
		$content = trim($content);	
		extract( shortcode_atts( array(
			'orientation' => '' // horizontal, vertical
		), $atts));

		$GLOBALS['tab_counter'] = 0;
		$GLOBALS['tab_title'] = true;
		$GLOBALS['tab_id'] = md5(uniqid(rand(), true));

		$id = md5(uniqid(rand(), true));
		$output = '<div class="tabs-wrapper">';

		$output .= '<ul class="tabs '. $orientation .'" data-tabs id="inti-tabs-' . $id . '">';
		$output .= do_shortcode($content);
		$output .= '</ul><!--/.tabs -->';
		
		$GLOBALS['tab_counter'] = 0;
		$GLOBALS['tab_title'] = false;
		$output .= '<div class="tabs-content" data-tabs-content="inti-tabs-' . $id . '">';
		$output .= do_shortcode($content);
		$output .= '</div><!-- /.tabs-content -->';
		$output .= '</div><!-- /.tabs-wrapper -->';

		return $output;
	}
	add_shortcode('tabs', 'inti_shortcode_tabs');
}

if (!function_exists('inti_shortcode_tab_item')) {
	function inti_shortcode_tabs_item( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'title' => ''
		), $atts));
		
		$GLOBALS['tab_counter']++;
		$active_class = ($GLOBALS['tab_counter'] == 1) ? ' is-active' : '' ;

		if ($GLOBALS['tab_title']){
			$output = '<li class="tabs-title '. $active_class .'"><a href="#tabpanel-'. $GLOBALS['tab_id'] .'-'. $GLOBALS['tab_counter'] .'">'. $title .'</a></li>';
		} else {
			$output = '<div class="tabs-panel '. $active_class  .'" id="tabpanel-'. $GLOBALS['tab_id'] .'-'. $GLOBALS['tab_counter'] .'">'. $content .'</div>';
		}
		return $output;

		
	}
	add_shortcode('tabs-item', 'inti_shortcode_tabs_item');
}


/* ---------------------------------------------------------------------- */
/*	ToolTip
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_tooltip')) {
	function inti_shortcode_tooltip( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';
		extract( shortcode_atts( array(
			'title' => '',
			'type' => '', //block, inline
			'direction' => ''
		), $atts ) );

			switch ($direction){
				case 'top':
					$direction_class = 'has-tip top';
				break;
				case 'left':
					$direction_class = 'has-tip left';
				break;
				case 'right':
					$direction_class = 'has-tip right';
				break;
				case 'bottom':
			default:
				$direction_class = 'has-tip bottom';
			break;
			}

			if ($type === "block") {
				return '<span data-tooltip aria-haspopup="true" data-disable-hover="false" class="'. $direction_class . '" title="'. $title .'">'. $content .'</span>';
			} else {
				return '<div data-tooltip aria-haspopup="true" data-disable-hover="false" class="'. $direction_class . '" title="'. $title .'">'. $content .'</div>';
			}
	}
	add_shortcode('tooltip', 'inti_shortcode_tooltip');
}


/* ---------------------------------------------------------------------- */
/*	Label
/* ---------------------------------------------------------------------- */

if (!function_exists('inti_shortcode_label')) {
	function inti_shortcode_label( $atts, $content = null ) {
		$content = (trim($content)) ? do_shortcode($content) : '';		
		extract( shortcode_atts( array(
			'type' => '', // default, secondary, alert, warning, success, info
			'icon' => ''
		), $atts ) );

		$html = '<span class="label '. $type .'">';
		$html .= '<i class="' . $icon . '"></i> ';
		$html .= $content .'</span>';

		return $html;
	}
	add_shortcode('label', 'inti_shortcode_label');
}