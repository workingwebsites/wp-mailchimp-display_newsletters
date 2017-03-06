// JavaScript Document

function mc_toggle_newsletter(ContentID){
//Show / hides content in newsletter
	//nlabstract_'.$newsletter['id']
	
	jQuery("#nlabstract_"+ContentID).slideToggle('slow');
	jQuery("#nlcontent_"+ContentID).slideToggle('slow');
	
}