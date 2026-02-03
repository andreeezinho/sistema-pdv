    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.6.6/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script src="<?= URL_SITE ?>/public/js/script.js"></script>
</body>
</html>

<script>
    $('#cep').mask('00000-000');
    $('#cpf').mask('000.000.000-00');
    $('#telefone').mask('(00) 00000-0000');

    if($('#cep')){
        $('#cep').blur(function() {
            $.ajax({
                type: "GET",
                url: "https://viacep.com.br/ws/"+$(this).val()+"/json/",
                dataType: "JSON",
                success: function(response){
                    $('#uf').val(response.uf);
                    $('#ibge').val(response.ibge);
                    $('#cidade').val(response.localidade);
                    $('#rua').val(response.logradouro);
                    $('#bairro').val(response.bairro);
                    $('#complemento').val(response.complemento);
                }
            });
        });
    }

    if($('#documento')){
        $('#documento').blur(function() {
            console.log("https://api.opencnpj.org/{CNPJ}/"+$(this).val());
            $.ajax({
                type: "GET",
                url: "https://publica.cnpj.ws/cnpj/"+$(this).val(),
                dataType: "JSON",
                success: function(response){
                    $('#razao_social').val(response.razao_social);
                    $('#nome_fantasia').val(response.nome_fanntasia);
                    $('#ie_rg').val(response.estabelecimento.inscricoes_estaduais[0].inscricao_estadual);
                    $('#codigo').val(response.estabelecimento.estado.ibge_id);
                }
            });
        });
    }

    $(window).on("beforeunload", function() {
        navigator.sendBeacon("/logout");
    });

</script>