<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PHP Verot Upload Sınıfı ile Croppie Fotoğraf Croplama Eklentisi Kullanımı</title>
<link rel="stylesheet" type="text/css" href="css/croppie.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/croppie.js"></script>
<script>
$(function(){	
	$uploadCrop = $('.fotom').croppie({
		enableExif: true,
		viewport: {
			width: 250,
			height: 250
		},
		boundary: {
			width: 270,
			height: 270
		}	
	});

	$("#upload").on("change",function(){	
		$(".fotom").fadeIn();
		var resim=document.getElementById("upload");				
		console.log(resim.files[0]);
		if (resim.files && resim.files[0]){
			var veri=new FileReader();
			veri.onload=function() {
				var adres=veri.result;
				$uploadCrop.croppie('bind', {
				url: adres,		
				});
					
			}		
			veri.readAsDataURL(resim.files[0]);
		}	
	});

	
});
function Kontrol(){		
	Form=document.forms['yukleme-formu'];	
	value=$('.fotom').croppie('get').points;
	$("input[name=fotobilgileri]").val(value);		
	var fotoadi=$("input[name=fotoadi]").val();	
	if(fotoadi=="")
	{
		$(".uyari").html("Lütfen fotoğraf adını yazınız.").fadeIn();	
	}
	else
	{	
		Form.submit();	
	}
}
</script>

</head>

<body>
    <div class="forms">
    <h1>FOTOĞRAF YÜKLEME FORMU</h1>
    <?php echo @$_GET["m"]=="success" ? '<div class="upload-status">Fotoğrafınız yüklenmiştir.</div>':'';?>
    <div class="uyari"></div>
    <form enctype="multipart/form-data" method="post" action="yukle.php" name="yukleme-formu">
    <input type="hidden" name="fotobilgileri">
      <ul class="form-row">
      <li><input type="text" name="fotoadi" placeholder="Fotoğraf adını yazınız..."></li>
      <li><label><input type="file" name="image_field" id="upload" accept="image/*"> Fotoğraf seçmek için tıklayınız </label></li>
      <li><div class="fotom"></div></li>  
      <li><input type="button"  value="Fotoğrafı Yükle" onClick="Kontrol();"></li>
      </ul>
    </form>
    </div>
</body>
</html>