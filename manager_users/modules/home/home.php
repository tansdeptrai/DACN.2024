<?php
$listProducts = getRaw("SELECT  vp.product_id, MIN(vp.id) AS id ,MIN(vp.image) AS image,MIN(vp.price) AS price, MAX(p.name) AS product_name
FROM variant_products vp
INNER JOIN products p ON vp.product_id = p.id GROUP BY vp.product_id ORDER BY RAND() LIMIT 4");
$listProductsCate1 = getRaw("SELECT vp.id, vp.product_id, vp.image, vp.cate_id, vp.color_id, vp.price, (p.name) AS product_name
FROM variant_products  vp
INNER JOIN products p ON vp.product_id = p.id 
INNER JOIN danhmuc d ON vp.cate_id = d.id WHERE vp.cate_id IN (1,5) ORDER BY RAND() LIMIT 8   
");
$listProductsCate2 = getRaw("SELECT vp.id, vp.product_id, vp.image, vp.cate_id, vp.color_id, vp.price, (p.name) AS product_name, (p.image) AS image_pro, (p.id) AS id_pro
FROM variant_products  vp
INNER JOIN products p ON vp.product_id = p.id 
INNER JOIN danhmuc d ON vp.cate_id = d.id WHERE vp.cate_id IN (3,4) ORDER BY RAND() LIMIT 8
");
// 
 $data = [
   'pageTitle' => 'Trang Chủ',
];
layouts('headers/header-view-user', $data);
?>
<!-- Body HTML -->
<header>
<div id="carouselExampleAutoplaying" class="carousel slide" style="top: 90px;" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class=" img-banner carousel-item active ">
      <img  src="https://gamek.mediacdn.vn/133514250583805952/2021/10/3/-16332562381051358470816.jpg" class="d-block w-100" alt="...">
    </div>
    <div class=" img-banner carousel-item">
      <img src="https://i.vietgiaitri.com/2022/6/19/t1-gianh-chien-thang-vat-va-trong-tran-dau-dau-tien-cua-minh-tai-lck-mua-he-2022-d78-6500746.jpg" class="d-block w-100" alt="...">
    </div>
    <div class=" img-banner carousel-item">
      <img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t39.30808-6/455957366_1035047618029060_5220692960013410831_n.jpg?stp=dst-jpg_s960x960&_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeE3rff4v_MmoAtdY0qQa5FMpqEpECpSE-ymoSkQKlIT7IQ3wFC0o832tinLtM3F69MepB9p6mENEoWXknIJVIdp&_nc_ohc=FX46D-1hVpsQ7kNvgE_wi39&_nc_ht=scontent.fhan3-3.fna&_nc_gid=AdbFRdM1G6ctZlXN-y9JaA5&oh=00_AYA8EK4-hIlVYFH0vNndxmTLJ3SYOBbxHYKQu2P5hIKsKw&oe=66F9848D" class="d-block w-100" alt="...">
    </div>
    <div class=" img-banner carousel-item">
      <img src="https://scontent.fhan4-3.fna.fbcdn.net/v/t39.30808-6/448431866_995974128603076_6915809484177943967_n.jpg?stp=dst-jpg_s960x960&_nc_cat=100&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGuxPTy9cp2VFnANx3D5Yj_eyhc-vnDnxN7KFz6-cOfE55RMKl-bH84dD0DcMJgjU6CDHpukhkMILKcFFT73Clw&_nc_ohc=Hs31ZRZL6toQ7kNvgHm6PyN&_nc_ht=scontent.fhan4-3.fna&_nc_gid=AgX1GNsU9oiSjD1IUJ5NSLF&oh=00_AYCMa2QPhysBNwcawm4ClqLd41dJEynXxr0HIw5VazB7NA&oe=66F97526" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</header>
<main>
  <!-- HEADER-MAIN -->
  <div class="container-pro">
          <div class="row d-flex  mt-5 ">
              <div class="col-sm d-flex justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"  class="bi bi-truck color-icons" viewBox="0 0 16 16">
              <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
              </svg>
              <div class="ps-3">
                <p class="fw-bold fs-5" style="margin-bottom: 0px;">Miễn Phí Giao Hàng </p>
                <p class="paragraph">Đơn hàng có giá trị từ 500.000 VNĐ</p>
              </div>
            </div>
            <div class="col-sm d-flex justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-wallet2 pt-2 color-icons" viewBox="0 0 16 16">
              <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
              </svg>
              <div class="ps-3">
                <p class="fw-bold fs-5" style="margin-bottom: 0px;">Thanh Toán Khi Nhận Hàng(COD) </p>
                <p class="paragraph">Giao hàng trên toàn quốc</p>
              </div>
            </div>
            <div class="col-sm d-flex justify-content-center ps-5">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-archive pt-1 color-icons" viewBox="0 0 16 16">
              <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
              </svg>
              <div class="ps-3">
                <p class="fw-bold fs-5" style="margin-bottom: 0px;">Đổi Hàng Miễn Phí </p>
                <p class="paragraph">Trong 30 ngày kể từ ngày mua</p>
              </div>
            </div>
          </div>
  </div>
  <hr>
  <!-- END -->
  <!-- CONTENT-MAIN -->
   <div class="container-main">
      <div class="coupon">
        <h2 class="fw-bolder mt-4 mb-4">Ưu Đãi Nổi Bật</h2>
        <div class="d-flex justify-content-between ">
        <div class="d-flex">
          <div class="box-left">
              <div class="text-sale">
                <p>Voucher 50K</p>
                <p>Giảm 50k cho đơn từ 999k</p>
                <p>HSD: 2024-09-30</p>
              </div>
          </div>
          <div class="line"></div>
          <div class="box-right">
            <button class="btn-cuopon" type="submit">
              Lưu
            </button>
          </div>
        </div>
        <div class="d-flex">
          <div class="box-left">
              <div class="text-sale">
                <p>Voucher 100K</p>
                <p>Giảm 50k cho đơn từ 599k</p>
                <p>HSD: 2024-09-30</p>
              </div>
          </div>
          <div class="line"></div>
          <div class="box-right">
            <button class="btn-cuopon" type="submit">
              Lưu
            </button>
          </div>
        </div>
        <div class="d-flex">
          <div class="box-left">
              <div class="text-sale">
                <p>Voucher 500K</p>
                <p>Giảm 50k cho đơn từ 9.999k</p>
                <p>HSD: 2024-09-30</p>
              </div>
          </div>
          <div class="line"></div>
          <div class="box-right">
            <button class="btn-cuopon" type="submit">
              Lưu
            </button>
          </div>
        </div>
        </div>
      </div>
      <div class="sale-pro">
        <h2 class="fw-bolder mt-5 mb-4">DEAL SỐC</h2>
        <div class="row">
          <?php 
            foreach ($listProducts as $items) :
          ?>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
              <a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>">
                <img src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                <button class="btn-add" type="submit">Xem Sản Phẩm</button>
              </a>
              </div>
              <div class="infor-pro">
                <p><a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>" style="text-decoration: none; color: gray;"><?php echo $items['product_name']?></a></p>
                <p><?php echo number_format($items['price'], 0, ',', '.') . ' VNĐ';?></p>
                <p>199.000 VNĐ</p>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
      <!-- San Pham Moi --> 
      <div class="sale-pro">
        <h2 class="fw-bolder mt-5 mb-4">Sản Phẩm Mới</h2>
        <div class="row">
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="#">
                  <img src=".\templates\images\BannerNu.webp" alt="" srcset="">
                </a>
              </div>
            </div>
          </div>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="#">
                  <img src=".\templates\images\bannerNam.webp" alt="" srcset="">
                </a>
              </div>
            </div>
          </div>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="#">
                  <img src=".\templates\images\bannerBetrai.webp" alt="" srcset="">
                </a>
              </div>
            </div>
          </div>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="">
                  <img src=".\templates\images\BannerBegai.webp" alt="" srcset="">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sale-pro mt-4 mb-4 px-2 ps-2">
        <img style="width: 1195px; height:auto;" src="https://media.canifa.com/Simiconnector/Ao_phong_block_home_desktop-29.07.webp" alt="" srcset="">
      </div>
      <div class="sale-pro">
        <div class="row">
          <?php 
            $uniqueImages = [];
            foreach ($listProductsCate1 as $items) :
              if (in_array($items['image'], $uniqueImages)) {
                continue;
            }
          ?>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>">
                  <img src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                  <button class="btn-add" type="submit">Xem Sản Phẩm</button>
                </a>
              </div>
              <div class="infor-pro">
                <p><a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>" style="text-decoration: none; color: gray;"><?php echo $items['product_name']?></a></p>
                <p><?php echo number_format($items['price'], 0, ',', '.') . ' VNĐ';?></p>
                <p>199.000 VNĐ</p>
              </div>
            </div>
          </div>
          <?php 
          $uniqueImages[] = $items['image'];
          endforeach;
          ?>
        </div>
      </div>
      <!--  -->
      <div class="sale-pro mt-5 mb-4 px-2 ps-2">
        <img style="width: 1195px; height:auto;" src="https://media.canifa.com/Simiconnector/Polo_block_home_Desktop-29.07.webp" alt="" srcset="">
      </div>
      <div class="sale-pro">
        <div class="row">
          <?php 
            foreach ($listProductsCate2 as $items) :
          ?>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>">
                  <img src="uploads/<?php echo $items['image_pro'];?>" alt="" srcset="">
                  <button class="btn-add" type="submit">Xem Sản Phẩm</button>
                </a>
              </div>
              <div class="infor-pro">
                <p><a href="<?php echo _WEB_HOST;?>?module=home&action=detailProduct&id=<?php echo $items['product_id'];?>" style="text-decoration: none; color: gray;"><?php echo $items['product_name']?></a></p>
                <p><?php echo number_format($items['price'], 0, ',', '.') . ' VNĐ';?></p>
                <p>199.000 VNĐ</p>
              </div>
            </div>
          </div>
          <?php 
          endforeach;
          ?>
        </div>
      </div>
      <!--  -->
      <div class="sale-pro mt-4 mb-4 px-2 ps-2">
        <img style="width: 1195px; height:auto;" src="https://media.canifa.com/Simiconnector/Shorts_block_home_Desktop-29.07.webp" alt="" srcset="">
      </div>
      <div class="sale-pro">
        <div class="row">
          <?php 
            $uniqueImages = [];
            foreach ($listProductsCate2 as $items) :
              if (in_array($items['image'], $uniqueImages)) {
                continue;
            }
          ?>
          <div class="pro col">
            <div class=" pro px-2">
              <div class="img-pro">
                <img src="uploads/<?php echo $items['image'];?>" alt="" srcset="">
                <button class="btn-add" type="submit">Xem Sản Phẩm</button>
              </div>
              <div class="infor-pro">
                <p><a href="<?php echo _WEB_HOST;?>?module=layout&action=detailProduct&id=<?php echo $items['product_id']?>" style="text-decoration: none; color: gray;"><?php echo $items['product_name']?></a></p>
                <p><?php echo number_format($items['price'], 0, ',', '.') . ' VNĐ';?></p>
                <p>199.000 VNĐ</p>
              </div>
            </div>
          </div>
          <?php 
          $uniqueImages[] = $items['image'];
          endforeach;
          ?>
        </div>
      </div>
   </div>
  <!--  -->
</main>
<?php
layouts('footers/footer-view-user');
 
