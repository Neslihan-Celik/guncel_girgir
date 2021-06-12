<?php require_once 'header.php';

if (isset($_SESSION['userkullanici_mail'])) {

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();
?>
    <div class="inner-banner-area">
        <div class="container">
            <div class="inner-banner-wrapper">

                <br><br><br><br><br><br><br><br>

                <br><br>
                <h1>
                    <font face="Garamond" color="#EEEEEE">Doğru tercih edilmiş bir etkinlik kur, arkadaşlar edin ve GırGır'la eğlenceye hemen başla!</font>
                </h1>
            </div>
        </div>
    </div>

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
                                            <img src="<?php echo $etkinlikler['etkinlik_foto'] ?>" width="181" height="147" alt="product" style="height: 160px;">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <h3><a href="#"><?php echo '<b>' .$etkinlikler['etkinlik_baslik'] .'</b>' ?></a></h3>
                                                    <span><?php echo $etkinlikler['etkinlik_tarih'] ?></span>
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
                                                        echo '<h4><b>' . $sehir['il_ad'] . '/' . $sehir['ilce_ad'] . '</b></h4>';
                                                        ?>
                                                    </div>

                                                </div>

                                            </div>
                                            <span>

                                                <?php echo "Katılımcı  sayısı : ";
                                                $id = $etkinlikler['etkinlik_id'];
                                                $bilgi = $db->prepare("SELECT  count(DISTINCT kullanici_id) as toplam FROM etkinlik_katilan  where etkinlik_id=$id");
                                                $bilgi->execute();
                                                $kisiSayisi = $bilgi->fetch(PDO::FETCH_ASSOC);
                                                echo '<h7>' . $kisiSayisi['toplam']  . '</h7><br>';
                                                ?>
                                            </span>



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
                                                </div>

                                                <font color="green" size="2"><b><?php

                                                                                echo $row1['kullanici_ad'] . " " . $row1['kullanici_soyad'];

                                                                                ?></font>
                                                <div class="profile-rating-info">






                                                    <?php if ($_SESSION['userkullanici_id'] != $etkinlikler['kullanici_id']) { ?>

                                                    <?php } ?></b>
                                                </div>
                                                <form action="etkinlikIncele.php" method="post">
                                                    <input type="hidden" id="etkinlik_id" value="<?php echo $etkinlikler['etkinlik_id']; ?> " name="etkinlik_id">
                                                    <button class="btn btn-primary btn-md btn-block" type="submit" name="gonder" id="gonder " onclick="incele();"> Etkinliği incele</button>
                                                </form>
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






        <?php require_once 'footer.php'
        ?>
    <?php } else {
    header("Location:login");
} ?>

    <script>
        function incele() {
            var etkinlik = $("input[name=etkinlik_id]").val();
            var etkinlik_id = Number(etkinlik);
            $.ajax({
                type: "POST",
                url: "etkinlikIncele.php",
                data: {
                    post_etkinlik_ik: etkinlik_id,

                },
                success: function(sonuc) {
                    var newHTML = "<div style='color: green;'> * </div>";
                    document.getElementById("uyari").innerHTML = newHTML;

                }
            })
        }
    </script>