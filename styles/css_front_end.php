<style type="text/css">
/* dynamical css styles declared below: */

/* declare external fonts */
@font-face { font-family: Azbuka04; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Azbuka04.ttf'); } 
@font-face { font-family: Avalon-Bold; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Avalon-Bold.ttf'); }  
@font-face { font-family: Avalon-Plain; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Avalon-Plain.ttf'); } 
@font-face { font-family: Cour; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/cour.ttf'); }  
@font-face { font-family: DSNote; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/(DS)_Note.ttf'); }  
@font-face { font-family: HebarU; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/HebarU.ttf'); } 
@font-face { font-family: Montserrat-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Montserrat-Regular.otf');}  
@font-face { font-family: MTCORSVA; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/MTCORSVA.TTF'); } 
@font-face { font-family: Lato-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Lato-Regular.ttf'); }  
@font-face { font-family: Nicoletta_script; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Nicoletta_script.ttf'); } 
@font-face { font-family: Oswald-Light; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Oswald-Light.otf'); }
@font-face { font-family: Oswald-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Oswald-Regular.ttf'); }
@font-face { font-family: Raleway-Regular; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Raleway-Regular.ttf'); } 
@font-face { font-family: Regina Kursiv; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/ReginaKursiv.ttf'); }
@font-face { font-family: Segoe-UI; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Segoe-UI.ttf'); }  
@font-face { font-family: Tex Gyre Adventor;src:url('<?php echo $CONFIG["full_url"];?>fonts/texgyreadventor-regular.otf');} 
@font-face { font-family: Ubuntu-R; src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Ubuntu-R.ttf'); }  

/* set background color in the div */
.background_div {
	background-color:<?php echo $OptionsVis["gen_bgr_color"];?>;	
}

/* div that wrap all the front-end */
div.front_wrapper_esp {
	color:<?php echo $OptionsVis["gen_font_color"];?>;
	font-family:<?php echo $OptionsVis["gen_font_family"];?>; 
	font-size:<?php echo $OptionsVis["gen_font_size"];?>;
	margin:0 auto !important;
	padding-top: 0 !important;
	padding-bottom: 0 !important; 
	line-height:<?php echo $OptionsVis["gen_line_height"];?>;
	word-wrap:break-word !important;
	<?php if(trim($OptionsVis["gen_width"])!=''){ ?>
	max-width: <?php echo trim($OptionsVis["gen_width"]); ?><?php echo $OptionsVis["gen_width_dim"]; ?>;
	<?php } ?>
}



/* "MAIN MENU" style start */
.navbar {
	background-color: <?php echo $OptionsVis["main_menu_bgr"];?> !important;
}
li.nav-item a.nav-link { /* submit event link and back link style */
	font-family:<?php echo $OptionsVis["link_font"];?> !important; 
	color:<?php echo $OptionsVis["link_color"];?> !important;
	font-size:<?php echo $OptionsVis["link_font_size"];?> !important;
	font-weight:<?php echo $OptionsVis["link_font_weight"];?> !important;
	text-decoration:<?php echo $OptionsVis["link_text_decoration"];?> !important;
}
li.nav-item a.nav-link:hover { /* submit event link style on mouse over */
	color:<?php echo $OptionsVis["link_color_hover"];?> !important;
	font-size:<?php echo $OptionsVis["link_font_size"];?> !important;
	font-weight:<?php echo $OptionsVis["link_font_weight"];?> !important;
	text-decoration: <?php echo $OptionsVis["link_text_decoration_hover"];?> !important;
}

a.dropdown-item { /* drop-down menu */
    color: <?php echo $OptionsVis["cat_dd_color"];?>;
	font-family: <?php echo $OptionsVis["cat_dd_family"];?>;
	font-size: <?php echo $OptionsVis["cat_dd_font_size"];?>;
	font-style: <?php echo $OptionsVis["cat_dd_font_style"];?>;
	font-weight: <?php echo $OptionsVis["cat_dd_font_weight"];?>;
	text-align: <?php echo $OptionsVis["cat_dd_align"];?>;
	background-color: <?php echo $OptionsVis["cat_dd_bgr_color"];?>;
}
a.dropdown-item:hover { /* drop-down menu on hover */
	background-color: <?php echo $OptionsVis["cat_dd_bgr_color_hover"];?>;
}
.form-control { /* search box style*/
    font-family:<?php echo $OptionsVis["link_font"];?> !important; 
	font-size:<?php echo $OptionsVis["link_font_size"];?> !important; 
	color:<?php echo $OptionsVis["link_color"];?> !important; 
}
.md-form input[type="text"]:focus:not([readonly]) {
	box-shadow: 0 1px 0 0 #ced4da;
	border-bottom: 1px solid <?php echo $OptionsVis["link_color"];?>;
}

div.back_link_dist { /* distance between main menu and other content */
	height:<?php echo $OptionsVis["dist_link_title"];?> !important;
}
/* "MAIN MENU" style end */



/* EVENT LIST styles start */
div.summary_img_wrap { /* div that wrap the image in the summary */
	<?php 
	if(!isset($OptionsVis["summ_img_width"]) or trim($OptionsVis["summ_img_width"])=="") {
		$OptionsVis["summ_img_width"]=35;
	}
	?>
	width: <?php echo $OptionsVis["summ_img_width"];?>%;
	<?php 
	if(!isset($OptionsVis["summ_img_propor"]) or trim($OptionsVis["summ_img_propor"])=="") {
		$OptionsVis["summ_img_propor"]=0.75;
	}
	?>
	padding-bottom : <?php echo ($OptionsVis["summ_img_width"]*$OptionsVis["summ_img_propor"]);?>%;
	cursor: pointer;
}
div.summary_text_wrap { /* div that wrap the text in events list */
	width: <?php echo (100-$OptionsVis["summ_img_width"]);?>%;
}

@media only screen and (max-width:600px){ /* events list in mobile view */
	div.summary_img_wrap { /* div that wrap the image in the summary */
		<?php 
		if(!isset($OptionsVis["summ_img_propor"]) or trim($OptionsVis["summ_img_propor"])=="") {
			$OptionsVis["summ_img_propor"]=0.75;
		}
		?>
		padding-bottom : <?php echo (98*$OptionsVis["summ_img_propor"]);?>%;
	}
}

.summ_edate {	/* events list date style */
	color:<?php echo $OptionsVis["summ_edate_color"];?>; 
	font-family:<?php echo $OptionsVis["summ_edate_font"];?>; 
	font-size:<?php echo $OptionsVis["summ_edate_size"];?>;
	font-style:<?php echo $OptionsVis["summ_edate_font_style"];?>;
	padding-bottom:<?php echo $OptionsVis["summ_dist_edate_etime"];?>;
}
.event_title_summ { /* events list title style - align and distance from the text below */
	text-align:<?php echo $OptionsVis["summ_title_text_align"];?> !important;	
	padding-bottom:<?php echo $OptionsVis["summ_dist_title_date"];?> !important;
}
.event_title_summ a { /* events list title style */
	color:<?php echo $OptionsVis["summ_title_color"];?> !important;
	font-family:<?php echo $OptionsVis["summ_title_font"];?> !important;
	font-size:<?php echo $OptionsVis["summ_title_size"];?> !important;
	font-weight:<?php echo $OptionsVis["summ_title_font_weight"];?> !important;
	font-style:<?php echo $OptionsVis["summ_title_font_style"];?> !important;
	line-height:<?php echo $OptionsVis["summ_title_line_height"];?> !important;
	text-decoration:<?php echo $OptionsVis["summ_title_decor"];?> !important;
}
.event_title_summ a:hover { /* events list title style on mouse over(hover)  */
	color:<?php echo $OptionsVis["summ_title_color_hover"];?> !important;
	font-family:<?php echo $OptionsVis["summ_title_font"];?> !important;
	font-size:<?php echo $OptionsVis["summ_title_size"];?> !important;
	font-weight:<?php echo $OptionsVis["summ_title_font_weight"];?> !important;
	font-style:<?php echo $OptionsVis["summ_title_font_style"];?> !important;
	line-height:<?php echo $OptionsVis["summ_title_line_height"];?> !important;
	text-decoration:<?php echo $OptionsVis["summ_title_decor_hover"];?> !important;
}
.summ_loc {	/* event location style */
	color:<?php echo $OptionsVis["summ_loc_color"];?>; 
	font-family:<?php echo $OptionsVis["summ_loc_font"];?>; 
	font-size:<?php echo $OptionsVis["summ_loc_size"];?>;
	font-weight:<?php echo $OptionsVis["summ_loc_font_weight"];?>;
	font-style: <?php echo $OptionsVis["summ_loc_font_style"];?>;
	padding-bottom:<?php echo $OptionsVis["summ_dist_loc_price"];?>;
}
.summ_pric {	/* summary event price style */
	color:<?php echo $OptionsVis["summ_pric_color"];?>; 
	font-family:<?php echo $OptionsVis["summ_pric_font"];?>; 
	font-size:<?php echo $OptionsVis["summ_pric_size"];?>;
	font-weight:<?php echo $OptionsVis["summ_pric_font_weight"];?>;
	font-style:<?php echo $OptionsVis["summ_pric_font_style"];?>;
	padding-bottom:<?php echo $OptionsVis["summ_dist_price_descr"];?>;
}

span.cat_name { /* "Read more" link style */
	font-family: <?php echo $OptionsVis["cat_font"]; ?> !important; 
	color:<?php echo $OptionsVis["cat_color"]; ?> !important; 
	font-size:<?php echo $OptionsVis["cat_font_size"]; ?> !important; 
	font-weight:<?php echo $OptionsVis["cat_font_weight"]; ?> !important; 
}
a.readmore { /* "Read more" link style */
	font-family: <?php echo $OptionsVis["more_font"]; ?> !important; 
	color:<?php echo $OptionsVis["more_color"]; ?> !important; 
	font-size:<?php echo $OptionsVis["more_font_size"]; ?> !important; 
	font-weight:<?php echo $OptionsVis["more_font_weight"]; ?> !important; 
	text-decoration:<?php echo $OptionsVis["more_text_decoration"]; ?> !important; 
}
a.readmore:hover { /* "Read more" link on hover style */
	color:<?php echo $OptionsVis["more_color_hover"]; ?> !important; 
	text-decoration:<?php echo $OptionsVis["more_text_decoration_hover"]; ?> !important; 
}
.arrow-right { /* "Read more" right arrow style */
	border-left: 4px solid <?php echo $OptionsVis["more_color"]; ?> !important; 
}
.arrow-right:hover { /* "Read more" right arrow on hover style */
	border-left: 4px solid <?php echo $OptionsVis["more_color_hover"]; ?> !important; 
}
div.dist_btw_events { /* Distance between events in the list */
	height: <?php echo $OptionsVis["dist_btw_events"];?> !important;
}
/* EVENT LIST styles end */




/* PAGINATION START HERE */
.esp_pagination .pager-esp {
	font-family: <?php echo $OptionsVis["pag_font_family"]; ?> !important;
	font-size: <?php echo $OptionsVis["pag_font_size"];?>;
	font-style: <?php echo $OptionsVis["pag_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["pag_font_weight"]; ?> !important;
	text-align: <?php echo $OptionsVis["pag_align_to"];?> !important;
}
.esp_pagination ul.pager-esp li {
	font-family: <?php echo $OptionsVis["pag_font_family"]; ?> !important;
	font-size: <?php echo $OptionsVis["pag_font_size"];?>;
	font-style: <?php echo $OptionsVis["pag_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["pag_font_weight"]; ?> !important;
}

.esp_pagination .pager-esp li > a, .esp_pagination .pager-esp li>span {
	font-family: <?php echo $OptionsVis["pag_font_family"]; ?> !important;
	font-size: <?php echo $OptionsVis["pag_font_size"];?>;
	color: <?php echo $OptionsVis["pag_font_color"];?>;
	background-color: <?php echo $OptionsVis["pag_font_color_hover"];?>;
	font-style: <?php echo $OptionsVis["pag_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["pag_font_weight"]; ?> !important;
}
.esp_pagination .pager-esp li > a:hover, .esp_pagination .pager-esp li > a:focus {
	background-color: <?php echo $OptionsVis["pag_color_prn_hover"];?>;
	font-style: <?php echo $OptionsVis["pag_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["pag_font_weight"]; ?> !important;
}

.esp_pagination .pager-esp .active span {
	color: <?php echo $OptionsVis["pag_font_color_sel"];?>;
	background: <?php echo $OptionsVis["pag_font_color_prn"];?>;
	font-style: <?php echo $OptionsVis["pag_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["pag_font_weight"]; ?> !important;
}
/* PAGINATION END HERE */




/* EVENT DETAILS page style start */
div.event_title { /* event details title style */
	color: <?php echo $OptionsVis["title_color"];?> !important;
	font-family: <?php echo $OptionsVis["title_font"];?> !important;
	font-size: <?php echo $OptionsVis["title_size"];?> !important;
	font-weight: <?php echo $OptionsVis["title_font_weight"];?> !important;
	font-style: <?php echo $OptionsVis["title_font_style"];?> !important;
	text-align: <?php echo $OptionsVis["title_text_align"];?> !important;
	line-height: <?php echo $OptionsVis["title_line_height"];?> !important;
	padding-bottom: <?php echo $OptionsVis["dist_title_date"];?> !important; 
}
div.date_style { /* event details date style */
	color: <?php echo $OptionsVis["date_color"];?> !important; 
	font-family: <?php echo $OptionsVis["date_font"];?> !important; 
	font-size: <?php echo $OptionsVis["date_size"];?> !important;
	font-style: <?php echo $OptionsVis["date_font_style"];?> !important; 
	text-align: left !important;
	padding-left: 1px !important; 
	padding-bottom: <?php echo $OptionsVis["dist_date_text"];?> !important;
}
div.date_style a { /* event details A+/a- style */
	color: <?php echo $OptionsVis["date_color"];?> !important;
	font-size: <?php echo $OptionsVis["date_size"];?> !important;
}
div.event_text { /* event text and image wrapper style */
	color: <?php echo $OptionsVis["cont_color"];?> !important;
	font-family: <?php echo $OptionsVis["cont_font"];?> !important;
	font-size: <?php echo $OptionsVis["cont_size"];?> !important;
	font-style: <?php echo $OptionsVis["cont_font_style"];?> !important;
	text-align: <?php echo $OptionsVis["cont_text_align"];?> !important;
	line-height: <?php echo $OptionsVis["cont_line_height"];?> !important;
}

.cont_edate { /* event details edate style */
	color: <?php echo $OptionsVis["edate_color"];?>; 
	font-family: <?php echo $OptionsVis["edate_font"];?>; 
	font-size: <?php echo $OptionsVis["edate_size"];?>;
	font-weight: <?php echo $OptionsVis["edate_font_weight"];?>;
	font-style: <?php echo $OptionsVis["edate_font_style"];?>;
	padding-bottom: <?php echo $OptionsVis["dist_edate_etime"];?>;
}
.cont_etime { /* event details etime style */
	color: <?php echo $OptionsVis["edate_color"];?>; 
	font-family: <?php echo $OptionsVis["edate_font"];?>; 
	font-size: <?php echo $OptionsVis["edate_size"];?>;
	font-weight: <?php echo $OptionsVis["edate_font_weight"];?>;
	font-style: <?php echo $OptionsVis["edate_font_style"];?>;
	padding-bottom: <?php echo $OptionsVis["dist_etime_loc"];?>;
}
.cont_loc {	/* event details location style */
	color:<?php echo $OptionsVis["loc_color"];?>; 
	font-family:<?php echo $OptionsVis["loc_font"];?>; 
	font-size:<?php echo $OptionsVis["loc_size"];?>;
	font-weight:<?php echo $OptionsVis["loc_font_weight"];?>;
	font-style: <?php echo $OptionsVis["loc_font_style"];?>; 
	padding-bottom: <?php echo $OptionsVis["dist_loc_price"];?>;
}
.cont_loc a.cont_loc_a { /* event details location link style */
	color: <?php echo $OptionsVis["loc_color"];?> !important;
	font-family: <?php echo $OptionsVis["loc_font"];?> !important;
	font-size: <?php echo $OptionsVis["loc_size"];?> !important;
	font-weight: <?php echo $OptionsVis["loc_font_weight"];?> !important;
	font-style: <?php echo $OptionsVis["loc_font_style"];?> !important;
}
.cont_loc a.cont_loc_a:hover { /* event details location link style on hover */
	color: <?php echo $OptionsVis["loc_color"];?> !important;
	font-family: <?php echo $OptionsVis["loc_font"];?> !important;
	font-size: <?php echo $OptionsVis["loc_size"];?> !important;
	font-weight: <?php echo $OptionsVis["loc_font_weight"];?> !important;
	font-style: <?php echo $OptionsVis["loc_font_style"];?> !important;
}
.cont_pric { /* event details price style */
	color: <?php echo $OptionsVis["pric_color"];?>; 
	font-family: <?php echo $OptionsVis["pric_font"];?>; 
	font-size: <?php echo $OptionsVis["pric_size"];?>;
	font-weight: <?php echo $OptionsVis["pric_font_weight"];?>;
	font-style: <?php echo $OptionsVis["pric_font_style"];?>;
	padding-bottom: <?php echo $OptionsVis["dist_price_descr"];?>;
}

div.event_text #content a { /* links in the events content */	
	color: <?php echo $OptionsVis["links_font_color"];?> !important;
	text-decoration: <?php echo $OptionsVis["links_text_decoration"];?> !important;
	font-size: <?php echo $OptionsVis["links_font_size"];?> !important;
	font-style: <?php echo $OptionsVis["links_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["links_font_weight"];?> !important;
}
div.event_text #content a:hover {	 /* links on mouse over in the event content */
	color: <?php echo $OptionsVis["links_font_color_hover"];?> !important;
	text-decoration: <?php echo $OptionsVis["links_text_decoration_hover"];?> !important;
	font-size: <?php echo $OptionsVis["links_font_size"];?> !important;
	font-style: <?php echo $OptionsVis["links_font_style"];?> !important;
	font-weight: <?php echo $OptionsVis["links_font_weight"];?> !important;
}
div.share_buttons { /* share buttons style */
	float:<?php echo $OptionsVis["share_this_align"];?> !important;
}
/* EVENT DETAILS page style end */



/* SUBMIT EVENT form start */
#submit_event_form { /* submit event form style */
    background-color:<?php echo $OptionsVis["subm_bkg_color"];?> !important;
}
.h1_submit_heading { /* submit event heading */
	font-family:<?php echo $OptionsVis["subm_head_font"];?> !important;
	color:<?php echo $OptionsVis["subm_head_color"];?> !important;
	font-size:<?php echo $OptionsVis["subm_head_size"];?> !important;
	font-weight:<?php echo $OptionsVis["subm_head_weight"];?> !important;
	font-style: <?php echo $OptionsVis["subm_head_style"];?> !important;
	text-align:<?php echo $OptionsVis["subm_head_align"];?> !important;
	line-height: <?php echo $OptionsVis["subm_head_height"];?> !important;
}
#esf label { /* submit event form labels */ 
	font-family:<?php echo $OptionsVis["subm_lab_font"];?>;
	color:<?php echo $OptionsVis["subm_lab_color"];?>;
	font-size:<?php echo $OptionsVis["subm_lab_size"];?>;
	font-weight:<?php echo $OptionsVis["subm_lab_weight"];?>;
	font-style: <?php echo $OptionsVis["subm_lab_style"];?>;
}

.submit_field_edate { /* submit event form edate field style */ 
	font-family:<?php echo $OptionsVis["subm_field_font"];?>;
	color:<?php echo $OptionsVis["subm_field_color"];?>;
	background-color:<?php echo $OptionsVis["subm_field_bkg_col"];?>;
	font-size:<?php echo $OptionsVis["subm_field_size"];?>;
	border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-webkit-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-moz-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	border: 1px solid <?php echo $OptionsVis["subm_field_bord_col"];?>;
	padding:<?php echo $OptionsVis["subm_field_padd"];?>;
}
.submit_field_etime { /* submit event form etime field style */ 
	font-family:<?php echo $OptionsVis["subm_field_font"];?>;
	color:<?php echo $OptionsVis["subm_field_color"];?>;
	background-color:<?php echo $OptionsVis["subm_field_bkg_col"];?>;
	font-size:<?php echo $OptionsVis["subm_field_size"];?>;
	border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-webkit-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-moz-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	border: 1px solid <?php echo $OptionsVis["subm_field_bord_col"];?>;
	padding:<?php echo $OptionsVis["subm_field_padd"];?> 2px;
}

.hide_time { /* submit event form hide end time label style */ 
	font-family:<?php echo $OptionsVis["subm_lab_font"];?>;
	color:<?php echo $OptionsVis["subm_lab_color"];?>;
	font-weight:<?php echo $OptionsVis["subm_lab_weight"];?>;
	font-style: <?php echo $OptionsVis["subm_lab_style"];?>;
}

.submit_field, #submit_event_form .phpcaptcha { /* submit event form text and phpcaptcha fields style */ 
	font-family:<?php echo $OptionsVis["subm_field_font"];?>;
	color:<?php echo $OptionsVis["subm_field_color"];?>;
	background-color:<?php echo $OptionsVis["subm_field_bkg_col"];?>;
	font-size:<?php echo $OptionsVis["subm_field_size"];?>;
	border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-webkit-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-moz-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	border: 1px solid <?php echo $OptionsVis["subm_field_bord_col"];?>;
	padding:<?php echo $OptionsVis["subm_field_padd"];?>;
}

.submit_field_categ { /* submit event form dropdown field style */  
	font-family:<?php echo $OptionsVis["subm_field_font"];?>;
	color:<?php echo $OptionsVis["subm_field_color"];?>;
	background-color:<?php echo $OptionsVis["subm_field_bkg_col"];?>;
	font-size:<?php echo $OptionsVis["subm_field_size"];?>;
	border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-webkit-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	-moz-border-radius:<?php echo $OptionsVis["subm_field_bord_rad"];?>;
	border: 1px solid <?php echo $OptionsVis["subm_field_bord_col"];?>;
	padding:<?php echo $OptionsVis["subm_field_padd"];?> 2px;
}

.required_fields { /* submit event form required fields style */ 
	font-family:<?php echo $OptionsVis["subm_lab_font"];?>;
	color:<?php echo $OptionsVis["subm_lab_color"];?>;
	font-style: <?php echo $OptionsVis["subm_lab_style"];?>;
}

.btn_esf {
	font-family: <?php echo $OptionsVis["subm_butt_font"];?> !important;
	color: <?php echo $OptionsVis["subm_butt_color"];?> !important;
	background-color: <?php echo $OptionsVis["subm_butt_bkg_col"];?> !important;
	font-size: <?php echo $OptionsVis["subm_butt_size"];?> !important;
}
.btn_esf:hover {
	color: <?php echo $OptionsVis["subm_butt_color_hov"];?> !important;
	background-color: <?php echo $OptionsVis["subm_butt_bkg_col_hov"];?> !important;	
	border-color:  <?php echo $OptionsVis["subm_butt_bkg_col_hov"];?> !important;
}
/* SUBMIT EVENT form end */

</style>