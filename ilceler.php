<?php require_once 'header.php';

if (isset($_SESSION['userkullanici_mail'])) {


    $sehircek = @$_GET['durum'];
    $ilcesor = $db->prepare("SELECT * FROM ilce where il_id='$sehircek'");
    $ilcesor->execute();
    $sehirPlaka = $ilcesor->fetch(PDO::FETCH_ASSOC);
    $ID = $sehirPlaka['il_id'];

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik WHERE il_id='$sehircek'"); //Block 
    $etkinliksor->execute();
    $etkinliksor2 = $db->prepare("SELECT * FROM etkinlik WHERE il_id='$sehircek'"); //Row
    $etkinliksor2->execute();
    $etkinlikadet = $db->prepare("SELECT COUNT(*) AS toplam FROM etkinlik WHERE il_id='$sehircek'"); //Boş kontrol
    $etkinlikadet->execute();
    $etkinliksayi = $etkinlikadet->fetch(PDO::FETCH_ASSOC);

    $sehirsor = $db->prepare("SELECT * FROM il WHERE il_id=$ID");
    $sehirsor->execute();
    $sehirAd = $sehirsor->fetch(PDO::FETCH_ASSOC);

?>

    <form action="nedmin/netting/kullanici.php" enctype="multipart/form-data" name="etkinlikkurr" method="POST" class="form-horizontal" id="personal-info-form">
        <div class="pagination-area bg-secondary">
            <div class="container">
                <div class="pagination-wrapper">
                    <ul>
                        <li><a href="sehir.php">Şehir</a><span> -</span></li>
                        <li>İlçeler</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="category-product-list bg-secondary section-space-bottom">
            <div class="container">
                <div class="inner-page-main-body">
                    <div class="page-controls">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8">


                                <div class="page-controls-sorting display-none-in-mobile">
                                    <div class="dropdown">
                                        <b><?php echo $sehirAd['il_ad']; ?></b>

                                        <ul class="product-categories-list dropdown-menu">
                                            <!-- İLCE DROPDOWN LİST -->
                                            <?php while ($ilcecek = $ilcesor->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <li><a href="#"><?php echo $ilcecek['ilce_ad'] ?><span>
                                                            <?php

                                                            ?><?php  ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>



                                <div class="page-controls-sorting">
                                    <div class="dropdown">

                                        <div>ETKİNLİK</div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                <div class="layout-switcher">
                                    <ul>
                                        <li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>
                                        <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($etkinliksayi['toplam'] > 0) { ?>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade clear products-container" id="gried-view">
                                <div class="product-grid-view padding-narrow">





                                    <div class="row">
                                        <!-- Block kategori-->
                                        <?php while ($etkinlikcek = $etkinliksor->fetch(PDO::FETCH_ASSOC)) { ?>

                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="single-item-grid">
                                                    <div class="item-img">
                                                        <img src="<?php echo $etkinlikcek['etkinlik_foto']; ?>" height="15px" alt="product" style="height:200px;">

                                                    </div>
                                                    <div class="item-content">
                                                        <div class="item-info">
                                                            <span><?php echo $etkinlikcek['etkinlik_tarih']; ?></span>

                                                            <div class="price"><?php $tut = $etkinlikcek['ilce_id'];

                                                                                $SehirSor = $db->prepare("SELECT * FROM ilce WHERE ilce_id=:ilce_id");
                                                                                $SehirSor->execute([
                                                                                    'ilce_id' => $tut
                                                                                ]);
                                                                                $row = $SehirSor->fetch(PDO::FETCH_ASSOC);
                                                                                echo $row['ilce_ad']; ?></div>
                                                        </div>
                                                        <div class="item-info">
                                                            <span>Etkinlik Başlığı:</span>
                                                            <h3><?php echo $etkinlikcek['etkinlik_baslik']; ?></h3>

                                                            <?php if ($_SESSION['userkullanici_id'] != $etkinlikcek['kullanici_id']) { ?>
                                                                <input type="hidden" id="etkinlik_id" value="<?php echo $etkinlikler['etkinlik_id']; ?> " name="etkinlik_id">
                                                                <button class="btn btn-primary btn-md" type="submit" name="gonder" id="gonder " onclick="incele();"> Etkinliği incele</button>
                                                            <?php } ?>
                                                        </div>
                                                        <?php

                                                        $tut1 = $etkinlikcek['kullanici_id'];

                                                        $yayinlayan = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id");
                                                        $yayinlayan->execute([
                                                            'kullanici_id' => $tut1
                                                        ]);
                                                        $row1 = $yayinlayan->fetch(PDO::FETCH_ASSOC); ?>

                                                        <div class="item-profile">
                                                            <div class="profile-info">

                                                                <span>
                                                                    <div><b>Yayınlayan:</b>
                                                                        <font color="green" size="2"><b><?php echo $row1['kullanici_ad'] . " " . $row1['kullanici_soyad'] ?></font></b>
                                                                    </div>
                                                                </span>&#160;
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                                <div class="product-list-view-style2">
                                    <!--Satır listesi-->
                                    <?php while ($etkinlikcek2 = $etkinliksor2->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <div class="single-item-list">
                                            <div class="item-img">
                                                <img src="<?php echo $etkinlikcek2['etkinlik_foto'] ?>" alt="product" class="img-responsive">
                                            </div>
                                            <div class="item-content">
                                                <div class="item-info">
                                                    <div class="item-title">
                                                        <h3><a href="#"><?php echo $etkinlikcek2['etkinlik_baslik'] ?></a></h3>
                                                        <span><?php echo $etkinlikcek2['etkinlik_tarih'] ?></span>
                                                    </div>
                                                    <div class="item-description">
                                                        <p><?php echo $etkinlikcek2['etkinlik_aciklama'] ?> </p>
                                                    </div>
                                                    <div class="item-sale-info">
                                                        <div class="price"><?php $tut = $etkinlikcek2['ilce_id'];

                                                                            $SehirSor = $db->prepare("SELECT * FROM ilce WHERE ilce_id=:ilce_id");
                                                                            $SehirSor->execute([
                                                                                'ilce_id' => $tut
                                                                            ]);
                                                                            $row = $SehirSor->fetch(PDO::FETCH_ASSOC);
                                                                            echo '<h4><b>' . $row['ilce_ad']; ?></div>

                                                    </div>
                                                </div>
                                                <div class="item-profile-list">
                                                    <div class="profile-title">
                                                        <?php

                                                        $tut1 = $etkinlikcek2['kullanici_id'];

                                                        $yayinlayan = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id");
                                                        $yayinlayan->execute([
                                                            'kullanici_id' => $tut1
                                                        ]);
                                                        $row1 = $yayinlayan->fetch(PDO::FETCH_ASSOC); ?>
                                                        <div class="img-wrapper"><img src="<?php echo $row1['kullanici_foto'] ?>" width="35px" alt="profile" class="img-responsive img-circle"></div>

                                                    </div>
                                                    <span>
                                                        <font color="green" size="2"><b><?php echo $row1['kullanici_ad'] . " " . $row1['kullanici_soyad']; ?></font></b>
                                                    </span>
                                                    <div class="profile-rating-info">
                                                        <?php if ($_SESSION['userkullanici_id'] != $etkinlikcek2['kullanici_id']) { ?>

                                                        <?php } ?>

                                                    </div>


                                                    <input type="hidden" id="etkinlik_id" value="<?php echo $etkinlikler['etkinlik_id']; ?> " name="etkinlik_id">
                                                    <button class="btn btn-primary btn-md" type="submit" name="gonder" id="gonder " onclick="incele();"> Etkinliği incele</button>

                                                </div>

                                            </div>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($etkinliksayi['toplam'] <= 0) { ?>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade clear products-container" id="gried-view">
                                <div class="product-grid-view padding-narrow">
                                    <div class="row">
                                        <!-- Block kategori-->
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="single-item-grid">
                                                <font color="green" size="4"><b>&#160;&#160;&#160;Şehire ait etkinlik bulunmamaktadır.</font></b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                                <div class="product-list-view-style2">
                                    <font color="green" size="4"><b>&#160;&#160;&#160;Şehire ait etkinlik bulunmamaktadır.</font></b>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>









    </form>
    <?php require_once 'footer.php' ?>
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
                var newHTML = "<div style='color: green;'> *Üyeliğiniz kaydedildi </div>";
                document.getElementById("uyari").innerHTML = newHTML;

            }
        })
    }
</script>