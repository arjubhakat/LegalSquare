<?php
/*
Plugin Name: Debt Reduction Calculator + Debt Relief Program Calculator All-In-One
Plugin URI: http://nomorecreditcards.com/
Description: With the All-In-One Debt Reduction Calculator and Debt Relief Program Calculator Plug in, from Golden Financial Services, you can find out approximately how much time and money you can save when staying current on accounts or paying minimum payments, with debt settlement services and consumer credit counseling.
All you have to do is enter your total debt ,a monthly payment that you would be able to afford  to become debt free, the interest percentage and hit “Calculate.” This free tool will calculate how much it will cost and how long it will take to become debt free.  It lays out approximately how much money you can save with debt settlement versus consumer credit counseling versus paying back your debt on your own.  Easy to understand graphs are included.  The numbers are compliant with the FTC.
Version: 1.2
Author: Paul Paquin
Author URI: http://nomorecreditcards.com/
License: GPLv2 or later
*/
/*  Copyright 2013  Paul Paquin  (email : paul@goldenfs.org)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (!defined('WP_CONTENT_DIR'))
    define( 'WP_CONTENT_DIR', ABSPATH.'wp-content' );
if (!defined('WC_Debt_M_DIR'))
 	define('WC_Debt_M_DIR', '/wp-content/plugins/debt-reduction-calculator-debt-relief-program-calculator-all-in-one');

 //adding style to theme front end,.
function sb_calculate_styles() {
    wp_register_style('cal-style', 	plugins_url( 'style.css', __FILE__ ), array());
    wp_enqueue_style('cal-style');
    //adding JavaScript
	wp_register_script('jplot-js', plugins_url('/js/jquery.jqplot.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('jplot-js');
	wp_register_script('jplot-barre', plugins_url('/js/jqplot.barRenderer.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('jplot-barre');
	wp_register_script('jplot-cat-axis', plugins_url('/js/jqplot.categoryAxisRenderer.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('jplot-cat-axis');
	wp_register_script('canvas-axis', plugins_url('/js/jqplot.canvasAxisTickRenderer.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('canvas-axis');
	wp_register_script('canvas-text', plugins_url('/js/jqplot.canvasTextRenderer.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('canvas-text');
	wp_register_script('jplot-poing-label', plugins_url('/js/jqplot.pointLabels.min.js', __FILE__ ), array('jquery'), '1.6');
    wp_enqueue_script('jplot-poing-label');
	wp_register_script('cal-functions', plugins_url('/js/debt_relief_calculation.js', __FILE__ ), array('jquery'), '1.1');
    wp_enqueue_script('cal-functions');
}
add_action('wp_enqueue_scripts', 'sb_calculate_styles');

//function to show the calculator
function debt_reduction_calculator() {
		
		$content .='<div id="wc_debt_mainWrapper">
    	<h1>Debt Calculator</h1>
    	<table align="center" cellpadding="4px">';
		
		$content .='<tr>
    	<td>Enter your total debt <i><span>(punctuation marks are not required)</span></i></td>
    	<td><b>$ </b><input type="text" value="00.00" onClick=this.value="" id="totalDebt"/></td>
    	</tr>';
	
		$content .='<tr>
    	<td>Type a monthly payment you can afford to become debt free<br/>
		<i><span>(punctuation marks are not required)</span></i></td>
    	<td><b>$ </b><input type="text" value="00.00" onClick=this.value="" id="monthlyPay"/></td>
    	</tr>';
	
		$content .='<tr>
    	<td>Interest percentage*</td>
    	<td><input type="text" value="00.00" onClick=this.value="" id="interestPerc"/>%</td>
    	</tr>
    
      	</table>
    
   			<p style="font-size:10px;padding:30px;"> Note*:Put the average interest rate that you are paying or that you were paying on your accounts.  This will be used to calculate how much you would end up paying when staying current on your accounts. The interest rate that you put in here, will not effect the figures that are calculated for the consumer credit counseling and debt settlement programs.</p>
		<p class="powered">Powered by <a href="http://nomorecreditcards.com/" id="last" target="_blank">nomorecreditcards.com</a></p>
   
     		<a href="#" id="calcu" onClick="calculate_func();"><center><img src="'.plugins_url('/images/calculate.png', __FILE__ ).'"/>		</center></a>';
	 
			$content .='<div class="clearIt"></div>
     		<div class="clearIt"></div>
     		<div id="calculation" style="display:none;">';
     
			$content .= '<table width="565" align="center" cellpadding="4px" id="tableWrap">
     
     			<tr>
     				<th width="96" bgcolor="#0C1E62">&nbsp;</th>
	 				<th width="122" bgcolor="#0C1E62" class="color" style="text-align:center;">Debt settlement</th>
	 				<th width="170" bgcolor="#0C1E62" class="color" style="text-align:center;">Consumer Credit Counseling</th>  
	 				<th width="133" bgcolor="#0C1E62" class="color" style="text-align:center;">On your Own</th> 
     			</tr>
     			<tr>
	 				<td bgcolor="#6FA5E9" style="color:#FFF;">Total Unsecured Debt</td>
	 				<td align="center" bgcolor="#A0CE2D"><input id="td1" type="text" readonly class="topRow cuswidth"/></td>
	 				<td align="center" bgcolor="#C9DFF6"><input id="td2" type="text" readonly class="topRow cuswidth" /></td>
     				<td align="center" bgcolor="#C9DFF6"><input id="td3" type="text" readonly class="topRow cuswidth"/></td>
     			</tr>
     			<tr>
	 				<td bgcolor="#6FA5E9" style="color:#FFF;">Time to Pay Off</td><td align="center" bgcolor="#A0CE2D">
	 				<input id="time1" type="text" readonly class="topRow"/></td>
	 				<td align="center" bgcolor="#C9DFF6"><input id="time2" type="text" readonly class="topRow cuswidth"/></td>
	 				<td align="center" bgcolor="#C9DFF6"><input id="time3" type="text"  readonly class="topRow cuswidth"/></td>
     			</tr>
     			<tr>
	 				<td bgcolor="#6FA5E9" style="color:#FFF;">Interest rate</td>
	 				<td align="center" bgcolor="#A0CE2D" style="text-align:center;"><span class="topRow cuswidth">None</span></td>
	 				<td align="center" bgcolor="#C9DFF6" style="text-align:center;"><span class="topRow cuswidth">8%</span></td>
	 				<td align="center" bgcolor="#C9DFF6" style="text-align:center;"><input id="interestPerc1" type="text" readonly class="topRow cuswidth"/></td>
     			</tr>
     			<tr>
	 				<td bgcolor="#6FA5E9" style="color:#FFF;">Monthly Payment</td>
	 				<td align="center" bgcolor="#A0CE2D"><input id="monthly_payment" type="text" readonly class="topRow cuswidth" /></td>
	 				<td align="center" bgcolor="#C9DFF6"><input id="payment" type="text"readonly class="topRow cuswidth" /></td>
	 				<td align="center" bgcolor="#C9DFF6"><input id="monthlyPay1" type="text" readonly class="topRow cuswidth"/></td>
     			</tr>
     
     			<tr>
	 				<td bgcolor="#6FA5E9">&nbsp;</td><td bgcolor="#A0CE2D">&nbsp;</td><td bgcolor="#C9DFF6">&nbsp;</td>
				 	<td bgcolor="#C9DFF6">&nbsp;</td>
     			</tr>
     			<tr>
	 				<td bgcolor="#6FA5E9" style="color:#FFF;">Total Pay Back</td>
	 				<td bgcolor="#A0CE2D"><input id="debtsettlement" type="text" readonly class="topRow cuswidth"/></td>
	 				<td bgcolor="#C9DFF6"><input id="consumer_credit_counseling" type="text" readonly class="topRow cuswidth "/></td>
	 				<td bgcolor="#C9DFF6"><input id="staying_current" type="text" readonly class="topRow cuswidth"/></td>
     			</tr>
     
     				</table>
					
 	<div id="graph_here">
		<h2 align="center">Total Cost</h2>
	    <div id="chart1" style="margin-top:20px; margin-left:20px; width:450px; height:300px;"></div>
	</div><!--end Graph-here-->
    
    <div id="graph_here">
		<h2 align="center">Monthly Payment</h2>
        <div id="chart2" style="margin-top:20px; margin-left:20px; width:450px; height:300px;"></div>
      </div>	
    </div><!--end Graph-here-->
	
	</div><!--end of calculation div-->';
     echo $content;          
}
	//Adding shortcode
add_shortcode('debt_reduction_calculator', 'debt_reduction_calculator');

function small_biz_all_page_fn() {
	echo '<br><center><a href="http://nomorecreditcards.com/" target="_blank"><img src="'.plugins_url('/images/main_banner.png', __FILE__ ).'"/></a></center>';
	echo '<h3>Usage</h3>';
	echo '<p>You can use shortcode in any page or post or widget [debt_reduction_calculator]</p>';
	echo '<p>To call calculator in template file use php function &lt;?php debt_reduction_calculator(); ?&gt;</p>';
	echo '<h3>Support</h3>';
	echo '<p>We are always available to help you for this plugin questions. We also appriciate your suggestions and feedback. Please email at paul@goldenfs.org</p>';
}

function small_biz_all_add_page_fn(){
    add_options_page('Debt Reduction Calculator '.__('options page','small-all-biz'), 'Debt Reduction Calculator ', 'manage_options', __FILE__, 'small_biz_all_page_fn');
}
add_action('admin_menu', 'small_biz_all_add_page_fn');