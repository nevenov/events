<?php 
namespace EventScriptPHP20;
if ( $Logged ){ ?>
	<form action="admin.php" method="post" name="form">
	<input type="hidden" name="act" value="updateOptionsVisual" />
    
    <div class="opt_headlist">Set events front-end visual style</div>
	
    <div id="accordion_container"> 
    <div class="accordion_toggle">General style</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">General font-family:</td>
        <td class="left_top">
        	<select name="gen_font_family">
                <?php echo font_family_list($OptionsVis['gen_font_family']); ?>
			</select>
        </td>
      </tr>            
      <tr>
        <td class="langLeft">General font-color:</td>
        <td class="left_top"><?php echo color_field("gen_font_color", $OptionsVis["gen_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">General font-size:</td>
        <td class="left_top">
        	<select name="gen_font_size">
            	<option value="inherit"<?php if($OptionsVis['gen_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=8; $i<=36; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>            
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['gen_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">General line-height:</td>
        <td class="left_top">
        	<select name="gen_line_height">
            	<option value="inherit"<?php if($OptionsVis['gen_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['gen_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>             
                <?php for($i = 1; $i <= 6; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['gen_line_height']=="$i") echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">General background-color:</td>
        <td class="left_top"><?php echo color_field("gen_bgr_color", $OptionsVis["gen_bgr_color"]); ?></td>
      </tr>           
      <tr>
        <td class="langLeft">General max width:</td>
        <td class="left_top"><input name="gen_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["gen_width"]); ?>" />
        <select name="gen_width_dim">
            <option value="px"<?php if($OptionsVis['gen_width_dim']=='px') echo ' selected="selected"'; ?>>px</option>
            <option value="%"<?php if($OptionsVis['gen_width_dim']=='%') echo ' selected="selected"'; ?>>%</option>
            <option value="pt"<?php if($OptionsVis['gen_width_dim']=='pt') echo ' selected="selected"'; ?>>pt</option>
            <option value="em"<?php if($OptionsVis['gen_width_dim']=='em') echo ' selected="selected"'; ?>>em</option>
        </select> 
        &nbsp; <sub> - leave blank if you don't want fixed width</sub>
        </td>
      </tr>  
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>   
    </table> 
    </div> 
    
    
    
    <div class="accordion_toggle">Main menu links style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="link_font">
            	<?php echo font_family_list($OptionsVis['link_font']); ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Font-color:</td>
        <td class="left_top"><?php echo color_field("link_color", $OptionsVis["link_color"]); ?></td>
      </tr> 
      <tr>
        <td class="langLeft">Font-color on hover(on mouse over):</td>
        <td class="left_top"><?php echo color_field("link_color_hover", $OptionsVis["link_color_hover"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Background:</td>
        <td class="left_top"><?php echo color_field("main_menu_bgr", $OptionsVis["main_menu_bgr"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="link_font_size">
            	<option value="inherit"<?php if($OptionsVis['link_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['link_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>    
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['link_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="link_font_weight">
            	<option value="normal"<?php if($OptionsVis['link_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['link_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['link_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="link_text_decoration">
            	<option value="none"<?php if($OptionsVis['link_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['link_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['link_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration on hover (on mouseover):</td>
        <td class="left_top">
        	<select name="link_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['link_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['link_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['link_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>             
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Category drop-down style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("cat_dd_color", $OptionsVis["cat_dd_color"]); ?></td>
      </tr>         
      <tr>
        <td class="langLeft">Background color:</td>
        <td class="left_top"><?php echo color_field("cat_dd_bgr_color", $OptionsVis["cat_dd_bgr_color"]); ?></td>
      </tr>               
      <tr>
        <td class="langLeft">Background color on mouseover(on hover):</td>
        <td class="left_top"><?php echo color_field("cat_dd_bgr_color_hover", $OptionsVis["cat_dd_bgr_color_hover"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="cat_dd_family">
            	<?php echo font_family_list($OptionsVis['cat_dd_family']); ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="cat_dd_font_size">
            	<option value="inherit"<?php if($OptionsVis['cat_dd_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cat_dd_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cat_dd_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="cat_dd_font_style">
            	<option value="normal"<?php if($OptionsVis['cat_dd_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['cat_dd_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['cat_dd_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['cat_dd_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="cat_dd_font_weight">
            	<option value="normal"<?php if($OptionsVis['cat_dd_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['cat_dd_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['cat_dd_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="cat_dd_align">
            	<option value="center"<?php if($OptionsVis['cat_dd_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['cat_dd_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['cat_dd_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['cat_dd_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['cat_dd_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>          
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
      <tr>
        <td colspan="3" height="8"></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Events list Title style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top">
        	<select name="summ_title_font">
				<?php echo font_family_list($OptionsVis['summ_title_font']); ?>
			</select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Title color:</td>
        <td class="left_top"><?php echo color_field("summ_title_color", $OptionsVis["summ_title_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Title color on hover(on mouseover):</td>
        <td class="left_top"><?php echo color_field("summ_title_color_hover", $OptionsVis["summ_title_color_hover"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Title font-size:</td>
        <td class="left_top">
        	<select name="summ_title_size">
            	<option value="inherit"<?php if($OptionsVis['summ_title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>            	
				<?php for($i=9; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_title_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-weight:</td>
        <td class="left_top">
        	<select name="summ_title_font_weight">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['summ_title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-style:</td>
        <td class="left_top">
        	<select name="summ_title_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title text-align:</td>
        <td class="left_top">
        	<select name="summ_title_text_align">
            	<option value="center"<?php if($OptionsVis['summ_title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['summ_title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['summ_title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['summ_title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>     
      <tr>
        <td class="langLeft">Title line-height:</td>
        <td class="left_top">
        	<select name="summ_title_line_height">
                <option value="inherit"<?php if($OptionsVis['summ_title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 1; $i <= 8; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_title_line_height']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="summ_title_decor">
            	<option value="none"<?php if($OptionsVis['summ_title_decor']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['summ_title_decor']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_decor']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration(on mouseover):</td>
        <td class="left_top">
        	<select name="summ_title_decor_hover">
            	<option value="none"<?php if($OptionsVis['summ_title_decor_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['summ_title_decor_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['summ_title_decor_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div> 
    
    
    
    <div class="accordion_toggle">Events list Date/Time style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Date font-family:</td>
        <td class="left_top">
        	<select name="summ_edate_font">
            	<?php echo font_family_list($OptionsVis['summ_edate_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date color:</td>
        <td class="left_top"><?php echo color_field("summ_edate_color", $OptionsVis["summ_edate_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Date font-size:</td>
        <td class="left_top">
        	<select name="summ_edate_size">
            	<option value="inherit"<?php if($OptionsVis['summ_edate_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_edate_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>           
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_edate_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-style:</td>
        <td class="left_top">
        	<select name="summ_edate_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_edate_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_edate_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_edate_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_edate_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">            	
            <select name="summ_edate_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['summ_edate_format']=='l - F j, Y') echo ' selected="selected"'; ?>><?php echo date("l - F j, Y"); ?></option>
                <option value="l - F j Y"<?php if($OptionsVis['summ_edate_format']=='l - F j Y') echo ' selected="selected"'; ?>><?php echo date("l - F j Y"); ?></option>
                <option value="l, F j Y"<?php if($OptionsVis['summ_edate_format']=='l, F j Y') echo ' selected="selected"'; ?>><?php echo date("l, F j Y"); ?></option>
            	<option value="l, F j, Y"<?php if($OptionsVis['summ_edate_format']=='l, F j, Y') echo ' selected="selected"'; ?>><?php echo date("l, F j, Y"); ?></option>
            	<option value="l, F j"<?php if($OptionsVis['summ_edate_format']=='l, F j') echo ' selected="selected"'; ?>><?php echo date("l, F j"); ?></option>
                <option value="l F j Y"<?php if($OptionsVis['summ_edate_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j Y"); ?></option>
                <option value="l F j, Y"<?php if($OptionsVis['summ_edate_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j, Y"); ?></option>
                <option value="F j Y"<?php if($OptionsVis['summ_edate_format']=='F j Y') echo ' selected="selected"'; ?>><?php echo date("F j Y"); ?></option>
                <option value="F j, Y"<?php if($OptionsVis['summ_edate_format']=='F j, Y') echo ' selected="selected"'; ?>><?php echo date("F j, Y"); ?></option>
                <option value="F jS, Y"<?php if($OptionsVis['summ_edate_format']=='F jS, Y') echo ' selected="selected"'; ?>><?php echo date("F jS, Y"); ?></option>
                <option value="F Y"<?php if($OptionsVis['summ_edate_format']=='F Y') echo ' selected="selected"'; ?>><?php echo date("F Y"); ?></option>
                <option value="m-d-Y"<?php if($OptionsVis['summ_edate_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['summ_edate_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['summ_edate_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['summ_edate_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['summ_edate_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['summ_edate_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['summ_edate_format']=='l - j F, Y') echo ' selected="selected"'; ?>><?php echo date("l - j F, Y"); ?></option>
                <option value="l - j F Y"<?php if($OptionsVis['summ_edate_format']=='l - j F Y') echo ' selected="selected"'; ?>><?php echo date("l - j F Y"); ?></option>
                <option value="l, j F Y"<?php if($OptionsVis['summ_edate_format']=='l, j F Y') echo ' selected="selected"'; ?>><?php echo date("l, j F Y"); ?></option>
                <option value="l, j F, Y"<?php if($OptionsVis['summ_edate_format']=='l, j F, Y') echo ' selected="selected"'; ?>><?php echo date("l, j F, Y"); ?></option>
                <option value="l j F Y"<?php if($OptionsVis['summ_edate_format']=='l j F Y') echo ' selected="selected"'; ?>><?php echo date("l j F Y"); ?></option>
                <option value="l j F, Y"<?php if($OptionsVis['summ_edate_format']=='l j F, Y') echo ' selected="selected"'; ?>><?php echo date("l j F, Y"); ?></option>
                <option value="d F Y"<?php if($OptionsVis['summ_edate_format']=='d F Y') echo ' selected="selected"'; ?>><?php echo date("d F Y"); ?></option>
                <option value="d F, Y"<?php if($OptionsVis['summ_edate_format']=='d F, Y') echo ' selected="selected"'; ?>><?php echo date("d F, Y"); ?></option>
                <option value="d-m-Y"<?php if($OptionsVis['summ_edate_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['summ_edate_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['summ_edate_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['summ_edate_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['summ_edate_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['summ_edate_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Showing the time:</td>
        <td class="left_top">
        	<select name="summ_eshowing_time">
            	<option value=""<?php if($OptionsVis['summ_eshowing_time']=='') echo ' selected="selected"'; ?>>without time</option>
            	<option value="G:i"<?php if($OptionsVis['summ_eshowing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['summ_eshowing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">Events list Location style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="summ_loc_font">
            	<?php echo font_family_list($OptionsVis['summ_loc_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("summ_loc_color", $OptionsVis["summ_loc_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="summ_loc_size">
            	<option value="inherit"<?php if($OptionsVis['summ_loc_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_loc_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>          
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_loc_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="summ_loc_font_weight">
            	<option value="normal"<?php if($OptionsVis['summ_loc_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['summ_loc_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['summ_loc_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="summ_loc_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_loc_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_loc_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_loc_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_loc_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>    
    
    
    <div class="accordion_toggle">Events list Price style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="summ_pric_font">
            	<?php echo font_family_list($OptionsVis['summ_pric_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("summ_pric_color", $OptionsVis["summ_pric_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="summ_pric_size">
            	<option value="inherit"<?php if($OptionsVis['summ_pric_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_pric_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_pric_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="summ_pric_font_weight">
            	<option value="normal"<?php if($OptionsVis['summ_pric_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['summ_pric_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['summ_pric_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="summ_pric_font_style">
            	<option value="normal"<?php if($OptionsVis['summ_pric_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['summ_pric_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['summ_pric_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['summ_pric_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
        
      
    
    <div class="accordion_toggle">Events list Image style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">     
      <tr>
        <td class="langLeft">Events list image width(%):</td>
        <td class="left_top">
        	<select name="summ_img_width">
                <?php for($i=33; $i<=55; $i++) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['summ_img_width']==$i) echo ' selected="selected"'; ?>><?php echo $i;?>%</option>
                <?php } ?>
            </select>
        
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Events list image aspect ratio(proportion):</td>
        <td class="left_top">
        	<select name="summ_img_propor">
            	<option value="0.5625"<?php if($OptionsVis['summ_img_propor']=='0.5625') echo ' selected="selected"'; ?>>16:9</option>
            	<option value="0.625"<?php if($OptionsVis['summ_img_propor']=='0.625') echo ' selected="selected"'; ?>>16:10</option>
            	<option value="0.75"<?php if($OptionsVis['summ_img_propor']=='0.75') echo ' selected="selected"'; ?>>4:3</option>
                <option value="1"<?php if($OptionsVis['summ_img_propor']=='1') echo ' selected="selected"'; ?>>square</option>
            </select>
        </td>
      </tr>  
        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit5" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>   
    
    <div class="accordion_toggle">Events list category name style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top">
        	<select name="cat_font">
            	<?php echo font_family_list($OptionsVis['cat_font']); ?>
            </select>
        </td>
      </tr>       
      <tr>
        <td class="langLeft">Font-color:</td>
        <td class="left_top"><?php echo color_field("cat_color", $OptionsVis["cat_color"]); ?></td>
      </tr> 
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="cat_font_size">
            	<option value="inherit"<?php if($OptionsVis['cat_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cat_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cat_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="cat_font_weight">
            	<option value="normal"<?php if($OptionsVis['cat_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['cat_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['cat_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>  
       
    
    <div class="accordion_toggle">Events list 'Read more' link style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top">
        	<select name="more_font">
            	<?php echo font_family_list($OptionsVis['more_font']); ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Font-color:</td>
        <td class="left_top"><?php echo color_field("more_color", $OptionsVis["more_color"]); ?></td>
      </tr> 
      <tr>
        <td class="langLeft">Color on hover(on mouse over):</td>
        <td class="left_top"><?php echo color_field("more_color_hover", $OptionsVis["more_color_hover"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="more_font_size">
            	<option value="inherit"<?php if($OptionsVis['more_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['more_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['more_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="more_font_weight">
            	<option value="normal"<?php if($OptionsVis['more_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['more_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['more_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="more_text_decoration">
            	<option value="none"<?php if($OptionsVis['more_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['more_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['more_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration on hover (on mouseover):</td>
        <td class="left_top">
        	<select name="more_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['more_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['more_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['more_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit8" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>  
    
    
    
    <div class="accordion_toggle">Pagination style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Pagination Font-family:</td>
        <td class="left_top">
        	<select name="pag_font_family">
            	<?php echo font_family_list($OptionsVis['pag_font_family']); ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Pages font color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color", $OptionsVis["pag_font_color"]); ?></td>
      </tr>   
      <tr>
        <td class="langLeft">Pages background color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color_hover", $OptionsVis["pag_font_color_hover"]); ?></td>
      </tr>        
      <tr>
        <td class="langLeft">Selected page font color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color_sel", $OptionsVis["pag_font_color_sel"]); ?></td>
      </tr>        
      <tr>
        <td class="langLeft">Selected page background color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color_prn", $OptionsVis["pag_font_color_prn"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Background color on hover(active):</td>
        <td class="left_top"><?php echo color_field("pag_color_prn_hover", $OptionsVis["pag_color_prn_hover"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Inactive Previous/Next button font color:</td>
        <td class="left_top"><?php echo color_field("pag_font_color_ina", $OptionsVis["pag_font_color_ina"]); ?></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination font-size:</td>
        <td class="left_top">
        	<select name="pag_font_size">
            	<option value="inherit"<?php if($OptionsVis['pag_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i = 0.5; $i <= 3; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['pag_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
                <?php for($i=9; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['pag_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Pagination font-style:</td>
        <td class="left_top">
        	<select name="pag_font_style">
            	<option value="normal"<?php if($OptionsVis['pag_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['pag_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Pagination font-weight:</td>
        <td class="left_top">
        	<select name="pag_font_weight">
            	<option value="normal"<?php if($OptionsVis['pag_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['pag_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['pag_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Align to:</td>
        <td  class="left_top">
        	<select name="pag_align_to">
            	<option value="left"<?php if($OptionsVis['pag_align_to']=='left') echo ' selected="selected"'; ?>>left</option>
            	<option value="center"<?php if($OptionsVis['pag_align_to']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="right"<?php if($OptionsVis['pag_align_to']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>  
	</table>
    </div>
      
    
    
    <div class="accordion_toggle">Event title style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Title font-family:</td>
        <td class="left_top">
        	<select name="title_font">
            	<?php echo font_family_list($OptionsVis['title_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Title color:</td>
        <td class="left_top"><?php echo color_field("title_color", $OptionsVis["title_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Title font-size:</td>
        <td class="left_top">
        	<select name="title_size">
            	<option value="inherit"<?php if($OptionsVis['title_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>         
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['title_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-weight:</td>
        <td class="left_top">
        	<select name="title_font_weight">
            	<option value="normal"<?php if($OptionsVis['title_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['title_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['title_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title font-style:</td>
        <td class="left_top">
        	<select name="title_font_style">
            	<option value="normal"<?php if($OptionsVis['title_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['title_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['title_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['title_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Title text-align:</td>
        <td class="left_top">
        	<select name="title_text_align">
            	<option value="center"<?php if($OptionsVis['title_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['title_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['title_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['title_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['title_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Title line-height:</td>
        <td class="left_top">
        	<select name="title_line_height">
                <option value="inherit"<?php if($OptionsVis['title_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['title_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>        
                <?php for($i = 1; $i <= 8; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['title_line_height']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>
    
    
    <div class="accordion_toggle">Event Publish Date, Show/hide Textsizer A+/a- and Article Hits styles</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Show A+/a-:</td>
        <td class="left_top">
        	<select name="show_aa">
            	<option value="yes"<?php if($OptionsVis['show_aa']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_aa']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>        
      <tr>
        <td class="langLeft">Show Article Hits:</td>
        <td class="left_top">
        	<select name="showhits">
            	<option value="yes"<?php if($OptionsVis['showhits']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['showhits']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Show the date:</td>
        <td class="left_top">
        	<select name="show_date">
            	<option value="yes"<?php if($OptionsVis['show_date']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_date']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>
	  <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("date_color", $OptionsVis["date_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="date_font">
            	<?php echo font_family_list($OptionsVis['date_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="date_size">
            	<option value="inherit"<?php if($OptionsVis['date_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=30; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['date_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>        
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['date_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="date_font_weight">
            	<option value="normal"<?php if($OptionsVis['date_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['date_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['date_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="date_font_style">
            	<option value="normal"<?php if($OptionsVis['date_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['date_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['date_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['date_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">
        	<select name="date_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['date_format']=='l - F j, Y') echo ' selected="selected"'; ?>><?php echo date("l - F j, Y"); ?></option>
                <option value="l - F j Y"<?php if($OptionsVis['date_format']=='l - F j Y') echo ' selected="selected"'; ?>><?php echo date("l - F j Y"); ?></option>
                <option value="l, F j Y"<?php if($OptionsVis['date_format']=='l, F j Y') echo ' selected="selected"'; ?>><?php echo date("l, F j Y"); ?></option>
            	<option value="l, F j, Y"<?php if($OptionsVis['date_format']=='l, F j, Y') echo ' selected="selected"'; ?>><?php echo date("l, F j, Y"); ?></option>
                <option value="l F j Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j Y"); ?></option>
                <option value="l F j, Y"<?php if($OptionsVis['date_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j, Y"); ?></option>
                <option value="F j Y"<?php if($OptionsVis['date_format']=='F j Y') echo ' selected="selected"'; ?>><?php echo date("F j Y"); ?></option>
                <option value="F j, Y"<?php if($OptionsVis['date_format']=='F j, Y') echo ' selected="selected"'; ?>><?php echo date("F j, Y"); ?></option>
                <option value="F jS, Y"<?php if($OptionsVis['date_format']=='F jS, Y') echo ' selected="selected"'; ?>><?php echo date("F jS, Y"); ?></option>
                <option value="F Y"<?php if($OptionsVis['date_format']=='F Y') echo ' selected="selected"'; ?>><?php echo date("F Y"); ?></option>
                <option value="m-d-Y"<?php if($OptionsVis['date_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['date_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['date_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['date_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['date_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['date_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['date_format']=='l - j F, Y') echo ' selected="selected"'; ?>><?php echo date("l - j F, Y"); ?></option>
                <option value="l - j F Y"<?php if($OptionsVis['date_format']=='l - j F Y') echo ' selected="selected"'; ?>><?php echo date("l - j F Y"); ?></option>
                <option value="l, j F Y"<?php if($OptionsVis['date_format']=='l, j F Y') echo ' selected="selected"'; ?>><?php echo date("l, j F Y"); ?></option>
                <option value="l, j F, Y"<?php if($OptionsVis['date_format']=='l, j F, Y') echo ' selected="selected"'; ?>><?php echo date("l, j F, Y"); ?></option>
                <option value="l j F Y"<?php if($OptionsVis['date_format']=='l j F Y') echo ' selected="selected"'; ?>><?php echo date("l j F Y"); ?></option>
                <option value="l j F, Y"<?php if($OptionsVis['date_format']=='l j F, Y') echo ' selected="selected"'; ?>><?php echo date("l j F, Y"); ?></option>
                <option value="d F Y"<?php if($OptionsVis['date_format']=='d F Y') echo ' selected="selected"'; ?>><?php echo date("d F Y"); ?></option>
                <option value="d F, Y"<?php if($OptionsVis['date_format']=='d F, Y') echo ' selected="selected"'; ?>><?php echo date("d F, Y"); ?></option>
                <option value="d-m-Y"<?php if($OptionsVis['date_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['date_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['date_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['date_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['date_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['date_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Time Format:</td>
        <td class="left_top">
        	<select name="showing_time">
            	<option value="G:i"<?php if($OptionsVis['showing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['showing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="show_text_align">
            	<option value="center"<?php if($OptionsVis['show_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="left"<?php if($OptionsVis['show_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['show_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['show_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
    
    <div class="accordion_toggle">Event Date/Time style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Date color:</td>
        <td class="left_top"><?php echo color_field("edate_color", $OptionsVis["edate_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Date font-family:</td>
        <td class="left_top">
        	<select name="edate_font">
            	<?php echo font_family_list($OptionsVis['edate_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-size:</td>
        <td class="left_top">
        	<select name="edate_size">
            	<option value="inherit"<?php if($OptionsVis['edate_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['edate_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>        
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['edate_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-weight:</td>
        <td class="left_top">
        	<select name="edate_font_weight">
            	<option value="normal"<?php if($OptionsVis['edate_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['edate_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['edate_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date font-style:</td>
        <td class="left_top">
        	<select name="edate_font_style">
            	<option value="normal"<?php if($OptionsVis['edate_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['edate_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['edate_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['edate_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Date format:</td>
        <td class="left_top">
        	<select name="edate_format">
            	<option value="l - F j, Y"<?php if($OptionsVis['edate_format']=='l - F j, Y') echo ' selected="selected"'; ?>><?php echo date("l - F j, Y"); ?></option>
                <option value="l - F j Y"<?php if($OptionsVis['edate_format']=='l - F j Y') echo ' selected="selected"'; ?>><?php echo date("l - F j Y"); ?></option>
                <option value="l, F j Y"<?php if($OptionsVis['edate_format']=='l, F j Y') echo ' selected="selected"'; ?>><?php echo date("l, F j Y"); ?></option>
            	<option value="l, F j, Y"<?php if($OptionsVis['edate_format']=='l, F j, Y') echo ' selected="selected"'; ?>><?php echo date("l, F j, Y"); ?></option>
                <option value="l F j Y"<?php if($OptionsVis['edate_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j Y"); ?></option>
                <option value="l F j, Y"<?php if($OptionsVis['edate_format']=='l F j Y') echo ' selected="selected"'; ?>><?php echo date("l F j, Y"); ?></option>
                <option value="F j Y"<?php if($OptionsVis['edate_format']=='F j Y') echo ' selected="selected"'; ?>><?php echo date("F j Y"); ?></option>
                <option value="F j, Y"<?php if($OptionsVis['edate_format']=='F j, Y') echo ' selected="selected"'; ?>><?php echo date("F j, Y"); ?></option>
                <option value="F jS, Y"<?php if($OptionsVis['edate_format']=='F jS, Y') echo ' selected="selected"'; ?>><?php echo date("F jS, Y"); ?></option>
                <option value="F Y"<?php if($OptionsVis['edate_format']=='F Y') echo ' selected="selected"'; ?>><?php echo date("F Y"); ?></option>
                <option value="m-d-Y"<?php if($OptionsVis['edate_format']=='m-d-Y') echo ' selected="selected"'; ?>>MM-DD-YYYY</option>
                <option value="m.d.Y"<?php if($OptionsVis['edate_format']=='m.d.Y') echo ' selected="selected"'; ?>>MM.DD.YYYY</option>
                <option value="m/d/Y"<?php if($OptionsVis['edate_format']=='m/d/Y') echo ' selected="selected"'; ?>>MM/DD/YYYY</option>
                <option value="m-d-y"<?php if($OptionsVis['edate_format']=='m-d-y') echo ' selected="selected"'; ?>>MM-DD-YY</option>
                <option value="m.d.y"<?php if($OptionsVis['edate_format']=='m.d.y') echo ' selected="selected"'; ?>>MM.DD.YY</option>
                <option value="m/d/y"<?php if($OptionsVis['edate_format']=='m/d/y') echo ' selected="selected"'; ?>>MM/DD/YY</option>
                <option value="l - j F, Y"<?php if($OptionsVis['edate_format']=='l - j F, Y') echo ' selected="selected"'; ?>><?php echo date("l - j F, Y"); ?></option>
                <option value="l - j F Y"<?php if($OptionsVis['edate_format']=='l - j F Y') echo ' selected="selected"'; ?>><?php echo date("l - j F Y"); ?></option>
                <option value="l, j F Y"<?php if($OptionsVis['edate_format']=='l, j F Y') echo ' selected="selected"'; ?>><?php echo date("l, j F Y"); ?></option>
                <option value="l, j F, Y"<?php if($OptionsVis['edate_format']=='l, j F, Y') echo ' selected="selected"'; ?>><?php echo date("l, j F, Y"); ?></option>
                <option value="l j F Y"<?php if($OptionsVis['edate_format']=='l j F Y') echo ' selected="selected"'; ?>><?php echo date("l j F Y"); ?></option>
                <option value="l j F, Y"<?php if($OptionsVis['edate_format']=='l j F, Y') echo ' selected="selected"'; ?>><?php echo date("l j F, Y"); ?></option>
                <option value="d F Y"<?php if($OptionsVis['edate_format']=='d F Y') echo ' selected="selected"'; ?>><?php echo date("d F Y"); ?></option>
                <option value="d F, Y"<?php if($OptionsVis['edate_format']=='d F, Y') echo ' selected="selected"'; ?>><?php echo date("d F, Y"); ?></option>
                <option value="d-m-Y"<?php if($OptionsVis['edate_format']=='d-m-Y') echo ' selected="selected"'; ?>>DD-MM-YYYY</option>
                <option value="d.m.Y"<?php if($OptionsVis['edate_format']=='d.m.Y') echo ' selected="selected"'; ?>>DD.MM.YYYY</option>
                <option value="d/m/Y"<?php if($OptionsVis['edate_format']=='d/m/Y') echo ' selected="selected"'; ?>>DD/MM/YYYY</option>
                <option value="d-m-y"<?php if($OptionsVis['edate_format']=='d-m-y') echo ' selected="selected"'; ?>>DD-MM-YY</option>
                <option value="d.m.y"<?php if($OptionsVis['edate_format']=='d.m.y') echo ' selected="selected"'; ?>>DD.MM.YY</option>
                <option value="d/m/y"<?php if($OptionsVis['edate_format']=='d/m/y') echo ' selected="selected"'; ?>>DD/MM/YY</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Show event time in the event full description:</td>
        <td class="left_top">
        	<select name="eshowhide_time">
            	<option value="yes"<?php if($OptionsVis['eshowhide_time']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['eshowhide_time']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Time Format (in full description and submit form):</td>
        <td class="left_top">
        	<select name="eshowing_time">
            	<option value="G:i"<?php if($OptionsVis['eshowing_time']=='G:i') echo ' selected="selected"'; ?>>24h format</option>
            	<option value="g:i a"<?php if($OptionsVis['eshowing_time']=='g:i a') echo ' selected="selected"'; ?>>12h format</option>
            </select>
        </td>
      </tr>        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>  
    
    
    
    <div class="accordion_toggle">Event Location style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="loc_font">
            	<?php echo font_family_list($OptionsVis['loc_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("loc_color", $OptionsVis["loc_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="loc_size">
            	<option value="inherit"<?php if($OptionsVis['loc_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['loc_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>        
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['loc_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="loc_font_weight">
            	<option value="normal"<?php if($OptionsVis['loc_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['loc_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['loc_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="loc_font_style">
            	<option value="normal"<?php if($OptionsVis['loc_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['loc_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['loc_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['loc_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
    
    
    <div class="accordion_toggle">Event Price style</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="pric_font">
            	<?php echo font_family_list($OptionsVis['pric_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("pric_color", $OptionsVis["pric_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="pric_size">
            	<option value="inherit"<?php if($OptionsVis['pric_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['pric_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>       
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['pric_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="pric_font_weight">
            	<option value="normal"<?php if($OptionsVis['pric_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['pric_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['pric_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="pric_font_style">
            	<option value="normal"<?php if($OptionsVis['pric_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['pric_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['pric_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['pric_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit3" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
    
      
      
    <div class="accordion_toggle">Event Description style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="cont_font">
            	<?php echo font_family_list($OptionsVis['cont_font']); ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("cont_color", $OptionsVis["cont_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="cont_size">
            	<option value="inherit"<?php if($OptionsVis['cont_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cont_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>       
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cont_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="cont_font_style">
            	<option value="normal"<?php if($OptionsVis['cont_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['cont_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['cont_font_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['cont_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="cont_text_align">
            	<option value="center"<?php if($OptionsVis['cont_text_align']=='center') echo ' selected="selected"'; ?>>center</option>
            	<option value="justify"<?php if($OptionsVis['cont_text_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="left"<?php if($OptionsVis['cont_text_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['cont_text_align']=='right') echo ' selected="selected"'; ?>>right</option>
                <option value="inherit"<?php if($OptionsVis['cont_text_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="cont_line_height">
            	<option value="inherit"<?php if($OptionsVis['cont_line_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=12; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['cont_line_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>       
                <?php for($i = 1; $i <= 8; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['cont_line_height']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Image viewer max-width:</td>
        <td class="left_top"><input name="viewer_width" type="text" size="4" value="<?php echo ReadDB($OptionsVis["viewer_width"]); ?>" />px</td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit4" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table>
    </div>
        
    
    <div class="accordion_toggle">Event links style in the description</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font color:</td>
        <td class="left_top"><?php echo color_field("links_font_color", $OptionsVis["links_font_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Color on hover(on mouseover):</td>
        <td class="left_top"><?php echo color_field("links_font_color_hover", $OptionsVis["links_font_color_hover"]); ?></td>
      </tr>   
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="links_font_size">
            	<option value="inherit"<?php if($OptionsVis['links_font_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['links_font_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>     
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['links_font_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Text-decoration:</td>
        <td class="left_top">
        	<select name="links_text_decoration">
            	<option value="none"<?php if($OptionsVis['links_text_decoration']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-decoration(on mouseover):</td>
        <td class="left_top">
        	<select name="links_text_decoration_hover">
            	<option value="none"<?php if($OptionsVis['links_text_decoration_hover']=='none') echo ' selected="selected"'; ?>>none</option>
            	<option value="underline"<?php if($OptionsVis['links_text_decoration_hover']=='underline') echo ' selected="selected"'; ?>>underline</option>
                <option value="inherit"<?php if($OptionsVis['links_text_decoration_hover']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="links_font_style">
            	<option value="normal"<?php if($OptionsVis['links_font_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['links_font_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="inherit"<?php if($OptionsVis['links_font_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="links_font_weight">
            	<option value="normal"<?php if($OptionsVis['links_font_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['links_font_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['links_font_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit7" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
    
    
    <div class="accordion_toggle">Share buttons below the event description</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">    
      <tr>
        <td class="langLeft">Show Share buttons:</td>
        <td class="left_top">
        	<select name="show_share_this">
            	<option value="yes"<?php if($OptionsVis['show_share_this']=='yes') echo ' selected="selected"'; ?>>yes</option>
            	<option value="no"<?php if($OptionsVis['show_share_this']=='no') echo ' selected="selected"'; ?>>no</option>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Share buttons alignment:</td>
        <td class="left_top">
        	<select name="share_this_align">
            	<option value="left"<?php if($OptionsVis['share_this_align']=='left') echo ' selected="selected"'; ?>>left</option>
                <option value="right"<?php if($OptionsVis['share_this_align']=='right') echo ' selected="selected"'; ?>>right</option>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Share buttons font-size:</td>
        <td class="left_top">
        	<select name="share_font_size">
                <?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['share_font_size']==$i) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>  
            </select>
        </td>
      </tr>        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit9" type="submit" value="Save" class="submitButton" /></td>
      </tr>
	</table>
    </div>
    
    
    
    <div class="accordion_toggle">Submit Event Form style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Form Background-color:</td>
        <td class="left_top"><?php echo color_field("subm_bkg_color", $OptionsVis["subm_bkg_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Form Labels Font-family:</td>
        <td class="left_top">
        	<select name="subm_lab_font">
            	<?php echo font_family_list($OptionsVis['subm_lab_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Form Labels Color:</td>
        <td class="left_top"><?php echo color_field("subm_lab_color", $OptionsVis["subm_lab_color"]); ?></td>
      </tr>      
      <tr>
        <td class="langLeft">Form Labels Font-size:</td>
        <td class="left_top">
        	<select name="subm_lab_size">
            	<option value="inherit"<?php if($OptionsVis['subm_lab_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_lab_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>    
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['subm_lab_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Form Labels Font-weight:</td>
        <td class="left_top">
        	<select name="subm_lab_weight">
            	<option value="normal"<?php if($OptionsVis['subm_lab_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['subm_lab_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <?php for($i=100; $i<=900; $i+=100) {?>
            	<option value="<?php echo $i;?>"<?php if($OptionsVis['subm_lab_weight']==$i) echo ' selected="selected"'; ?>><?php echo $i;?></option>
                <?php } ?>
                <option value="inherit"<?php if($OptionsVis['subm_lab_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Form Labels Font-style:</td>
        <td class="left_top">
        	<select name="subm_lab_style">
            	<option value="normal"<?php if($OptionsVis['subm_lab_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['subm_lab_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['subm_lab_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['subm_lab_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit19" type="submit" value="Save" class="submitButton" /></td>
      </tr>    
    </table>
    </div>
    
    
    <div class="accordion_toggle">Submit Event Form Fields style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="subm_field_font">
            	<?php echo font_family_list($OptionsVis['subm_field_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("subm_field_color", $OptionsVis["subm_field_color"]); ?></td>
      </tr>    
      <tr>
        <td class="langLeft">Background-color:</td>
        <td class="left_top"><?php echo color_field("subm_field_bkg_col", $OptionsVis["subm_field_bkg_col"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="subm_field_size">
            	<option value="inherit"<?php if($OptionsVis['subm_field_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_field_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>  
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['subm_field_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Border-radius:</td>
        <td class="left_top">
        	<select name="subm_field_bord_rad">
                <?php for($i=0; $i<=10; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_field_bord_rad']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Border-color:</td>
        <td class="left_top"><?php echo color_field("subm_field_bord_col", $OptionsVis["subm_field_bord_col"]); ?></td>
      </tr>   
      <tr>
        <td class="langLeft">Fields-padding:</td>
        <td class="left_top">
        	<select name="subm_field_padd">
                <?php for($i=0; $i<=20; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_field_padd']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
            </select>
        </td>
      </tr>        
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit20" type="submit" value="Save" class="submitButton" /></td>
      </tr>    
    </table>
    </div>
    
    
    <div class="accordion_toggle">Submit Event Heading style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="subm_head_font">
            	<?php echo font_family_list($OptionsVis['subm_head_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("subm_head_color", $OptionsVis["subm_head_color"]); ?></td>
      </tr>
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="subm_head_size">
            	<option value="inherit"<?php if($OptionsVis['subm_head_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=40; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_head_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['subm_head_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-weight:</td>
        <td class="left_top">
        	<select name="subm_head_weight">
            	<option value="normal"<?php if($OptionsVis['subm_head_weight']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="bold"<?php if($OptionsVis['subm_head_weight']=='bold') echo ' selected="selected"'; ?>>bold</option>
                <option value="inherit"<?php if($OptionsVis['subm_head_weight']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Font-style:</td>
        <td class="left_top">
        	<select name="subm_head_style">
            	<option value="normal"<?php if($OptionsVis['subm_head_style']=='normal') echo ' selected="selected"'; ?>>normal</option>
            	<option value="italic"<?php if($OptionsVis['subm_head_style']=='italic') echo ' selected="selected"'; ?>>italic</option>
                <option value="oblique"<?php if($OptionsVis['subm_head_style']=='oblique') echo ' selected="selected"'; ?>>oblique</option>
                <option value="inherit"<?php if($OptionsVis['subm_head_style']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>
      <tr>
        <td class="langLeft">Text-align:</td>
        <td class="left_top">
        	<select name="subm_head_align">
            	<option value="center"<?php if($OptionsVis['subm_head_align']=='center') echo ' selected="selected"'; ?>>center</option>
                <option value="left"<?php if($OptionsVis['subm_head_align']=='left') echo ' selected="selected"'; ?>>left</option>
				<option value="right"<?php if($OptionsVis['subm_head_align']=='right') echo ' selected="selected"'; ?>>right</option>
            	<option value="justify"<?php if($OptionsVis['subm_head_align']=='justify') echo ' selected="selected"'; ?>>justify</option>
                <option value="inherit"<?php if($OptionsVis['subm_head_align']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Line-height:</td>
        <td class="left_top">
        	<select name="subm_head_height">
                <option value="inherit"<?php if($OptionsVis['subm_head_height']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
                <?php for($i=10; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_head_height']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 1; $i <= 8; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['subm_head_height']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table>
    </div>
    
    
    <div class="accordion_toggle">Submit Event form button style</div>
    <div class="accordion_content">   
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">Font-family:</td>
        <td class="left_top">
        	<select name="subm_butt_font">
            	<?php echo font_family_list($OptionsVis['subm_butt_font']); ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Color:</td>
        <td class="left_top"><?php echo color_field("subm_butt_color", $OptionsVis["subm_butt_color"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Color on mouseover(hover):</td>
        <td class="left_top"><?php echo color_field("subm_butt_color_hov", $OptionsVis["subm_butt_color_hov"]); ?></td>
      </tr>    
      <tr>
        <td class="langLeft">Background-color:</td>
        <td class="left_top"><?php echo color_field("subm_butt_bkg_col", $OptionsVis["subm_butt_bkg_col"]); ?></td>
      </tr>     
      <tr>
        <td class="langLeft">Background-color on mouseover(hover):</td>
        <td class="left_top"><?php echo color_field("subm_butt_bkg_col_hov", $OptionsVis["subm_butt_bkg_col_hov"]); ?></td>
      </tr>  
      <tr>
        <td class="langLeft">Font-size:</td>
        <td class="left_top">
        	<select name="subm_butt_size">
            	<option value="inherit"<?php if($OptionsVis['subm_butt_size']=='inherit') echo ' selected="selected"'; ?>>inherit</option>
            	<?php for($i=9; $i<=32; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['subm_butt_size']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.5; $i <= 5; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['subm_butt_size']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit25" type="submit" value="Save" class="submitButton" /></td>
      </tr>    
    </table>
    </div>
    
    
    <div class="accordion_toggle">Distances</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables"> 
      <tr>
        <td class="langLeft">Distance below menu:</td>
        <td class="left_top">
        	<select name="dist_link_title">
                <?php for($i=0; $i<=100; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_link_title']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_link_title']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr> 
      <tr>
        <td class="langLeft">Distance between events in the list:</td>
        <td class="left_top">
        	<select name="dist_btw_events">
            	<?php for($i=0; $i<=99; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_btw_events']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_btw_events']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance below date in the events list:</td>
        <td class="left_top">
        	<select name="summ_dist_edate_etime">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_dist_edate_etime']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_dist_edate_etime']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      <tr>
        <td class="langLeft">Distance below title in the events list:</td>
        <td class="left_top">
        	<select name="summ_dist_title_date">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_dist_title_date']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>    
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_dist_title_date']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>    
      <tr>
        <td class="langLeft">Distance below location in events list:</td>
        <td class="left_top">
        	<select name="summ_dist_loc_price">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_dist_loc_price']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_dist_loc_price']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>      
      <tr>
        <td class="langLeft">Distance below price in the events list:</td>
        <td class="left_top">
        	<select name="summ_dist_price_descr">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['summ_dist_price_descr']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['summ_dist_price_descr']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>   
      
      
      <tr>
        <td class="langLeft">Distance below the title in event details page:</td>
        <td class="left_top">
        	<select name="dist_title_date">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_title_date']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>    
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_title_date']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>  
      <tr>
        <td class="langLeft">Distance below publish date in event details page:</td>
        <td class="left_top">
        	<select name="dist_date_text">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_date_text']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>   
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_date_text']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Distance below event date in event details page:</td>
        <td class="left_top">
        	<select name="dist_edate_etime">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_edate_etime']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?> 
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_edate_etime']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Distance below event time in event details page:</td>
        <td class="left_top">
        	<select name="dist_etime_loc">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_etime_loc']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_etime_loc']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>         
      <tr>
        <td class="langLeft">Distance below location in event details page:</td>
        <td class="left_top">
        	<select name="dist_loc_price">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_loc_price']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_loc_price']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>        
      <tr>
        <td class="langLeft">Distance below price in event details page:</td>
        <td class="left_top">
        	<select name="dist_price_descr">
            	<?php for($i=0; $i<=50; $i++) {?>
            	<option value="<?php echo $i;?>px"<?php if($OptionsVis['dist_price_descr']==$i.'px') echo ' selected="selected"'; ?>><?php echo $i;?>px</option>
                <?php } ?>
                <?php for($i = 0.1; $i <= 10; $i = $i + 0.1) {?>
            	<option value="<?php echo $i;?>em"<?php if($OptionsVis['dist_price_descr']==$i."em") echo ' selected="selected"'; ?>><?php echo $i;?>em</option>
                <?php } ?>
            </select>
        </td>
      </tr>
         
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit10" type="submit" value="Save" class="submitButton" /></td>
      </tr>    
    </table>
    </div>
    
    
    </div>
	</form>
<?php } ?>