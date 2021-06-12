<?php require_once 'header.php';

if (isset($_SESSION['userkullanici_mail'])) {

    $etkinliksor = $db->prepare("SELECT * FROM etkinlik  order by  etkinlik_tarih DESC");
    $etkinliksor->execute();
?>
    

    <div class="category-product-list bg-secondary section-space-bottom">
        <div class="container">
            <div class="inner-page-main-body"><br>
                <div class="page-controls">

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view-style2">
                                <?php  ($etkinlikler = $etkinliksor->fetch(PDO::FETCH_ASSOC))  ?>
                                    <div class="single-item-list">
                                        <div class="item-img">
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                
                                            </div>
                                            

                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                    <span>
                                                    <br><br><br>  <?php echo "<center><h1>Bizimle İletişime Geçin<h1><h3><br> Görüş ve önerileriniz bizler için her zaman önemlidir.<br>Bizlere görüşlerinizi iletmek için Mail Gönderebilrisiniz. </center><h3>"  ?></span>
                                                </div>
                                            </div>

                                                <br><br><br>
                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img height="75" width="75" src="img\profile\mehmetprofil.jpg" alt="profile" class="img-responsive img-circle" ></div><br> </br>
                                                  <br> </br> <span><?php echo "<b> <h4> Mehmet Yağcı </h4></b>" ?></span>
                                                </div><br> </br>
                                                <a href="mailto:mehmet__y97@hotmail.com"><button class="btn btn-success btn-m">Mail Gönder</button></a><br></br>
                                            </div>
                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                <br> </br> <div class="img-wrapper"><img height="75" width="75" src="img\profile\ahmetprofil.jpg" alt="profile" class="img-responsive img-circle" ></div><br> </br><br> </br>
                                                    <span><?php echo "<b> <h4> Ahmet Demirayak </h4></b>" ?></span>
                                                </div><br> </br>
                                                <a href="mailto:ahmetdmrykk@gmail.com"><button class="btn btn-success btn-m">Mail Gönder</button></a><br> </br>
                                            </div>
                                            <div class="item-profile-list">
                                                <div class="profile-title">
                                                <br> </br>    <div class="img-wrapper"><img height="75" width="75" src="img\profile\nesprofil.jpg" alt="profile" class="img-responsive img-circle" ></div><br> </br>
                                                    <span><?php echo "<b> <h4> Neslihan Çelik </h4></b>" ?></span>
                                                </div>
                                                <a href="mailto:nescelik96@gmail.com"><button class="btn btn-success btn-m">Mail Gönder</button></a><br> </br>
                                            </div>
                                            <br> </br>
                                            
                                        </div>
                                    </div>
                                <?php
                                 ?>
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