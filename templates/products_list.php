<?php
/**
 * @var \Ecwid\Best_Sellers\Product $products[]
 * @var bool $has_access
 */
?>

<?php if (!$has_access) {
    echo '<p style="color: red">';
    _e('You should provide access to your Ecwid shop for using widget', 'ecwid-best-sellers');
    echo '</p>';
} ?>

<?php if ($has_access && !empty($products)): ?>
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
                <?php foreach($products as $product): ?>
                    <li class="ecwid-productsList-product-<?php echo $product->id ?> show">
                        <a href="<?php echo $product->link ?>" title="<?php echo $product->name ?>">
                            <div class="ecwid-productsList-image">
                                <img src="<?php echo $product->picture ?>">
                            </div>
                            <div class="ecwid-productsList-name"><?php echo $product->name ?></div>
                            <div class="ecwid-productsList-price ecwid-productBrowser-price"><?php echo $product->price ?>р.</div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>