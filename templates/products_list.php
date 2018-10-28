<?php
/**
 * @var \Ecwid\Best_Sellers\Product $products[]
 */
?>

<?php if (!empty($products)): ?>
    <section id="bestsellers_for_ecwid" class="widget widget_bestsellers_for_ecwid">
        <!-- noptimize -->
        <script data-cfasync="false" type="text/javascript" src="https://app.ecwid.com/script.js?15362109&amp;data_platform=wporg"></script>
        <script type="text/javascript">
            if (jQuery && jQuery.mobile) {
                jQuery.mobile.hashListeningEnabled = false;
                jQuery.mobile.pushStateEnabled = false;
            }
        </script>
        <!-- /noptimize -->
        <div class="bestsellers_for_ecwid ecwid-bs-productsList width-l" data-ecwid-max="3" data-bestsellers_for_ecwid-initialized="1">
            <ul>
                <?php foreach($products as $product): ?>
                    <li class="ecwid-bs-productsList-product-<?php echo $product->id ?> show">
                        <a href="<?php echo $product->link ?>" title="<?php echo $product->name ?>">
                            <div class="ecwid-bs-productsList-image">
                                <img src="<?php echo $product->picture ?>">
                            </div>
                            <div class="ecwid-bs-productsList-name"><?php echo $product->name ?></div>
                            <div class="ecwid-bs-productsList-price ecwid-bs-productBrowser-price"><?php echo $product->price ?>р.</div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>