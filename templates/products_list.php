<?php
/**
 * @var \Ecwid\Best_Sellers\Product $product
 */
?>

<section id="ecwidlatestproducts-3" class="widget widget_ecwidlatestproducts">
    <!-- noptimize -->
    <script data-cfasync="false" type="text/javascript" src="https://app.ecwid.com/script.js?15362109&amp;data_platform=wporg"></script>
    <script type="text/javascript">
        if (jQuery && jQuery.mobile) {
            jQuery.mobile.hashListeningEnabled = false;
            jQuery.mobile.pushStateEnabled = false;
        }
    </script>
    <!-- /noptimize -->
    <div class="ecwidlatestproducts ecwid-productsList width-l" data-ecwid-max="3" data-ecwidlatestproducts-initialized="1">
        <ul>
            <li class="ecwid-productsList-product-<?php echo $product->id ?> show">
                <a href="<?php echo $product->link ?>" title="<?php echo $product->name ?>">
                    <div class="ecwid-productsList-image">
                        <img src="<?php echo $product->picture ?>">
                    </div>
                    <div class="ecwid-productsList-name"><?php echo $product->name ?></div>
                    <div class="ecwid-productsList-price ecwid-productBrowser-price"><?php echo $product->price ?>р.</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="ecwid-initial-productsList-content">
        <a class="product" href="<?php echo $product->link ?>"
           data-ecwid-page="product"
           data-ecwid-product-id="<?php echo $product->id ?>" alt="<?php echo $product->name ?>"
           title="Kinder">
            <div class="ecwid ecwid-SingleProduct ecwid-Product ecwid-Product-<?php echo $product->id ?> loaded"
                 data-single-product-link="<?php echo $product->link ?>" itemscope=""
                 itemtype="http://schema.org/Product" data-single-product-id="<?php echo $product->id ?>"
                 style="font-size: 14px;">
                <form>
                    <div itemprop="image" data-force-image="<?php echo $product->picture ?>">
                        <div class="ecwid-SingleProduct-picture" style="">
                            <img class="gwt-Image"
                                 src="<?php echo $product->picture ?>"
                                 alt="Kinder" title="<?php echo $product->name ?>"
                                 itemprop="image"
                                 srcset="<?php echo $product->picture ?> 1x, <?php echo $product->picture ?> 2x"
                                 style="width: 270px; height: 270px; margin: auto;"
                            >
                        </div>
                    </div>
                    <div class="ecwid-title" itemprop="name"><?php echo $product->name ?></div>
                    <div itemtype="http://schema.org/Offer" itemscope="" itemprop="offers">
                        <div class="ecwid-productBrowser-price ecwid-price" itemprop="price" content="<?php echo $product->price ?>">
                            <div>
                                <div><?php echo $product->price ?>р.</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- noptimize -->
            <script type="text/javascript">xSingleProduct();</script>
            <div id="SingleProduct-1" class="ecwid">
                <div>
                    <div></div>
                </div>
            </div><!-- /noptimize -->
        </a>
        <script type="text/javascript">
            <!--
            jQuery(document).ready(function () {
                jQuery('.ecwidlatestproducts:not([data-ecwidlatestproducts-initialized=1])').productsList().attr('data-ecwidlatestproducts-initialized', 1);
            });
            -->
        </script>
    </div>
</section>