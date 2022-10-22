<head>
    <title>Drop Link</title>
    
    <style>
        <!-- HTML !-->

/* CSS */
.button,
.button {
  width: 100%;
  height: 100%;
  font-size: 100px;
  color: red;
    background: black;
  font-family: 'Bebas Neue', sans-serif;
  background: linear-gradient(45deg, transparent 5%, #FF013C 5%);
  border: 0;
  color: #fff;
  letter-spacing: 3px;
  box-shadow: 6px 0px 0px #00E6F6;
  outline: transparent;
  position: relative;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button:after {
  --slice-0: inset(50% 50% 50% 50%);
  --slice-1: inset(80% -6px 0 0);
  --slice-2: inset(50% -6px 30% 0);
  --slice-3: inset(10% -6px 85% 0);
  --slice-4: inset(40% -6px 43% 0);
  --slice-5: inset(80% -6px 5% 0);
  
  content: 'ALTERNATE TEXT';
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, transparent 3%, #00E6F6 3%, #00E6F6 5%, #FF013C 5%);
  text-shadow: -3px -3px 0px #F8F005, 3px 3px 0px #00E6F6;
  clip-path: var(--slice-0);
}

.button:hover:after {
  animation: 1s glitch;
  animation-timing-function: steps(2, end);
}

@keyframes glitch {
  0% {
    clip-path: var(--slice-1);
    transform: translate(-20px, -10px);
  }
  10% {
    clip-path: var(--slice-3);
    transform: translate(10px, 10px);
  }
  20% {
    clip-path: var(--slice-1);
    transform: translate(-10px, 10px);
  }
  30% {
    clip-path: var(--slice-3);
    transform: translate(0px, 5px);
  }
  40% {
    clip-path: var(--slice-2);
    transform: translate(-5px, 0px);
  }
  50% {
    clip-path: var(--slice-3);
    transform: translate(5px, 0px);
  }
  60% {
    clip-path: var(--slice-4);
    transform: translate(5px, 10px);
  }
  70% {
    clip-path: var(--slice-2);
    transform: translate(-10px, 10px);
  }
  80% {
    clip-path: var(--slice-5);
    transform: translate(20px, -10px);
  }
  90% {
    clip-path: var(--slice-1);
    transform: translate(-10px, 0px);
  }
  100% {
    clip-path: var(--slice-1);
    transform: translate(0);
  }
}

@media (min-width: 768px) {
  .button, .button::after {
  width: 100%;
  height: 100%;
  font-size: 100;
}
}
    </style>
</head>
<body>
<?php 
// if form is submitted
if(isset($_POST["pname"])){
$root = "/www/wwwroot/drop.mehmetgokkaya.com/index3.php";
$folder = mkdir ("upload/".$_POST['pname'], 0777);
if($folder) {
$reg = "index.php";
if (!copy($root, "upload/".$_POST['pname']."/".$reg)) {
echo "failed to copy $root...\n";
$klasor= $_POST['pname'];
} else {
$link = "upload/".$_POST['pname'];
header("Location: $link");
die();
echo "<button role='button' style='width: 100%;height: 100%;font-size: 90px;color: red !important;background-color: black !important;border: none;' class='button' ><a href='$link' style='color: red !important;'>Drop Sayfanız Oluşturuldu <br /> Gitmek İçin Tıklayınız</a></button>";
}
}
else {
echo "Bir Hata Meydana geldi başka bir isim deneyin";
}
}
?>

<form method="POST">
  <input style="display:none;" type="text" id="pname" name="pname" value="<?php echo rand(1,99999999999) ?>">
  <button style="width: 100%;height: 100%;font-size: 100px;color: red !important;background-color: black !important;border: none;" type="submit" class="button" value="Anlık Link Oluştur">Anlık Link Oluştur</button>
</form>
</body>
