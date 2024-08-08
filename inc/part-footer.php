<footer class="site-footer container p-0" id="colophon">
    <div class="card m-0 bg-light rounded-0 border-0 shadow">
        <?php if (is_active_sidebar('footer-widget-1')) : ?>
            <div class="velocity-footer border-top">
                <div class="row footer-widget text-start mx-auto px-2 pt-4">
                    <?php for ($x = 1; $x <= 4; $x++) {
                        if (is_active_sidebar('footer-widget-' . $x)) : ?>
                            <div class="col-md">
                                <?php dynamic_sidebar('footer-widget-' . $x); ?>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="site-info bg-colortheme border-top text-center text-light p-2">
        <small>
            Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
        </small>
        <br>
        <small class="opacity-50">
            Design by <a class="text-light" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->
</footer>