<?php

wp_nonce_field(-1, 'car_cpt_nonce');

?>

<div class="features">
    <div>
        <label for="model">Model</label>
        <input type="text" id="model" name="car_model" value="<?= esc_attr(get_post_meta(get_the_ID(), 'model', true)) ?>">
    </div>
	<div>
        <label for="price">Price monthly</label>
        <input type="number" id="price" name="car_price" value="<?= esc_attr(get_post_meta(get_the_ID(), 'price', true)) ?>">
    </div>
</div>
