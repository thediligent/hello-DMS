<?php 
class Logo_Selector_Control extends WP_Customize_Control {
    public $type = 'logo_selector';

    public function render_content() {
        $logos = get_logo_svgs();
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <select <?php $this->link(); ?>>
                <?php foreach ($logos as $key => $svg) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($this->value(), $key); ?>>
                        <?php echo esc_html(ucfirst($key)); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <div class="logo-preview">
            <?php foreach ($logos as $key => $svg) : ?>
                <div class="logo-preview-item" data-logo="<?php echo esc_attr($key); ?>" style="display: <?php echo $this->value() === $key ? 'block' : 'none'; ?>">
                    <?php echo $svg; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <style>
            .logo-preview svg {
                max-width: 100%;
                height: auto;
                max-height: 100px;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selector = document.getElementById('<?php echo $this->id; ?>');
                var previewItems = document.querySelectorAll('.logo-preview-item');

                function updatePreview() {
                    var selected = selector.value;
                    previewItems.forEach(function(item) {
                        if (item.getAttribute('data-logo') === selected) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }

                // Update preview on page load
                updatePreview();

                // Update preview when selection changes
                selector.addEventListener('change', updatePreview);

                // Listen for Customizer changes
                if (wp.customize) {
                    wp.customize.bind('preview-ready', function() {
                        wp.customize('selected_logo', function(setting) {
                            setting.bind(function(newValue) {
                                selector.value = newValue;
                                updatePreview();
                            });
                        });
                    });
                }
            });
        </script>
        <?php
    }
}
?>