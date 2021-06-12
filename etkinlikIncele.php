<?php require_once 'header.php';




if (isset($_SESSION['userkullanici_mail'])) {
    if (isset($_POST['gonder'])) {
        $etkinlik_id = $_POST["etkinlik_id"];


        $veri = $etkinlik_id;
    }
    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  where etkinlik_id=$veri");
    $etkinliksor->execute();



?>



    <div class="category-product-list bg-secondary section-space-bottom">
        <div class="container">
            <div class="inner-page-main-body"><br>
                <div class="page-controls">

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view-style2">
                                <?php while ($etkinlikler = $etkinliksor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="single-item-list">
                                        <div class="item-img">
                                            <img src="<?php echo $etkinlikler['etkinlik_foto'] ?>" width="181" height="147" alt="product" class="img-responsive">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <h3><a href="#"><?php echo $etkinlikler['etkinlik_baslik'] ?></a></h3>
                                                    <span><?php echo $etkinlikler['etkinlik_tarih'] ?></span>
                                                </div>
                                                <div class="item-description">

                                                </div>
                                                <div class="item-sale-info">
                                                    <div class="price">
                                                        <?php
                                                        $id = $etkinlikler['ilce_id'];
                                                        $bilgi = $db->prepare("SELECT il.il_id,il.il_ad,ilce.ilce_ad,ilce.ilce_id FROM ilce
																		 JOIN il
																		on il.il_id=ilce.il_id
																		WHERE ilce.ilce_id =$id
																		");
                                                        $bilgi->execute();
                                                        $sehir = $bilgi->fetch(PDO::FETCH_ASSOC);
                                                        echo '<h5><b>' . $sehir['il_ad'] . '/' . $sehir['ilce_ad'] . '</b></h5>';
                                                        ?>
                                                    </div>
                                                    <!-- <div class="sale-qty" >Katılımcı Sayısı</div>-->
                                                    <div class="sale-qty" name="katilimci" id="katilimci">
                                                        <span>


                                                            <?php echo "Katılımcı  sayısı : ";
                                                            $id = $etkinlikler['etkinlik_id'];
                                                            $bilgi = $db->prepare("SELECT  count(DISTINCT kullanici_id) as toplam FROM etkinlik_katilan  where etkinlik_id=$id");
                                                            $bilgi->execute();
                                                            $kisiSayisi = $bilgi->fetch(PDO::FETCH_ASSOC);
                                                            echo '<h7>' . $kisiSayisi['toplam']  . '</h7><br>';
                                                            ?>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>

                                            <?php

                                            $tut1 = $etkinlikler['kullanici_id'];

                                            $yayinlayan = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id");
                                            $yayinlayan->execute([
                                                'kullanici_id' => $tut1
                                            ]);
                                            $row1 = $yayinlayan->fetch(PDO::FETCH_ASSOC); ?>
                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img src="<?php echo $row1['kullanici_foto'] ?>" width="35px" alt="profile" class="img-responsive img-circle"></div>
                                                    <span>




                                                        <?php
                                                        $id = $etkinlikler['kullanici_id'];
                                                        $bilgi = $db->prepare("SELECT * FROM kullanici  where kullanici_id=$id");
                                                        $bilgi->execute();
                                                        $kisi = $bilgi->fetch(PDO::FETCH_ASSOC);
                                                        echo '<h7>Etkinlik düzenleyici : ' . $kisi['kullanici_ad'] . ' ' . $kisi['kullanici_soyad'] . '</h7><br>';

                                                        ?>


                                                        <p><?php echo "Etkinlik açıklaması : " . $etkinlikler['etkinlik_aciklama'] ?></p>

                                                        <p>Adres : <?php echo $etkinlikler['etkinlik_adres'] ?></p>




                                                </div>
                                                </span>

                                            </div>


                                            <br><br>
                                            <div>
                                                <form action="nedmin\netting\kullanici.php" method="post">
                                                    <input type="hidden" id="etkinlik_id" value="<?php echo $etkinlikler['etkinlik_id']; ?> " name="etkinlik_id">
                                                    <input type="hidden" id="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?> " name="kullanici_id">
                                                    <a href="#"> <button id="gonder" type="submit" name="gonder" class="btn btn-success btn-lg btn-block" onclick="katil();"> Katıl </button></a><br>
                                                </form>
                                                <a href="index.php"> <button name="geri" class="btn btn-primary btn-lg btn-block"> İptal</button></a><br>
                                            </div>


                                            <div class="uyari">
                                                <?php
                                            //burası etkinlik katılımıc çekme kısmı
                                                $id = $etkinlikler['kullanici_id'];
                                                $bilgi = $db->prepare("SELECT DISTINCT k.kullanici_id, k.kullanici_ad ,k.kullanici_soyad,k.kullanici_mail,k.kullanici_foto 
                                                            from etkinlik_katilan as ek
                                                            JOIN
                                                            kullanici  as k
                                                            on k.kullanici_id=ek.kullanici_id where etkinlik_id=$veri ");
                                                $bilgi->execute();
                                                echo '<h7><b>Katılımcı Bilgileri</b></h7><br> ';
                                                while ($kisi = $bilgi->fetch(PDO::FETCH_ASSOC)) {

                                                    echo '<h7> ' . $kisi['kullanici_ad'] . ' ' . $kisi['kullanici_soyad'] . '---  ' . $kisi['kullanici_mail'] . '</h7><br>';
                                                }
                                                ?>
                                            </div>


                                        </div>
                                    </div>
                            </div>
                        <?php
                                } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'footer.php' ?>
<?php


} else {
    header("Location:login");
} ?>

<script>
    function katil() {
        var etkinlik = $("input[name=etkinlik_id]").val();
        var etkinlik_id = Number(etkinlik);
        var kullanici = $("input[name=kullanici_id]").val();
        var kullanici_id = Number(kullanici);

        $.ajax({
            type: "POST",
            url: "nedmin\netting\kullanici.php",
            data: {
                post_etkinlik_ik: etkinlik_id,
                post_kullanici_id = kullanici_id

            },
            success: function(sonuc) {
                var newHTML = "<div style='color: green;'> *Etkinlik katılımı başarılı ! </div>";
                document.getElementById("uyari").innerHTML = newHTML;

            }
        })
    }
</script>
<!-- SELECT DISTINCT k.kullanici_id, k.kullanici_ad ,k.kullanici_soyad,k.kullanici_mail,k.kullanici_foto from etkinlik_katilan as ek
JOIN
kullanici  as k
on k.kullanici_id=ek.kullanici_id 
    -->