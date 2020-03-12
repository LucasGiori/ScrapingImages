<?php
    // $html = file_get_contents('https://www.alfaumuarama.edu.br/fau/');


$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);

$URL = "https://www.alfaumuarama.edu.br/fau/";
// $URL_DIR = "https://www.alfaumuarama.edu.br/fau/";
$dumpDir = "imagens/";

//Get the page as a whole    
$html = file_get_contents('https://www.alfaumuarama.edu.br/fau/');
$dom = new domDocument();
@$dom->loadHTML($html);

//Find all the images located within div
foreach($dom->getElementsByTagName("img") as $img){
   //Get Src- Imagens
   $src =  $img->getAttribute('src');
   echo "<pre>SRC: ".$src."</pre>";


   //Get filename
   $filename = substr($src, strrpos($src, "/")+1);
   echo "<pre>File: ".$filename."</pre>";

   // //Quick fix for relative file paths
    if (strtolower(substr($src, 0, 5)) != 'http:' && strtolower(substr($src, 0, 6)) != 'https:'){
        $src = $URL.$src;
    }
    // echo "<pre>New SRC: ".$filename."</pre>";

   // // Save the file
   
    file_put_contents($dumpDir.$filename, file_get_contents($src,false, $context));
   
    
}
?>