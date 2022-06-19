<?php

$vehicles = new WP_Query([
	'post_type' => 'cars'
]);

?>

<section id="premium-cars">
	<?php if ($vehicles->have_posts()): ?>
		<?php while ($vehicles->have_posts()): $vehicles->the_post() ?>
            <a href="#">
                <div class="vehicle">
                    <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                    <p>
                        <?= the_title() ?> <?= get_post_meta(get_the_ID(), 'price', true) . ' €/monthly' ?>
                    </p>
                </div>
            </a>
		<?php endwhile; ?>
	<?php endif; ?>
</section>


