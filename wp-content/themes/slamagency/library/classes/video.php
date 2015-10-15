<?php 
/* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

	VIDEO CLASS

   %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */

// Function to add "http://" if a protocol is not already present in the url
function fixhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    $url = str_ireplace('https', 'http', $url);

    return $url;
}

class Video {

	public $id;
	public $url;
	public $title;
	public $description;

	public $youtubeid;
	public $vimeoid;
	//public $thumb;
	
	public $host;
		

	private $parsed;


	function __construct($url) {
		
		// Add "http://" if necessary.
		// It should already be present if this came through the submission form, but if it was added in the back end, it may not.
		$this->url = fixhttp($url);

	

		// Parse out the URL so we can find a YouTube or Vimeo ID
		$this->parsed = parse_url($this->url);

		// Is it YouTube or Vimeo?
		$this->host = $this->parsed['host'];

		// Get YouTube ID
		parse_str( parse_url( $this->url, PHP_URL_QUERY), $vars );
		// If there's a "v=" in there, it's YouTube
		$this->youtubeid = $vars['v'];
		// Let's check to see if they used a url shortener:
		if ($this->host == 'youtu.be'){
			$this->youtubeid = trim($this->parsed['path'], '/' );
			$this->id = $this->youtubeid;
		}
		
		// Get Vimeo ID
		if ($this->host == 'vimeo.com') {
			$this->vimeoid = trim($this->parsed['path'], '/' );
			$this->id = $this->vimeoid;
		}
		
		// Set default thumb.
		$this->thumb();
				


	}
 
	public function thumb() {

		if($this->youtubeid) {
			$this->get_youtube_thumb();
		} elseif($this->vimeoid) {
			$this->get_vimeo_thumb();
		} 	
		
	}



	public function make_link() {
		echo "<a href='{$this->permalink}#watch' class='video video-image-link'><span class='icon-play-circled'></span><img src='{$this->thumb}' alt='{$this->title}'/></a>";
	}



	private function get_youtube_thumb() {

		$options = array('maxresdefault', 'default', '0', 'hqdefault');

		// mqdefault

		$this->thumb = "http://img.youtube.com/vi/{$this->youtubeid}/0.jpg";

	}

	private function get_vimeo_thumb() {

		$hash = unserialize( file_get_contents("http://vimeo.com/api/v2/video/$this->vimeoid.php") );

		$this->thumb = $hash[0]['thumbnail_large']; 

	}

	public function prep_embed() {
		if ($this->youtubeid) {
		
	        
	       return "<div class='video-loading loading'>
	        	<iframe class='hide' id='{$this->youtubeid}' data-src='http://www.youtube.com/embed/{$this->youtubeid}?feature=player_detailpage&rel=0&modestbranding=1&showinfo=0&autoplay=1' frameborder='0' allowfullscreen></iframe>
	        </div>";
	        

    	} elseif ($this->vimeoid) {
    		
    		
    		return "<div class='video-loading loading'>
				<iframe class='hide' id='{$this->vimeoid}' data-src='//player.vimeo.com/video/{$this->vimeoid}/?badge=0&autoplay=1&title=0&portrait=0&byline=0&color={$GLOBALS['colors'][0]->hex}'  frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>";
    		
    	}
	}

	public function play_button($class = ''){


		return "<a data-div='{$this->id}' data-videoid='{$this->id}' href='{$this->url}' class='{$class} linked-play-button'><i class='fi-play'></i></a>";

	}


	public function embed() {



		if ($this->youtubeid) {

			//$this->get_youtube_thumb();

			$thumb = "<img class='fill' src='{$this->thumb}' width='640px' height='360px' />";
		
	        ?>
	        <div class="video-loading loading">
	        	<a class='loadvideo' data-id="<?php echo $this->youtubeid; ?>"><?php echo $thumb; ?></a>
	        	<iframe class="hide" id="<?php echo $this->youtubeid; ?>" data-src="http://www.youtube.com/embed/<?php echo $this->youtubeid; ?>?feature=player_detailpage&rel=0&modestbranding=1&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
	        </div>
	        <?php

    	} elseif ($this->vimeoid) {
    		//width="1000" height="562"
    		//$this->get_vimeo_thumb();

    		//$thumb = "<img class='fill' src='{$this->thumb}' width='640' height='360' />";
    		$thumb = "<img class='fill' src='{$this->thumb}' width='640' height='360' />";
    		
    		?>
    		<div class="video-loading loading">
    			<a class='loadvideo' data-id="<?php echo $this->vimeoid; ?>"><?php echo $thumb; ?></a>
				<iframe class='hide' id="<?php echo $this->vimeoid; ?>" data-src="//player.vimeo.com/video/<?php echo $this->vimeoid; ?>/?badge=0&autoplay=1&title=0&portrait=0&byline=0&color=<?php echo $GLOBALS['colors'][0]->hex; ?>"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
    		<?php
    	}
        

	}



}

?>