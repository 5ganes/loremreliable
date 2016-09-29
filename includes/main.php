<div class="bodyMidRight_ctnr">
          		
    <h2>OUR SURGICAL PRODUCTS</h2>

    <div class="bodyMidRight_ctnrInsideBlock">
     
        <? $cat=$groups->getByLinkTypeAndFeaturedWithLimit("Activity", "Yes", 9);
        while($actGet=$conn->fetchArray($cat))
        {?>
        
            <div class="availablePackages">
                <a href="category-<?=$actGet['urlname'];?>.html" class="linkOnTheRight"><img src="<?=CMS_GROUPS_DIR.$actGet['image'];?>" width="214" height="120" alt="" /></a>
                <h3><?=$actGet['name'];?></h3>
                <p class="text1"><?=substr(strip_tags($actGet['shortcontents']), 0, 90);?></p>
                <div class="availablePackages_links">
                  <?php /*?><a class="linkOnTheLeft">Duration: ( <?=$actGet['days'];?> )</a><?php */?>
                  <a href="category-<?=$actGet['urlname'];?>.html" class="linkOnTheRight">[ detail ]</a>
                </div>
            </div>
  
        <? }?>
        
        <!--<a href="" class="view-all">[ view all ]</a><div style="clear:both"></div>-->
        
        <div class="pages_numerations">
            <!--<span>Browse Pages: <a>First</a> | <a>Previous</a> <a>1</a> | <a>2</a> | <a>3</a> | <a>4</a> | <a>5</a> | <a>6</a> | <a>7</a> | <a>8</a>... <a>Next</a> | <a>
            Last</a> </span>-->
        </div> <!-- 'pages_numerations' ends -->
  
    	<div class="bodyMidRight_ctnr">
    		<h2>WELCOME TO RELIABLE SURGICAL TRADING COMPANY</h2>
    		<div id="upcomingCtnr">
        	<? $welcome=$groups->getById(176); $welGet=$conn->fetchArray($welcome); ?>
        	<p class="text5" style="line-height:19px;">
            	<?=substr(strip_tags($welGet['shortcontents']), 0, 1500);?>
        	</p> 
        	<a href="<?=$welGet['urlname'];?>" class="more">[ detail ]</a>
    	</div> <!-- 'upcomingCtnr' ends -->
	
    	</div>
        
        <?php /*?><div class="fourRowsCtnr">
        
            <div class="rows_ctnr">
                <h4>Travel Guide</h4>
                <ul class="text3">
                    <? $guide=$groups->getByParentIdWithLimit(6, 10);
                    while($guideGet=$conn->fetchArray($guide))
                    {?>
                        <li><a href="<?=$guideGet['urlname'];?>"><?=$guideGet['name'];?></a></li>
                    <? }?>
                </ul>
            </div>
            <div class="rows_ctnr">
                <h4>Hotels &amp; Restaurants</h4>
                <ul class="text3">
                    <? $hotel=$groups->getByParentIdWithLimit(196, 10);
                    while($hotelGet=$conn->fetchArray($hotel))
                    {?>
                        <li><a href="<?=$hotelGet['urlname'];?>"><?=$hotelGet['name'];?></a></li>
                    <? }?>
                </ul>
            </div>
            <div class="rows_ctnr">
                <h4>Nepal Flights</h4>
                <ul class="text3">
                    <? $flight=$groups->getByParentIdWithLimit(206, 20);
                    while($flightGet=$conn->fetchArray($flight))
                    {?>
                        <li><a href="<?=$flightGet['urlname'];?>"><?=$flightGet['name'];?></a></li>
                    <? }?>
                </ul>
            </div>
            <div class="rows_ctnr">
                <h4>Aerostate Travels</h4>
                    <ul class="text3">
                        <? $aero=$groups->getByParentIdWithLimit(216, 20);
                        while($aeroGet=$conn->fetchArray($aero))
                        {?>
                            <li><a href="<?=$aeroGet['urlname'];?>"><?=$aeroGet['name'];?></a></li>
                        <? }?>
                    </ul>
            </div>
        
        </div> <!-- 'fourRowsCtnr' ends --><?php */?>
    
    </div> <!-- 'bodyMidRight_ctnrInsideBlock' ends -->

</div> <!-- 'bodyMidRight_ctnr' ends -->


        
 <div class="bodyMidRight_ctnr">
    <h2>RHINOLOGY/RHINOPLASTY INSTRUMENTS</h2>
    <div id="upcomingCtnr">
        <? include('includes/reliable_prod.php'); ?>
        
        <!--<div id="upcoming_arrows">
            <a id="scrollLeft"></a><a id="scrollRight"></a>
        </div>-->

    </div> <!-- 'upcomingCtnr' ends -->
</div><!-- 'bodyMidRight_ctnr' ends -->
        