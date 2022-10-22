# TR
# Anlık link olşuturarak dosya gönderme 
* Bu sistemin en büyük avantajı veritabanı veya herhangi bir database merkezi kullanmadan bütün işleri basit kodları yapabiliyor olmasıdır.
* php ile kişiye özel link oluşturup bu link ile kişiler kendi aralarında dosya paylaşımı yapabilecekler
* Dosyalar upload klasöründe oluşturulacak ve, her dosya indirildiği taktirde sunucudan silinecek.
* Dosya aktarım sayfalarında anlık linki paylaşabileceğiniz QR kodunuzda google apis kulllanırak otomatik oluşturulucak
* isternirse sil.php sayfası ile 7 günden (size bağlı) eski dosyaları silecek (cronjop oluşturularak otomatik silme gerçekleştirilebilir.)
* Dosya yükleme ve indirme aynı sayfa üzerinden gerçekleşecek. İstenirse karşılık dosya gönder-alma işlemi yapılabilinecektir.

# EN
# Sending files by creating instant links
* The biggest advantage of this system is that it can do all the work with simple codes without using a database or any database center.
* By creating a personal link with php, people will be able to share files among themselves with this link.
* Your QR code, where you can share the instant link on the file transfer pages, will be automatically created by using google apis.
* Each file will be deleted from the server once it is downloaded.
* If desired, it will delete files older than 7 days (up to you) with the delete.php page (automatic deletion can be performed by creating a cronjop).
* File upload and download will take place on the same page. If desired, it will be possible to send and receive files in return.


# Screenshots
# Anasayfa link oluşturma - Homepage, link building
![Drop Link](https://user-images.githubusercontent.com/27200160/197337904-c31593c0-b9a4-472b-ae19-3ef2ceb2e081.png)
# Anasayfa oluşturulan link sayfası - Homepage - created link page
![Drop Link2](https://user-images.githubusercontent.com/27200160/197337909-cbf68c7b-4883-4d25-85b8-88bce457376d.png)
# Dosya Gönderme Sayfası - File Submission Page
![Dosya Transfer](https://user-images.githubusercontent.com/27200160/197337924-44fb5c9b-449d-487a-b90d-f95f1b301e4e.png)
# Dosya silindi ya da gönderilmedi uyarı sayfası - File deleted or failed to send warning page
![drop hata](https://user-images.githubusercontent.com/27200160/197338215-f08e717a-eeb1-41f2-a815-d5f96e93ccf2.png)
