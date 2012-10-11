

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr">
<head>
<title>StratusLab :: Combining Grid and Cloud Technologies</title>

<!-- Meta tags -->
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Combining Grid and Cloud Technologies,StratusLab,stratuslab,stratus,lab,cloud,grid,virtualization,dci"/>
<meta name="Description" content="StratusLab Combining Grid and Cloud Technologies"/>
<meta name="robots" content="index,follow" /> 
<meta name="date" content="2011-05-13T16:11:26+0100" />


<!-- stylesheets -->
<link rel="stylesheet" type="text/css" href="stratuslab.css" media="screen"> 
<link rel="stylesheet" type="text/css" href="960.css" media="screen">
<link rel="stylesheet" type="text/css" href="dokuwiki_export_xhtmlbody.css" media="screen">


<!-- scripts -->

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript" src="fadeslideshow.js">

/***********************************************
* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript">

var banner=new fadeSlideShow({
	wrapperid: "fadeshow", //ID of blank DIV on page to house Slideshow
	dimensions: [940, 150], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [


["images/StratusLab-banner-clouds3.jpg", "", "", ""],["images/StratusLab-banner-grid3.jpg", "", "", ""],["images/StratusLab-banner-science3.jpg", "", "", ""]	],
	displaymode: {type:'auto', pause:5000,
			cycles:0,
			wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 200, //transition duration (milliseconds)
	descreveal: "none",
	togglerid: ""
})


</script>

<!-- stupid hack, fadeSlideShow seems to be loading a different version of jquery -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

</script>

</head>




<body>


<!-- *************************************
***************** Banner *****************
************************************** -->

<div class="container_12">  <!-- grid960 container_12 div -->


<div class="grid_12"> <!-- grid960 grid_12 div containing the banner -->




<div id="fadeshow" class="myslideshow">  <!-- fadeshow banner slideshow script div -->
</div>


<!-- slideshow menu div, holds the buttons for navigating between slideshow images, obsolutely positioned to allow menu to appear on top of slideshow -->
<div class="slideshowmenu"> 
<span class="slideshowmenuitem"><a class="slideshowlink" href="./javascript:banner.navigate(0)">&nbsp;1&nbsp;</a></span>
<span class="slideshowmenuitem"><a class="slideshowlink" href="./javascript:banner.navigate(1)">&nbsp;2&nbsp;</a></span>
<span class="slideshowmenuitem"><a class="slideshowlink" href="./javascript:banner.navigate(2)">&nbsp;3&nbsp;</a></span>
</div>

<!-- main menu under the banner -->
<div class="mainmenu">
<span class="menuitem">
<a class="menulink" href="index.php">Home</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/release:install">Install</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/support">Support</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/documentation">Documentation</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/roadmap:project_roadmap">Roadmap</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/news">News</a>
</span>
<span class="menuitem">
<a class="menulink" href="doku.php/project:info">About</a>
</span>
</div>
</div> <!-- end grid_12 div banner -->

<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>





<!-- *************************************
***************** Content ****************
************************************** -->


<div class="grid_9"> <!-- grid960 grid_6 div main panel-->
<span class="projecttext">

<div id="projectshortdesc">
<p><strong>THESE ARE ARCHIVED WEB PAGES FROM THE STRATUSLAB FP7 PROJECT. <a href="http://stratuslab.eu">SEE</a> THE MAIN PAGES FOR CURRENT INFORMATION.</strong></p>
<p>StratusLab is developing a complete, open-source cloud distribution that allows grid and non-grid resource centers to offer and to exploit an “Infrastructure as a Service” cloud. It is particularly focused on enhancing distributed computing infrastructures such as the European Grid Infrastructure (EGI).</p>
</div>

<span class="smallheader">Project News</span>
<hr>
<!-- Get the news feed urls -->

<div id="content0"></div><script>$("#content0").load("doku.php/news:release2.0?do=export_xhtmlbody");</script><hr>
</span>
</div> <!-- end grid_9 div main panel -->




<!-- sidebar -->
<div class="grid_3"> <!-- grid960 grid_3 div sidebar -->

<div class="spacer">&nbsp;</div>

<!-- Download buttons -->
<span class="sidebaritem">
<a class="buttonlink" href="doku.php/release:users">
Get Started
</a>
</span>
<div class="spacer">&nbsp;</div>

<span class="sidebaritem">
<a class="buttonlink" href="doku.php/release:providers">
Install Cloud
</a>
</span>
<div class="spacer">&nbsp;</div>

<span class="sidebaritem">
<a class="buttonlink" href="http://marketplace.stratuslab.eu/">
Marketplace
</a>
</span>
<div class="spacer">&nbsp;</div>

<!-- Youtube videos -->

<span class="sidebaritem">
		      <iframe class="video" src="http://www.youtube.com/embed/eR8OgKsuBoo" allowfullscreen></iframe><br>Watch the StratusLab Tutorial online</span>
		      <div class="spacer">&nbsp;</div><span class="sidebaritem">
		      <iframe class="video" src="http://www.youtube.com/embed/gDaWiuX93ss" allowfullscreen></iframe><br>Find out more about StratusLab with the introductory video</span>
		      <div class="spacer">&nbsp;</div>

<!-- Twitter Feed -->
<span class="sidebaritem">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 5,
  interval: 6000,
  width: 215,
  height: 150,
  theme: {
    shell: {
      background: '#e2f3fe',
      color: '#000000'
    },
    tweets: {
      background: '#ffffff',
      color: '#143262',
      links: '#143262'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('stratuslab').start();
</script>
</span>
<div class="spacer">&nbsp;</div>

<!-- twitter counter -->
<span class="sidebaritem">
<script type="text/javascript" src="http://twittercounter.com/embed/stratuslab/143262/e2f3fe"></script><noscript><a href="http://twittercounter.com/stratuslab">StratusLab on Twitter Counter.com</a></noscript>
</span>

</div> <!-- end grid_3 div sidebar -->


<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>


</div> <!-- end container_12 div -->

<!-- *************************************
***************** Footer *****************
************************************** -->

<div class="container_12" id="footer">

<div class="clear">&nbsp;</div>
<div class="footspacer">&nbsp;</div>



<div class="grid_2 push_10 omega">
<a class="footerlink" href="./mailto:info@stratuslab.eu">General queries</a><br>
<a class="footerlink" href="./mailto:support@stratuslab.eu">Support queries</a> 
<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>
<a class="footerlink" href="doku.php/internal">Go to project internal pages</a>
</div>

<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>




<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>


<div class="grid_1 push_2 alpha">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:cnrs"><img src="images/partnerlogos/cnrs-logo.png"></a></a>
<a class="partnerlink" href="doku.php/project:cnrs">CNRS</a>
</div>
</div>
<div class="grid_1 push_2">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:grnet"><img src="images/partnerlogos/grnet-logo.png"></a><br>
<a class="partnerlink" href="doku.php/project:grnet">GRNET</a>
</div>
</div>
<div class="grid_1 push_2">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:sixsq"><img src="images/partnerlogos/sixsq-logo.png"></a><br>
<a class="partnerlink" href="doku.php/project:sixsq">SixSq Sàrl</a>
</div>
</div>
<div class="grid_1 push_2">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:ucm"><img src="images/partnerlogos/ucm-logo.png"></a><br>
<a class="partnerlink" href="doku.php/project:ucm">UCM</a>
</div>
</div>
<div class="grid_1 push_2">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:tid"><img src="images/partnerlogos/tid-logo.png"></a><br>
<a class="partnerlink" href="doku.php/project:tid">TID</a>
</div>
</div>
<div class="grid_1 push_2">
<div class="partnerlink">
<a class="imagelink" href="doku.php/project:tcd"><img src="images/partnerlogos/tcd-logo.png"></a><br>
<a class="partnerlink" href="doku.php/project:tcd">TCD</a>
</div>
</div>
<div class="grid_1 push_4 omega">
<img src="images/FP7-cap-CMYK.png">
</div>
<div class="grid_1 push_4">
<img src="images/eu-flag-blue-yellow.png">
</div>
<!-- <div class="grid_2 push_3 omega">
<img src="images/e-infrastructure-logo.png">
</div> -->

<div class="spacer">&nbsp;</div>
<div class="grid_10 push_2">
The StratusLab project is co-funded by the European Community's Seventh Framework Programme (Capacities) Grant Agreement INFSO-RI-261552.
</div>
<div class="clear">&nbsp;</div>
<div class="spacer">&nbsp;</div>


</div> <!-- end container_12 div -->

</body>
</html>

