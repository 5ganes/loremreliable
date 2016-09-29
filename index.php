<? include('clientobjects.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	Reliable Surgical-
    <?php if($pageName!=""){ echo $pageName;}else if(isset($_GET['action'])){ echo $_GET['action'];}else{ echo "Home";}?>
</title>
<? include('baselocation.php'); ?>
<link href="css/main_styles.css" rel="stylesheet" type="text/css" />
<link href="css/accordion_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.1.4.2.js"></script>
<script type="text/javascript" src="js/ddaccordion.js">
/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/
</script>

<script type="text/javascript">
	ddaccordion.init({
		headerclass: "submenuheader", //Shared CSS class name of headers group
		contentclass: "submenu", //Shared CSS class name of contents group
		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
		defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
		onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})
</script>

</head>

<body>

<div id="wrapper">
  	<div id="bodyCtnr">
    	<? include_once('header.php'); ?>
    
    	<? if(!isset($pageLinkType) and !isset($_GET['action']))
		{?>
        <div id="bodyTopCtnr">
            <div id="slideshow">
                <? include('includes/slider.php'); ?>  	
                <!--<img src="images/slideshow_img.jpg" width="1000" height="340" alt="" />-->
            </div>
        </div>
    	<? }?>
    
    	<div id="bodyMidCtnr">
     	
            <div class="bodyMidLeft">
                
                <? if(isset($pageLinkType) and $pageLinkType=="Trip")
				{?>
                	<?php /*?><div class="featuredActivities">
                    	<h1>Trip Facts:</h1>
                    	<ul class="bodyMidLeftLists">
                        	<? $t=$groups->getById($pageId); $tGet=$conn->fetchArray($t);?>
                            <li style="list-style:none;"><h3>Trip Duration:</h3><a href="activity-<?=$actGet['urlname'];?>.html"><?=$actGet['name'];?></a></li>
                    	</ul>
                	</div><?php */?>
                <? }?>
                
                <div class="featuredActivities">
                    <h1>PRODUCT CATEGORIES</h1>
                    <ul class="bodyMidLeftLists">
                        <? $act=$groups->getByLinkType("Activity");
                        while($actGet=$conn->fetchArray($act))
                        {?>
                            <li><a href="category-<?=$actGet['urlname'];?>.html"><?=$actGet['name'];?></a></li>
                        <? }?>
                    </ul>
                </div>
            	
                <div class="glossymenu">
                	<h1 style="line-height:40px;">FEATURED PRODUCTS</h1>
                    <? $fprod=$groups->getByLinkTypeAndFeaturedWithLimit("Product", "Yes", 4);
                    while($fprodGet=$conn->fetchArray($fprod))
                    {?>
                        <a class="menuitem submenuheader" href="<?=$fprodGet['urlname'];?>"><?=$fprodGet['name'];?></a>
                        <div class="submenu">
                              <ul>
                                <li style="text-align:justify">
                                  	<a href="destination-<?=$fprodGet['urlname'];?>.html">
                                  		<img src="<?=CMS_GROUPS_DIR.$fprodGet['image'];?>" width="234" height="135" alt="" style="margin-left:2px;" />
                                	</a>
                                    <?=substr(strip_tags($fprodGet['shortcontents']), 0, 130);?><div style="clear:both"></div>
                                  	<a href="order-<?=$fprodGet['urlname'];?>" style="float:left">Order Now</a>
                                    <a href="destination-<?=$fprodGet['urlname'];?>.html">[More]</a><div style="clear:both"></div>
                                </li>
                              </ul>
                        </div>
                    <? }?>
                
                </div>
                
                <div class="catalog"><a href="catalog.html"><img src="images/download.png" /></a></div>
                
				<style>  </style>
                
                <div class="featuredActivities">
                    <!--<h1>WATCH ONLINE</h1>-->
                    <div>
                    	<? $tube=$groups->getById(272); $tubeGet=$conn->fetchArray($tube); ?>    
                        <iframe class="youtube-player" width="255" style="margin-top:3px;" height="225" src="<?=$tubeGet['contents'];?>" allowfullscreen frameborder="0"></iframe>
                 	</div>
                </div>
                
                <div class="featuredActivities" style="margin-top:7px;">
                    
                    <div>    
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width=292&amp;height=260&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:260px;" allowTransparency="true"></iframe>
                 	</div>
                </div>
                
                <?php /*?><div class="featuredServices">
                    <h1>Featured Activities</h1>
                    <ul class="">
                        <? $actf=$groups->getByLinkTypeAndFeaturedWithLimit("Activity", "Yes", 6);
                        while($actfGet=$conn->fetchArray($actf))
                        {?>
                            <li style="list-style:none">
                                <a href="activity-<?=$actfGet['urlname'];?>.html"><img src="<?=CMS_GROUPS_DIR.$actfGet['image'];?>" width="238" height="72" /></a>
                                <p style="margin:-28px 0 0 0; background:#000; opacity:0.6; color:#BBBBBB; font-family:Verdana, Geneva, sans-serif; font-size:13px;
                                font-weight:bold; padding:4px; text-align:center;"><?=$actfGet['name'];?></p>
                            </li>
                        <? }?>
                    </ul>
                </div><?php */?>
            
            </div> <!-- 'bodyMidLeft' end -->
 	
    	<div class="bodyMidRight">
        
     		<?php 
				if(isset($_GET['action']))
			  	{
					$action = $_GET['action'];
					$action = str_replace(".","", $action);
					include("includes/".$action.".php");			
			  	}				
			  	else if(isset($pageLinkType))
			  	{
					if ($pageLinkType == ""){}
					else if ($pageLinkType == "Product"){ include("includes/showtrip.php"); }
					else if ($pageLinkType == "PackageRegion"){ include("includes/packageregion.php"); }
					else{ include("includes/cmspage.php"); }
			  	}
			  	else{ include("includes/main.php"); }
			?>

      	
  		</div> <!-- 'bodyMidRight' ends -->
    
    </div> <!-- 'bodyMidCtnr' ends -->
    
  	<?php /*?><div id="bodyBtmCtnr">
        
            <div class="bottomNav">
                <h5>Popular Trekking Packages</h5>
                <ul class="text4">
                    <? $trek=$groups->getByActivityWithLimit("Trekking", 8);
                    while($trekGet=$conn->fetchArray($trek))
                    {?>
                        <li><a href="<?=$trekGet['urlname'];?>"><?=$trekGet['name'];?></a></li>
                    <? }?>
                </ul>
            </div>
          
            <div class="bottomNav">
                <h5>Popular Tour Packages</h5>
                <ul class="text4">
                  
                  <? $tour=$groups->getByActivityWithLimit("Cultural Tours", 8);
                    while($tourGet=$conn->fetchArray($tour))
                    {?>
                        <li><a href="<?=$tourGet['urlname'];?>"><?=$tourGet['name'];?></a></li>
                    <? }?>  
                </ul>
            </div>
          
            <div class="bottomNav">
                <h5>Climbing & Expedition</h5>
                <ul class="text4">
                    <? $exp=$groups->getByActivityWithLimit("Climbing & Expedition", 8);
                    while($expGet=$conn->fetchArray($exp))
                    {?>
                        <li><a href="<?=$expGet['urlname'];?>"><?=$expGet['image'];?></a></li>
                    <? }?>
                </ul>
            </div>
            
            <div class="bottomNav" style="width:172px">
            <h5>Popular Trekking Regions</h5>
            <ul class="text4">
                <? $region=$groups->getByRegionWithLimit("Region", 8);
                while($regionGet=$conn->fetchArray($region))
                {?>
                    <li><a href="region-<?=$regionGet['urlname'];?>.html"><?=$regionGet['name'];?></a></li>
                <? }?>
            </ul>
                
          </div>
            
            <div class="bottomNav" style="padding-right:0">
            <h5>India/Bhutan/Tibet Tour</h5>
            <ul class="text4">
                <? $bit=$groups->getTripByBlockWithLimit("India/Bhutan/Tibet Tour", 8);
                while($bitGet=$conn->fetchArray($bit))
                {?>
                  <li><a href="<?=$bitGet['urlname'];?>"><?=$bitGet['name'];?></a></li> 
                <? }?>
            </ul>
          </div>
          
        </div><?php */?> <!-- 'bottomCtnr' ends -->
  
  </div> <!-- 'bodyCtnr' ends -->
  <div id="footerCtnr">
    <? include_once('footer.php'); ?>
  </div>
</div> <!-- 'wrapper' ends -->
</body>
</html>