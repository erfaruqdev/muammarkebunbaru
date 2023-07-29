<script src="<?= base_url('template') ?>/plugins/autoNumeric.js"></script>
<script>
    $('[data-mask]').inputmask();

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    const errorAlert = message => {
        toastr.error(`Opss.! ${ message }`)
    }

    $('body').on('keyup', e => {
        if (e.keyCode == 113) {
            $('#modal-payment').modal('show')
        }
    })

    $('#nominal').autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aForm: true,
        vMax: '999999999',
        vMin: '-999999999'
    });

    $(function() {
        loadData()
    })

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        $.ajax({
            url: '<?= base_url() ?>payment/loaddata',
            method: 'POST',
            data: {
                name: $('#changeName').val(),
                method: $('#changeMethod').val()
            },
            success: function(res) {
                $('#load-data').html(res)
            },
            complete: function() {
                $('#loader').hide()
            }
        })
    }

    $('#modal-payment').on('shown.bs.modal', () => {
        $('#id').focus().val('')
    })

    $('#modal-payment').on('hidden.bs.modal', () => {
        $('#id').val('')
        $('#method').val('')
        $('#nominal').prop('readonly', true)
        $('#nominal').val('')
        $('#id-result').val(0)
        $('#nominal-result').html('')
        $('#name-result').html('')
    })

    $('#id').on('focusin', () => {
        $('#id').focus().val('')
        $('#id-result').val(0)
        $('#nominal-result').html('')
        $('#mmu-result').html('')
        $('#nominal').prop('readonly', true).val('')
    })

    $('#id').on('keyup', function(e) {
        let method = $('#method').val()
        let id = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && id == '') {
            return false
        }

        if (key == 13 && method == '') {
            errorAlert('Metode pembayaran belum dipilih')
            return false
        }

        checkID(id)
    })

    $('#nominal').on('keyup', function(e) {
        let method = $('#method').val()
        let nominal = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && nominal == '') {
            return false
        }

        if (key == 13 && method == '') {
            errorAlert('Metode pembayaran belum dipilih')
            return false
        }

        let id = $('#id-result').val()

        save(id, nominal)
    })

    const checkID = id => {
        $.ajax({
            url: '<?= base_url() ?>payment/checkid',
            method: 'POST',
            data: {
                id
            },
            dataType: 'JSON',
            success: function(res) {
                let status = res.status
                if (status != 200) {
                    errorAlert(res.message)
                    $('#id').focus().val('')
                    $('#nominal').prop('readonly', true).val('')
                    return false
                }
                $('#id').val('')
                $('#nominal').prop('readonly', false).focus().val('')
                $('#id-result').val(res.id)
                $('#nominal-result').html(res.sisa)
                $('#name-result').html(res.mmu)
            }
        })
    }


    const save = (id, nominal) => {
        $.ajax({
            url: '<?= base_url() ?>payment/save',
            method: 'POST',
            data: {
                method: $('#method').val(),
                id,
                nominal
            },
            dataType: 'JSON',
            success: function(res) {
                console.log(res);
                if (res.status != 200) {
                    errorAlert(res.message)
                    $('#id').focus()
                    return false
                }
                $('#id').focus()
                loadData()
                $('#invoice').val(res.message)

                let invoice = $('#invoice').val()
                if (invoice != 0) {
                    Swal.fire({
                        title: 'Pembayaran Sukses....',
                        icon: 'success',
                        html: 'Otomatis print invoice dalam <strong>1</strong> detik.<br/><br/>',
                        timer: 1000,
                        timerProgressBar: true
                    })
                    setTimeout(function() {
                        $('#form-print').submit()
                    }, 1000)
                }
            }
        })
    }

    const changeMethod = el => {
        let method = $(el).val()
        if (method == '') {
            errorAlert('Metode harus diisi. Jangan biarkan kosong')
            return false
        }
        $('#id').focus().val('')
    }
</script>
</body>

</html>