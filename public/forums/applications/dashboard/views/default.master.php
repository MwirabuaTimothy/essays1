<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <?php $this->RenderAsset('Head'); ?>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
   <div id="Frame">
      <div id="Head">
         <div class="Menu">
            <h1><a class="Title" href="../"><span><?php echo Gdn_Theme::Logo(); ?></span></a></h1>
            <ul class="linkbar top1">
            	<a href="../howitworks"><li>How it Works</li></a> |
            	<a href="../forums"><li>Forum</li></a> | 
                <a href="../blog"><li>Blog</li></a> | 
                <a href="../contactus"><li>Contact Us</li></a> <br />
                <!-- <a href="javascript:void(0)" data-uv-lightbox="classic_widget">Customer Service</a> -->
            </ul>
            <?php
			      $Session = Gdn::Session();
					if ($this->Menu) {
						$this->Menu->AddLink('Dashboard', T('Dashboard'), '/profile', array('Garden.Settings.Manage'), array('class' => 'Dashboard'));
						// $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'),  array('class' => 'Users'));
						$this->Menu->AddLink('Activity', T('Activity'), '/activity', FALSE, array('class' => 'Activity'));
						if ($Session->IsValid()) {
							$Name = $Session->User->Name;
							$CountNotifications = $Session->User->CountNotifications;
							if (is_numeric($CountNotifications) && $CountNotifications > 0)
								$Name .= ' <span class="Alert">'.$CountNotifications.'</span>';

                     if (urlencode($Session->User->Name) == $Session->User->Name)
                        $ProfileSlug = $Session->User->Name;
                     else
                        $ProfileSlug = $Session->UserID.'/'.urlencode($Session->User->Name);
							$this->Menu->AddLink('User', $Name, '/profile/'.$ProfileSlug, array('Garden.SignIn.Allow'), array('class' => 'UserNotifications'));
							$this->Menu->AddLink('SignOut', T('Sign Out'), SignOutUrl(), FALSE, array('class' => 'NonTab SignOut'));
						} else {
							$Attribs = array();
							if (SignInPopup() && strpos(Gdn::Request()->Url(), 'entry') === FALSE)
								$Attribs['class'] = 'SignInPopup';
								
							$this->Menu->AddLink('Entry', T('Sign In'), SignInUrl($this->SelfUrl), FALSE, array('class' => 'NonTab SignIn'), $Attribs);
						}
						echo $this->Menu->ToString();
					}
				?>
            <div class="Search"><?php
					$Form = Gdn::Factory('Form');
					$Form->InputPrefix = '';
					echo 
						$Form->Open(array('action' => Url('/search'), 'method' => 'get')),
						$Form->TextBox('Search'),
						$Form->Button('Go', array('Name' => '')),
						$Form->Close();
				?></div>
         </div>
      </div>
      <div id="Body">
         <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
         <div id="Panel"><?php $this->RenderAsset('Panel'); ?></div>
      </div>
      <div id="Foot">
			<?php
				$this->RenderAsset();
				// echo Wrap(Anchor(T('Powered by Vanilla'), C('Garden.VanillaUrl')), 'div');
			?> 
			
	  </div>	
	  <!-- <div class="footer"></div> -->
		<!-- Footer Start Here -->
		<!-- <div class="footer">
            <div class="middles footerstuff">
                <div class="bottom_left">

                    <ul class="footer_links_space">
                        <a href="{{ URL::to('howitworks') }}"><li class="link">How it Works</li></a> | 
                        <a href="{{ URL::to('termsofuse') }}"><li class="link">Terms of Use</li></a> | 
                        <a href="{{ URL::to('privacypolicy') }}"><li class="link">Privacy Policy</li></a> | 
                        <a href="{{ URL::to('contactus') }}"><li class="link">Contact Us</li></a>
                    </ul>
                    <br/>
                    <span class="devs_space">Designed by <a class="dev" href="http://thedevs.org">TheDevs</a></span>
                    
                </div>
                        
                <div class="bottom_right">
                    <span class="social_text">Get in Touch...</span><br />

                    <ul class="social_buttons">
                        <a href="http://www.facebook.com" target="_blank"><li class="fb_btn"></li></a>
                        <a href="http://www.twitter.com" target="_blank"><li class="tw_btn"></li></a>
                        <a href="http://www.linkedin.com" target="_blank"><li class="li_btn"></li></a>
                        <a href="mailto:info@bookcheeetah.com" target="_blank"><li class="mail_btn"></li></a>
                        <a href="http://www.evernote.com" target="_blank"><li class="evernote_btn"></li></a>
                        <a href="http://www.plus.google.com" target="_blank"><li class="gplus_btn"></li></a>

                        <span class='st_sharethis_large' displayText='ShareThis'></span>
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        <span class='st_email_large' displayText='Email'></span>
                    </ul>
                </div>
            </div>
        </div> -->
        <!--  Footer Ends Here --> 

		
   </div>
	<!-- <?php $this->FireEvent('AfterBody'); ?> -->
</body>
</html>
