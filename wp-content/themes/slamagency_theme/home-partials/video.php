<?php

    $mp4  = get_template_directory_uri() . "/library/video/slam-website-background_final.mp4";
    $ogg  = get_template_directory_uri() . "/library/video/slam-website-background_final.ogg";
    $webm = get_template_directory_uri() . "/library/video/slam-website-background_final.webm";

    $iframe = '<script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:41.67% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><div class="wistia_embed wistia_async_5ajp75g6fr videoFoam=true" style="height:100%;width:100%">&nbsp;</div></div></div>';

?>
<section class="section next full-height bg-gray" id="go">
    <div class="background-video">
        <div class="hatch-overlay"></div>
        <video id="bgVideo" class="show-for-medium-up" preload="auto" autoplay loop muted >

            <source src="<?php echo $mp4; ?>" type="video/mp4" >
            <source src="<?php echo $ogg; ?>" type="video/ogg" >
            <source src="<?php echo $webm; ?>" type="video/wemb" >    
            
        </video> 

        <a href='#go' id='video-play'><i class='fi-play'></i></a>

    </div>
    <div class="wistia-video-hiding-wrapper wistia-video" >
        
        <?php echo $iframe; ?>
            
    </div>
</section>