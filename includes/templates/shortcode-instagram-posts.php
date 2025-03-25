<div class="bydn-instagram-posts">
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="bydn-instagram-post">
                <a href="<?php echo esc_url($post->permalink); ?>" target="_blank">
                    <?php
                    $imageUrl = $post->thumbnail_url;
                    if (empty($imageUrl)) {
                        $imageUrl = $post->url;
                    }
                    ?>
                    <img src="<?php echo esc_url($imageUrl); ?>" alt="<?php echo esc_attr($post->caption); ?>" />
                </a>
                <p><?php echo esc_attr($post->caption); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se han encontrado post en Instagram.</p>
    <?php endif; ?>
</div>
