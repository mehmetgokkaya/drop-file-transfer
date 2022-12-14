<?php
$maxsize = 50*1024*1024;       // 50 MB
$thefiledata = 'thefiledata';  // file which contains the data
$thefilename = 'thefilename';  // file which contains only the filename
$autoeraseafterdownload = 1;   // delete file after a download

if (isset($_POST['type']) && $_POST['type'] === 'upload')
{  
    if (empty($_FILES['data']['tmp_name'])) { die('ERROR'); }          // no file sent
    if (!empty($_POST['email'])) { die('ERROR'); }                     // spam honeypot
    if ($_POST['fname'] !== $_FILES['data']['name']) { die('ERROR'); } // someone wants to cheat?
    if ($_FILES['data']['size'] > $maxsize) { die('TOO BIG!'); }       // too big file

    $localfname = $_POST['fname'];

    $data = file_get_contents($_FILES['data']['tmp_name']);

    $file = fopen($thefiledata, 'wb');
    fwrite($file, $data);
    fclose($file);

    $filename = fopen($thefilename, 'wb');
    fwrite($filename, $localfname);
    fclose($filename);
    
    die('Yüklendi');
}

if (isset($_GET['type']) && $_GET['type'] === 'download')
{
    if (!file_exists($thefiledata) || !file_exists($thefilename))
    {
        echo '<html><head><meta content="width=device-width, initial-scale=1.0" name="viewport"><style type="text/css">*{color:white;font-family:sans-serif;padding:0;margin:0;cursor:pointer;-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}body{width:100%;top:0;position:absolute;background-color:#f90;height:100%;left:0}a{position:absolute;top:0;height:100%;text-align:center;width:100%;text-decoration:none;display:block}a div{position:relative;top:45%;height:auto;text-align:center;width:100%;font-size:2.5em;text-decoration:none}a span{font-size:70%}</style><title></title></head><body> <a href="./"><div>Yüklenen Dosyanız Silinmiş olabilir ya da henüz dosya yüklenmedi<br /><span>Dosyayı Yüklemek için tıklayınız<br><p>Unutmayın her dosyayı sadece bir kez indirebilirsiniz. Dosyayı indirdiğinizde yüklenen dosya silinir.</p></br></span></div></a></body></html>';
        exit;
    }
    $fname = file_get_contents($thefilename);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $fname . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($thefiledata));
    readfile($thefiledata);

    if ($autoeraseafterdownload) 
    {
        unlink($thefiledata);
        unlink($thefilename);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1" />
<title>Dosya Transfer</title>
<style type="text/css">
* { color: white; font-family: sans-serif;  padding: 0; margin: 0; cursor: pointer; -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
#upload { width: 100%; top: 0; position: absolute; background-color: #f44242; height: 50%; }
#download { width: 100%; top: 50%; position: absolute; background-color: #42a1f4; height: 50%; left: 0; }
.text { position: absolute; top: 40%; text-align: center; width: 100%; font-size: 3em; }
#email_addr { display:none; }
</style>
</head>
<body>
        <?php  
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
             $url = "https://";   
        else  
             $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
          
      ?>   
    <h3 style="z-index:999; position:absolute;"><a href="/">Anasayfaya Dön</a></h3>
    <h3 style="z-index:999; position:absolute;right: 0;">Qr Kodunuz:<br /><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $url ?>" /></h3>
<input type='file' id='file' />  
<div id="upload"><div class="text" id="uploadtext">Dosya Yükle</div></div>
<a href="index.php?type=download" id="download"><div class="text">Dosyayı İndir</div></a>
<input id="email_addr" name="email" size="25" value="" autocomplete="off" />
<script>
var upload = document.getElementById('upload');
var uploadtext = document.getElementById('uploadtext');
var fileelt = document.getElementById('file');

upload.onclick = function() { fileelt.click(); };

function readfiles(files) {
    if (files[0].size > <?php echo $maxsize; ?>) { uploadtext.innerHTML = 'TOO BIG!'; return; }
    var formData = new FormData();
    formData.append('type', 'upload');
    formData.append('fname', files[0].name);
    formData.append('data', files[0]);
    formData.append('email', document.getElementById('email_addr').value);
    uploadtext.innerHTML = 'Yükleme Başlıyor';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '.');
    xhr.onload = function() { uploadtext.innerHTML =  xhr.responseText; };
    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            var complete = (event.loaded / event.total * 100 | 0);
            uploadtext.innerHTML = 'Yükleniyor<br>işlenen '+ complete + '%';
        }
    };
    xhr.send(formData);
}

document.body.ondragover = function() { uploadtext.innerHTML = 'Dosyanızı Buraya bırakın'; return false; };

document.body.ondrop = function(e) { e.preventDefault();  readfiles(e.dataTransfer.files); };

fileelt.addEventListener("change", function() { readfiles(fileelt.files); })
</script>
</body>
</html>
