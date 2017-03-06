# wp-mailchimp-display_newsletters

Mailchimp newsletter campaigns are also available as RSS feeds.  It's an obscure feature, but a handy one.
This code will pull the RSS feed in, parse it, then display the results on the screen.
Each newsletter appears with the date, title, excerpt.  The user can click a button to read the entire newsletter.

To use the code, you need to get the RSS feed from Mailchimp -- which is hidden a bit.
Follow the steps below to get the RSS feed for your campaign, then paste it into the code.


SETP 1:  GET YOUR MAILCHIMP CAMPAIGN ARCHIVE PAGE

You need to get the archive page for your campaign.

1) Sign into your Mailchimp account

2) Go to Lists

3) Under the drop down list that says 'stats', select 'Signup Forms'

4) Select 'General forms'

5) In the drop down  box that says 'Signup Form'
Scroll down to near the bottom and select 'Campaign archive page'

6) You will see 'Campaign archive URL'.  That's what you're looking for!

For more on finding this link, <br>
see also: See:  http://kb.mailchimp.com/campaigns/archives/find-your-sent-email-campaigns




SETP 2:  CHANGE THE ARCHIVE URL TO DISPLAY THE RSS FEED FOR THE CAMPAIGN

The 'Campaign archive page' gives you a link to your archive page.  It displays all the newsletters, but in HTML format.  We need to change the url to display the rss feed.

To do that, replace 'home' with 'feed' in the URL.

Ex.
From:
http://us4.campaign-archive2.com/home/?u=xxxxxxxxx&id=yyyyyyyyyy

To
http://us4.campaign-archive2.com/feed/?u=xxxxxxxxx&id=yyyyyyyyyy




SETP 3:  PUT THE RSS URL INTO THE CODE.

1) Open up the file 'mailchimp-newsletters.php'

2) Around line 7, you will see:
	//===== GET MAILCHIMP FILE =====//	
	$File = 'http://us4.campaign-archive2.com/feed/?u=xxxxxxxxx&id=yyyyyyyyyy';

3) Replace 'http://us4.campaign-archive2.com/feed/?u=xxxxxxxxx&id=yyyyyyyyyy'
with your feed url.



STEP 4: SAVE, UPLOAD.
That should do it!
