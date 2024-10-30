<?php
/*
Plugin Name: JR Favorite Quote
Plugin URI: http://www.jacobras.nl/wordpress/favorite-quote/
Description: JR Favorite Quote shows one or more (rotating, or static) of your favorite quotes in your theme's sidebar (or anywhere you like).
Version: 1.1
Author: Jacob Ras
Author URI: http://www.jacobras.nl

	Copyright 2009  Jacob Ras  (email : info@jacobras.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

--------------------

~ Changelog:

v1.1 (November 9, 2009)
- Fixed bug where plugins showed 'Fatal error'
- Now ignores empty quotes
- Fixed empty quotes problem (when using less than 3 quotes)
- Now shows default text when there is no quote entered

v1.01 (September 23, 2009)
- Small fixes

v1.0 (September 22, 2009)
- First final release

*/

function jr_favorite_quote() {
	
	$jr = get_option('jr_favorite_quote');
	if ($jr['showquote'] == 'random') { shuffle($jr['quotes']); }
	$jr_inlinecss = "<style type=\"text/css\">
	.jr-quote { font-family: 'Georgia'; font-style: italic; font-size: 16px; background: #" . $jr['bgcolor'] . "; padding: 6px; border:none; color: #" . $jr['quotecolor'] . " }
	.jr-quote cite { font-size: 12px; color: #" . $jr['citecolor'] . "; }
	.jr-quote a { text-decoration: none; }
	.jr-quote a#jr-link {  margin:0; color: #" . $jr['citecolor'] . "; border-bottom: 1px solid #" . $jr['citecolor'] . "; }
	.jr-quote a#jr-link:hover { text-decoration: none; border-bottom: 1px solid #" . $jr['bgcolor'] . "; }
	</style>";
	echo '<!-- JR Favorite Quote for Wordpress -->' . "\n";
	echo $jr_inlinecss . "\n";
	echo '<blockquote class="jr-quote">' . "\n" . '&quot;';
	
	if ($jr['showquote'] == 'quote2') {
		echo $jr['quotes'][1]['quote'];
	} elseif ($jr['showquote'] == 'quote3') {
		echo $jr['quotes'][2]['quote'];
	} else {
		
		if (!empty($jr['quotes'][0]['quote'])) {
			echo $jr['quotes'][0]['quote'];
		} elseif(!empty($jr['quotes'][1]['quote'])) {
			echo $jr['quotes'][1]['quote'];
		} elseif(!empty($jr['quotes'][2]['quote'])) {
			echo $jr['quotes'][2]['quote'];
		} else {
			echo 'No quote available.';
			$err_noquote = true;
		}
	}
	
	echo '&quot;<br />' . "\n" . '<cite>';
	if ($jr['showsupportlink'] == 'on') { echo '<a href="http://www.jacobras.nl/wordpress/favorite-quote/" title="JR Wordpress Favorite Quotes" id="jr-link">Quote</a> by: '; } else { echo 'Quote by: '; }
	
	if ($err_noquote == true) {
		echo 'JR Favorite Quote';
	} elseif ($jr['showquote'] == 'quote2') {
		echo $jr['quotes'][1]['by'];
	} elseif ($jr['showquote'] == 'quote3') {
		echo $jr['quotes'][2]['by'];
	} else {
		echo $jr['quotes'][0]['by'];
	}
	
	echo '</cite>' . "\n" . '</blockquote>' . "\n";
	echo '<!-- JR Favorite Quote for Wordpress -->' . "\n";
	
}

function jr_favorite_quote_admin() { ?>
	
	<div class="wrap">
		<a href="http://www.jacobras.nl"><img src="http://www.jacobras.nl/logo-32.png" width="32" height="32" style="float:left;margin:14px 6px 0 6px;" alt="" /></a>
		<h2>JR Show Favorite Quote</h2>
		
		<?php if($_POST['jr_hidden'] == 'Y') {
			$jr['showsupportlink'] = $_POST['jr_showsupportlink'];
			$jr['showquote'] = $_POST['jr_showquote'];
			$jr['showinlinecss'] = $_POST['jr_showinlinecss'];
			//$jr['quotes'] = array();
			$jr['quotes'][0]['quote'] = stripslashes($_POST['jr_quote1']);
			$jr['quotes'][0]['by'] = stripslashes($_POST['jr_quote1_by']);
			$jr['quotes'][1]['quote'] = stripslashes($_POST['jr_quote2']);
			$jr['quotes'][1]['by'] = stripslashes($_POST['jr_quote2_by']);
			$jr['quotes'][2]['quote'] = stripslashes($_POST['jr_quote3']);
			$jr['quotes'][2]['by'] = stripslashes($_POST['jr_quote3_by']);
			$jr['citecolor'] = $_POST['jr_citecolor'];
			$jr['quotecolor'] = $_POST['jr_quotecolor'];
			$jr['bgcolor'] = $_POST['jr_bgcolor'];
			update_option('jr_favorite_quote', $jr);
			?>
			<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
			<?php
		} else {
			$jr = get_option('jr_favorite_quote');
		} ?>
		
		<div class="postbox-container" style="width:70%;"><div class="metabox-holder">
			<form action="" method="post">
			<input type="hidden" name="jr_hidden" value="Y" />
				<div class="postbox">
					<h3><span>Settings for JR Favorite Quote</span></h3>
					<div class="inside">
						<table class="form-table">
							<tr>
								<th valign="top">
									<label>Quote 1:</label>
								</th>
								<td valign="top"><input type="text" name="jr_quote1" value="<?php echo $jr['quotes'][0]['quote']; ?>" size="60" /> by <input type="text" name="jr_quote1_by" value="<?php echo $jr['quotes'][0]['by']; ?>" size="22" /></td>
							</tr>
							<tr>
								<th valign="top">
									<label>Quote 2:</label>
								</th>
								<td valign="top"><input type="text" name="jr_quote2" value="<?php echo $jr['quotes'][1]['quote']; ?>" size="60" /> by <input type="text" name="jr_quote2_by" value="<?php echo $jr['quotes'][1]['by']; ?>" size="22" /></td>
							</tr>
							<tr>
								<th valign="top">
									<label>Quote 3:</label>
								</th>
								<td valign="top"><input type="text" name="jr_quote3" value="<?php echo $jr['quotes'][2]['quote']; ?>" size="60" /> by <input type="text" name="jr_quote3_by" value="<?php echo $jr['quotes'][2]['by']; ?>" size="22" /></td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>Which quote should be showed:</label>
								</th>
								<td valign="top">
									<select name="jr_showquote">
										<option <?php if($jr['showquote'] == 'random') { echo 'selected="selected"'; } ?> value="random">Random quote&nbsp;&nbsp;&nbsp;</option>
										<option <?php if($jr['showquote'] == 'quote1') { echo 'selected="selected"'; } ?> value="quote1">Quote 1&nbsp;&nbsp;&nbsp;</option>
										<option <?php if($jr['showquote'] == 'quote2') { echo 'selected="selected"'; } ?> value="quote2">Quote 2&nbsp;&nbsp;&nbsp;</option>
										<option <?php if($jr['showquote'] == 'quote3') { echo 'selected="selected"'; } ?> value="quote3">Quote 3&nbsp;&nbsp;&nbsp;</option>
									</select>
								</td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>Use inline CSS:</label><br/>
									<small>When you uncheck this, make sure you've include the CSS properties in your stylesheet</small>
								</th>
								<td valign="top">
									<input type="checkbox" name="jr_showinlinecss" <?php if ($jr['showinlinecss']) { echo 'checked="checked"'; } ?> />
								</td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>Background color</label><br />
									<small>Only works when inline css is enabled</small>
								</th>
								<td valign="top">#<input type="text" name="jr_bgcolor" value="<?php echo $jr['bgcolor']; ?>" size="6" /></td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>Quote text color</label><br />
									<small>Only works when inline css is enabled</small>
								</th>
								<td valign="top">#<input type="text" name="jr_quotecolor" value="<?php echo $jr['quotecolor']; ?>" size="6" /></td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>'Quote by' text color</label><br />
									<small>Only works when inline css is enabled</small>
								</th>
								<td valign="top">#<input type="text" name="jr_citecolor" value="<?php echo $jr['citecolor']; ?>" size="6" /></td>
							</tr>
							
							<tr>
								<th valign="top">
									<label>Show support link (recommended):</label><br/>
									<small>Support the further development of this plugin</small>
								</th>
								<td valign="top">
									<input type="checkbox" name="jr_showsupportlink" <?php if ($jr['showsupportlink']) { echo 'checked="checked"'; } ?> />
								</td>
							</tr>
						</table>
						<div style="margin:20px 0 12px 0;padding-left:12px;"><input type="submit" class="button-primary" name="submit" value="Save settings" /></div>
					</div>
				</div>
			</form>
		</div></div>
		
		<div class="postbox-container" style="width:20%;">
			<div class="metabox-holder">
				<div class="postbox">
					<h3><span>Need help?</span></h3>
					<div class="inside" style="padding:0 12px;">
						<p>If you have any problems with this plugin or good ideas for improvements or new features, please <a href="http://www.jacobras.nl/contact/">let me know</a>.</p>
					</div>
				</div>
				
				<div class="postbox">
					<h3><span>Like this plugin?</span></h3>
					<div class="inside" style="padding:0 12px;">
						<p>Why don't you:</p>
						
						<a href="http://www.jacobras.nl/wordpress/" style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Check out my other handy plugins</a>
						
						<a href="http://wordpress.org/extend/plugins/jr-favorite-quote/" style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Vote for the plugin on WordPress.org.</a>
						
						<a href=""style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Donate a token of your appreciation.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php }

function jr_favorite_quote_configpagina() {
	add_options_page("JR Favorite Quote", "JR Favorite Quote", 1, "jr-favorite-quote", "jr_favorite_quote_admin");  
}


// default settings
$jr 						= array();
$jr['showsupportlink']		= 'on';
$jr['showinlinecss']		= 'on';
$jr['showquote']			= 'random';
$jr['citecolor']			= 'a3a3a3';
$jr['quotecolor']			= '000000';
$jr['bgcolor']				= 'f6f6f6';
$jr['quotes'] 				= array();
$jr['quotes'][0]			= array('quote' => "It's not what you look at that matters, it's what you see.", 'by' => 'Henry David Thoreau');
$jr['quotes'][1]			= array('quote' => "A mistake is simply another way of doing things.", 'by' => 'Katharine Graham');
$jr['quotes'][2]			= array('quote' => "The use of money is all the advantage there is in having it.", 'by' => 'Benjamin Franklin');
add_option('jr_favorite_quote', $jr);
add_action('admin_menu', 'jr_favorite_quote_configpagina');
?>