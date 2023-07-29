<script>
    $('[data-mask]').inputmask();

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    $('body').on('keyup', e => {
        if (e.keyCode == 113) {
            $('#changeName').focus().val('')
        }
    })

    $(function() {
        loadData()
    })

    $('#changeZone').on('change', function() {
        $('#zone').val($(this).val())
    })

    const loadData = () => {
        $('#loader').show()
        $('#show-school').html('')
        
        let zone = $('#changeZone').val()
        let name = $('#changeName').val()
        $.ajax({
            url: '<?= base_url() ?>school/getdata',
            method: 'POST',
            data: {
                zone,
                name
            },
            success: function(response) {
                $('#show-school').html(response)
            },
            complete: function() {
                $('#loader').hide()
            }
        })
    }

    function copyToClipboard(text) {
        var sampleTextarea = document.createElement("textarea");
        document.body.appendChild(sampleTextarea);
        sampleTextarea.value = text; //save main text in it
        sampleTextarea.select(); //select textarea contenrs
        document.execCommand("copy");
        document.body.removeChild(sampleTextarea);
        toastr.success('ID berhasil disalin ke clipboard')
    }
</script>
</body>

</html>