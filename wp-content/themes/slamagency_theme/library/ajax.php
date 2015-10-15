<?php

function DOMinnerHTML(DOMNode $element) 
{ 
    $innerHTML = ""; 
    $children  = $element->childNodes;

    foreach ($children as $child) 
    { 
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML; 
} 

# Use the Curl extension to query Google and get back a page of results
$url = 'http://www.grsauction.com/cgi-bin/mntcal.cgi?grsauction/nh';
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);

$dom = new DOMDocument;
@$dom->loadHTML($html);

$links = $dom->getElementsByTagName('a');


$i = 0;
foreach ($links as $link) {

	if( $i < 5) {

		$title = strip_tags( DOMinnerHTML( $link ) ); 
		$href = "http://grsauction.com/" . $link->getAttribute('href');

		?>

		<li class="auction-list-item">
			<h4 class="auction-title"><?php echo $title; ?></h4>
			<a class="button" href="<?php echo $href; ?>">See Details</a>
		</li>


		<?php

	}

	$i++;
	
}  

