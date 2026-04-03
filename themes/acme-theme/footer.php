<footer>
    <div class="container">
        <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>

<?php
$settings = acme_get_settings();
?>

<div style="background:#f5f5f5;padding:10px;margin:10px 0;">
    <h3>ACME Settings Test</h3>

    <p><strong>Business Name:</strong> <?php echo esc_html($settings['business_name'] ?? ''); ?></p>

    <p><strong>Business Hours:</strong> <?php echo esc_html($settings['business_hours'] ?? ''); ?></p>

    <p><strong>Google Map:</strong> 
        <a href="<?php echo esc_url($settings['map_link'] ?? ''); ?>" target="_blank">
            View Location
        </a>
    </p>
</div>

</body>
</html>