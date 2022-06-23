<html>

<head>
    <title>
Simple PHP Scraper
    </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<form action="" method="post" class="opened">
  <input type="search" name="url" placeholder="URL" value="<?= @$post['url']?>">
  <button type="submit">
    <span class="fontawesome-search"></span>
  </button>
</form>


<div class="result">
<?php
$post = $_POST;
if(@$post AND $post['url']!=''){
    require '../vendor/autoload.php';
    $httpClient = new \GuzzleHttp\Client();
    $response = $httpClient->get($post['url']);
    $htmlString = (string) $response->getBody();
    //add this line to suppress any warnings
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    // echo $htmlString;
    $doc->loadHTML($htmlString);
    $xpath = new DOMXPath($doc);
    $titles = $xpath->query("//a");;
    $url = $xpath->query("//a/@href");;
    //$prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
    foreach ($titles as $key => $title) {
        echo $title->nodeValue.' = '.$url[$key]->nodeValue.'<br/>'; 
    }
}
?>


</div>

</body>
</html>
