    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.6/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script src="<?= URL_SITE ?>/public/js/script.js"></script>
</body>
</html>

<script>
    $('#cpf').mask('000.000.000-00');
    $('#telefone').mask('(00) 00000-0000');

    $(window).on("beforeunload", function() {
        navigator.sendBeacon("/logout");
    });

</script>