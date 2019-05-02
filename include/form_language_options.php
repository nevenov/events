<?php 
namespace EventScriptPHP20;
if ( $Logged ){ ?>
	<form action="admin.php" method="post" name="frm">
	<input type="hidden" name="act" value="updateOptionsLanguage" />
    
    <div class="opt_headlist">Translate front-end in your own language. </div>
	
    <div id="accordion_container"> 
    <div class="accordion_toggle">Wordings, navigations, links, buttons and paging</div>
    <div class="accordion_content">
    <table border="0" cellspacing="0" cellpadding="8" class="allTables">  
      <tr>
        <td class="langLeft">'Back' link:</td>
        <td class="left_top"><input class="input_lan" name="Back_to_home" type="text" value="<?php echo ReadHTML($OptionsLang["Back_to_home"]); ?>" />  &nbsp; <sub> - leave blank if you do not want 'Back' link </sub></td>
      </tr> 
      <tr>
        <td class="langLeft">'Search' button:</td>
        <td class="left_top"><input class="input_lan" name="Search_button" type="text" value="<?php echo ReadHTML($OptionsLang["Search_button"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">'Submit an Event' link:</td>
        <td class="left_top"><input class="input_lan" name="Submit_an_Event" type="text" value="<?php echo ReadHTML($OptionsLang["Submit_an_Event"]); ?>" />  &nbsp; <sub> - leave blank if you do not need 'Submit Event' link </sub></td>
      </tr> 
      <tr>
        <td class="langLeft">Event Date:</td>
        <td class="left_top"><input class="input_lan" name="Event_Date" type="text" value="<?php echo ReadDB($OptionsLang["Event_Date"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Event Time:</td>
        <td class="left_top"><input class="input_lan" name="Event_Time" type="text" value="<?php echo ReadDB($OptionsLang["Event_Time"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">CATEGORY:</td>
        <td class="left_top"><input class="input_lan" name="Category" type="text" value="<?php echo ReadDB($OptionsLang["Category"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">"-- ALL --" in category:</td>
        <td class="left_top"><input class="input_lan" name="Category_all" type="text" value="<?php echo ReadDB($OptionsLang["Category_all"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Location:</td>
        <td class="left_top"><input class="input_lan" name="Location" type="text" value="<?php echo ReadDB($OptionsLang["Location"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Price:</td>
        <td class="left_top"><input class="input_lan" name="Price" type="text" value="<?php echo ReadDB($OptionsLang["Price"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">'Read more' link:</td>
        <td class="left_top"><input class="input_lan" name="Read_more" type="text" value="<?php echo ReadHTML($OptionsLang["Read_more"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">Pagination "Previous":</td>
        <td class="left_top"><input class="input_lan" name="Previous" type="text" value="<?php echo ReadHTML($OptionsLang["Previous"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Pagination "Next":</td>
        <td class="left_top"><input class="input_lan" name="Next" type="text" value="<?php echo ReadHTML($OptionsLang["Next"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">No events published:</td>
        <td class="left_top"><input class="input_lan" name="No_events_published" type="text" value="<?php echo ReadHTML($OptionsLang["No_events_published"]); ?>" /></td>
      </tr>               
      <tr>
        <td class="langLeft">Article Hits:</td>
        <td class="left_top"><input class="input_lan" name="Article_Hits" type="text" value="<?php echo ReadHTML($OptionsLang["Article_Hits"]); ?>" /></td>
      </tr>              
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Days of the week in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">         
      <tr>
        <td class="langLeft">Monday:</td>
        <td class="left_top"><input class="input_lan" name="Monday" type="text" value="<?php echo ReadHTML($OptionsLang["Monday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Tuesday:</td>
        <td class="left_top"><input class="input_lan" name="Tuesday" type="text" value="<?php echo ReadHTML($OptionsLang["Tuesday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Wednesday:</td>
        <td class="left_top"><input class="input_lan" name="Wednesday" type="text" value="<?php echo ReadHTML($OptionsLang["Wednesday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Thursday:</td>
        <td class="left_top"><input class="input_lan" name="Thursday" type="text" value="<?php echo ReadHTML($OptionsLang["Thursday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Friday:</td>
        <td class="left_top"><input class="input_lan" name="Friday" type="text" value="<?php echo ReadHTML($OptionsLang["Friday"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">Saturday:</td>
        <td class="left_top"><input class="input_lan" name="Saturday" type="text" value="<?php echo ReadHTML($OptionsLang["Saturday"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">Sunday:</td>
        <td class="left_top"><input class="input_lan" name="Sunday" type="text" value="<?php echo ReadHTML($OptionsLang["Sunday"]); ?>" /></td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit1" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
      
    
    <div class="accordion_toggle">Months in the date</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">       
      <tr>
        <td class="langLeft">January:</td>
        <td class="left_top"><input class="input_lan" name="January" type="text" value="<?php echo ReadHTML($OptionsLang["January"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">February:</td>
        <td class="left_top"><input class="input_lan" name="February" type="text" value="<?php echo ReadHTML($OptionsLang["February"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">March:</td>
        <td class="left_top"><input class="input_lan" name="March" type="text" value="<?php echo ReadHTML($OptionsLang["March"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">April:</td>
        <td class="left_top"><input class="input_lan" name="April" type="text" value="<?php echo ReadHTML($OptionsLang["April"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">May:</td>
        <td class="left_top"><input class="input_lan" name="May" type="text" value="<?php echo ReadHTML($OptionsLang["May"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">June:</td>
        <td class="left_top"><input class="input_lan" name="June" type="text" value="<?php echo ReadHTML($OptionsLang["June"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">July:</td>
        <td class="left_top"><input class="input_lan" name="July" type="text" value="<?php echo ReadHTML($OptionsLang["July"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">August:</td>
        <td class="left_top"><input class="input_lan" name="August" type="text" value="<?php echo ReadHTML($OptionsLang["August"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">September:</td>
        <td class="left_top"><input class="input_lan" name="September" type="text" value="<?php echo ReadHTML($OptionsLang["September"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">October:</td>
        <td class="left_top"><input class="input_lan" name="October" type="text" value="<?php echo ReadHTML($OptionsLang["October"]); ?>" /></td>
      </tr> 
      <tr>
        <td class="langLeft">November:</td>
        <td class="left_top"><input class="input_lan" name="November" type="text" value="<?php echo ReadHTML($OptionsLang["November"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft">December:</td>
        <td class="left_top"><input class="input_lan" name="December" type="text" value="<?php echo ReadHTML($OptionsLang["December"]); ?>" /></td>
      </tr>       
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit2" type="submit" value="Save" class="submitButton" /></td>
      </tr> 
    </table> 
    </div> 
       
    
    <div class="accordion_toggle">Default meta tags for events list page</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">        
      <tr>
        <td class="langLeft">Meta title:</td>
        <td class="left_top"><input class="input_lan" name="metatitle" type="text" value="<?php echo ReadHTML($OptionsLang["metatitle"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Meta description:</td>
        <td class="left_top"><input class="input_lan" name="metadescription" type="text" value="<?php echo ReadHTML($OptionsLang["metadescription"]); ?>" /></td>
      </tr>            
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
    
    <div class="accordion_toggle">'SUBMIT AN EVENT' form</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">        
      <tr>
        <td class="langLeft">"Submit an Event" heading:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Event_head" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Event_head"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Event Date Start:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Date_Start" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Date_Start"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Event Date End:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Date_End" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Date_End"]); ?>" /></td>
      </tr>	
      <tr>
        <td class="langLeft">Event Time Start:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Time_Start" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Time_Start"]); ?>" /></td>
      </tr>	
      <tr>
        <td class="langLeft">Event Time End:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Time_End" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Time_End"]); ?>" /></td>
      </tr>	
      <tr>
        <td class="langLeft">Hide End Time:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Hide" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Hide"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Event Title:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Title" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Title"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Event Description:</td>
        <td class="left_top"><input class="input_lan" name="Description" type="text" value="<?php echo ReadDB($OptionsLang["Description"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Price:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Price" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Price"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">(i.e. $50):</td>
        <td class="left_top"><input class="input_lan" name="Submit_Price_info" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Price_info"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Location:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Location" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Location"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">(it's importand to put event location and city):</td>
        <td class="left_top"><input class="input_lan" name="Submit_Location_info" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Location_info"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Upload Image:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Image" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Image"]); ?>" /></td>
      </tr>  
      <tr>
        <td class="langLeft">(limit 2Mb)</td>
        <td class="left_top"><input class="input_lan" name="Submit_Image_info" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Image_info"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">Email:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Email" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Email"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">E-mail will be hidden from public:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Email_Info" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Email_Info"]); ?>" /></td>
      </tr>      
      <tr>
        <td class="langLeft">Enter verification code:</td>
        <td class="left_top"><input class="input_lan" name="Enter_verify_code" type="text" value="<?php echo ReadDB($OptionsLang["Enter_verify_code"]); ?>" /></td>
      </tr>     
      <tr>
        <td class="langLeft">Verification code placeholder:</td>
        <td class="left_top"><input class="input_lan" name="verify_placeholder" type="text" value="<?php echo ReadDB($OptionsLang["verify_placeholder"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Required fields:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Required_fields" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Required_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'Please fill the required fields' popup message:</td>
        <td class="left_top"><input class="input_lan" name="Submit_Fill_the_required_fields" type="text" value="<?php echo ReadDB($OptionsLang["Submit_Fill_the_required_fields"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'Incorrect email address' popup message:</td>
        <td class="left_top"><input class="input_lan" name="Submit_incorrect_email" type="text" value="<?php echo ReadDB($OptionsLang["Submit_incorrect_email"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'Please, enter verification code' popup message:</td>
        <td class="left_top"><input class="input_lan" name="field_code" type="text" value="<?php echo ReadDB($OptionsLang["field_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'Incorrect verification code' message:</td>
        <td class="left_top"><input class="input_lan" name="Submit_incorrect_verify_code" type="text" value="<?php echo ReadDB($OptionsLang["Submit_incorrect_verify_code"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'Event has been submitted!' message:</td>
        <td class="left_top"><input class="input_lan" name="Event_has_been_submitted" type="text" value="<?php echo ReadDB($OptionsLang["Event_has_been_submitted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">'After moderator approve will published' message:</td>
        <td class="left_top"><input class="input_lan" name="After_approve_will_publish" type="text" value="<?php echo ReadDB($OptionsLang["After_approve_will_publish"]); ?>" /> </td>
      </tr>           
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div>     
       
    
    <div class="accordion_toggle">Email subjects and emails</div>
    <div class="accordion_content">  
	<table border="0" cellspacing="0" cellpadding="8" class="allTables">        
      <tr>
        <td class="langLeft">Admin email subject when new event submitted:</td>
        <td class="left_top"><input class="input_lan" name="New_event_submitted" type="text" value="<?php echo ReadDB($OptionsLang["New_event_submitted"]); ?>" /></td>
      </tr>
      <tr>
        <td class="langLeft">Email subject of the message sent to visitor after event submission:</td>
        <td class="left_top"><input class="input_lan" name="Thanks_for_submitting_event" type="text" value="<?php echo ReadDB($OptionsLang["Thanks_for_submitting_event"]); ?>" /></td>
      </tr>   
      <tr>
        <td class="langLeft" valign="top">Email message sent to visitor after event submission:</td>
        <td class="left_top"><textarea class="input_lan" name="Thanks_email_message" rows="4"><?php echo ReadDB($OptionsLang["Thanks_email_message"]); ?></textarea></td>
      </tr> 
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit6" type="submit" value="Save" class="submitButton" /></td>
      </tr>
    </table> 
    </div> 
    
      
    </div> 
	</form>
<?php } ?>