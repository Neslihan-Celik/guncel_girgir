﻿<?php require_once 'header.php';

if (isset($_SESSION['userkullanici_mail'])) {

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();
	
?>
    <div class="inner-banner-area">
        <div class="container">
            <div class="inner-banner-wrapper">
                <h1>GırGır'a Hoşgeldiniz!</h1>
                <p></p>
                <div class="banner-search-area input-group">
                    <input class="form-control" placeholder="anahtar kelimelerinizi arayın . . ." type="text">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                <p>Doğru tercih edilmiş bir etkinlik kur, arkadaşlar edin ve GırGır'la eğlenceye hemen başla!</p>
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
                                <?php while ($etkinlikler = $etkinliksor->fetch(PDO::FETCH_ASSOC))
													{ ?>
                                    <div class="single-item-list">
                                        <div class="item-img">
                                            <img src="<?php echo $etkinlikler['etkinlik_foto'] ?>" width="181" height="147" alt="product" class="img-responsive">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">  <h3><a href="#"><?php echo $etkinlikler['etkinlik_baslik'] ?></a></h3>
                                                    <span><?php echo $etkinlikler['etkinlik_tarih'] ?></span>
                                                </div>
                                                <div class="item-description">
                                                    <p><?php echo $etkinlikler['etkinlik_aciklama'] ?></p>
                                                </div>
                                                <div class="item-sale-info">
                                                    <div class="price">
														<?php
															$id=$etkinlikler['ilce_id'];
															$bilgi = $db->prepare("SELECT il.il_id,il.il_ad,ilce.ilce_ad,ilce.ilce_id FROM ilce
																		 JOIN il
																		on il.il_id=ilce.il_id
																		WHERE ilce.ilce_id =$id
																		");
															$bilgi->execute();
															$sehir = $bilgi->fetch(PDO::FETCH_ASSOC);
															echo '<h5><b>'.$sehir['il_ad'].'/'.$sehir['ilce_ad'].'</b></h5>';
														?>
													</div>
                                                    <div class="sale-qty">Katılımcı(11)</div>
                                                </div>
                                            </div>
                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img src="img\profile\2.jpg" alt="profile" class="img-responsive img-circle"></div>
                                                    <span><?php
													$id=$etkinlikler['kullanici_id'];
														$bilgi = $db->prepare("SELECT * FROM kullanici  where kullanici_id=$id");
														$bilgi->execute();
														$kisi = $bilgi->fetch(PDO::FETCH_ASSOC);
														echo '<h7>'.$kisi['kullanici_ad'].' '.$kisi['kullanici_soyad'].'</h7>';
														?>
													</span>
                                                </div>
                                                <button class="btn btn-success btn-xs">Etkinliğe Katıl</button>
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
    <?php } else {
    header("Location:login");
} ?>