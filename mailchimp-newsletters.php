<?php

function mcnl_get_newsletters(){
//Returns content of newsletters sent out by mailchimp campaign

	//===== GET MAILCHIMP FILE =====//
	$File = 'http://us4.campaign-archive2.com/feed?u=xxxxxxxxxx&id=yyyyyyyyyy';



	//===== DO XML OBJECT =====//
	$xml = simplexml_load_string(file_get_contents($File));


	//===== BUILD ARRAY =====//
	$arArchiveList = array();

	//Go through XML
	for ($i = 0; $i <count($xml->channel[0]->item) ; $i ++) {
		//Get the current item
		$feedItem = $xml->channel[0]->item[$i];

		//Set id
		$arArchiveList[$i]['id'] = $i;
		//Populate arArchiveList
		$arArchiveList[$i]['subject'] = (string)$feedItem->title[0];
		$arArchiveList[$i]['pubdate'] = $feedItem->pubDate;

		//Get the content
		$arArchiveList[$i]['html'] = (string)$feedItem->children("content", true);

		//Turn it into  DOM
		$doc = new DOMDocument();
		@$doc->loadHTML($arArchiveList[$i]['html']);	//@ =  ignore warnings

		//Get content text
		$strContent = trim($doc->getElementById('templateBody')->nodeValue);

		//Set Abstract
		if(strlen($strContent) > 255){
			//Shorten it to 250 characters
			$strAbstract_1 = substr($strContent, 0, 250);
			//End text with '...'
			$arArchiveList[$i]['abstract'] = substr($strAbstract_1, 0, strrpos($strAbstract_1, ' '))."&hellip; ";
		} else {
			$arArchiveList[$i]['abstract'] = $strContent;
		}	// end if $strContent

	}	// end for archive

	return $arArchiveList;
}



/*
 * Displays the newsletters
*/
function mcnl_newsletter_list(){

	//Get the newsletters
	$ar_newsletter = mcnl_get_newsletters();
	$str_html = NULL;


	//Parese the newsletters
	foreach ($ar_newsletter As $newsletter) {

		$date = date( get_option( 'date_format' ), strtotime($newsletter['pubdate'][0]));

		$str_html .= '<div class="post-archive shadow-border-grey"> '
						.'<article id="post-foo" class="post type-post status-publish format-standard hentry">'
							.'<header class="entry-header">'
								.'<h2 class="entry-title"> '
									.$newsletter['subject'].' <small> ('.$date.') </small>'
								.'</h2>'
							.'</header>'
							.'<div class="entry-content">'
								.'<div id="nlabstract_'.$newsletter['id'].'">'.nl2br($newsletter['abstract']).'</div>'

								.'<div class="pull-right">'
                            		.'<input name="test" type="button" value="Read Newsletter" onclick="mc_toggle_newsletter('.$newsletter['id'].')"  />'
								.'</div>'
								.'<div id="nlcontent_'.$newsletter['id'].'" class="nl-content">'
									.$newsletter['html']
								.'</div>'
							.'</div>'
						.'</article>'
					.'</div>';
	}	// end foreach

	//Load the style
	wp_enqueue_style( 'nlcss' );
	wp_enqueue_script( 'nljs' );

	//Return results
	return $str_html;
}

add_shortcode( 'mc_newsletter_list', 'mcnl_newsletter_list' );


/*
 * Register styles and scripts
*/
function mc_newsletter_register() {
	wp_register_style( 'nlcss', plugin_dir_url(__FILE__).'/mcnewsletter.css');
	wp_register_script( 'nljs', plugin_dir_url(__FILE__).'/mcnewsletter.js');
}

add_action( 'wp_enqueue_scripts', 'mc_newsletter_register' );

?>
