    </div>
        </div>


        <?php if (empty($script)) {
            $script = '
    <script src="/build/js/app_1.2.js" defer></script>
    <script src="/build/js/dashboard_1.2.js" defer></script>
    ';
        } else {
            $script .= '
    <script src="/build/js/app_1.2.js" defer></script>
    <script src="/build/js/dashboard_1.2.js" defer></script>
    ';
        }
    ?>
