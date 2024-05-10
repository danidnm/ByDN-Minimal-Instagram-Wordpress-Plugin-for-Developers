<div class="bydn-instagram-posts">
    <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
            <div class="bydn-instagram-post">
                <a href="<?php echo esc_url($post->url); ?>">
                    <img src="<?php echo esc_url($post->url); ?>" />
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se han encontrado post en Instagram.</p>
    <?php endif; ?>
</div>
