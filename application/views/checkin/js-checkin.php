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
            $('#mmu-id').focus()
        }
    })

    const loadData = () => {
        $.ajax({
            url: '<?= base_url() ?>checkin/loaddata',
            method: 'POST',
            success: res => {
                $('#show-data').html(res)
            }
        })
    }

    $(function() {
        loadData()
    })

    $('#mmu-id').on('keyup', function(e) {
        let id = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && id == '') {
            return false
        }

        checkIn(id)
    })

    const checkIn = id => {
        $.ajax({
            url: '<?= base_url() ?>checkin/checkin',
            method: 'POST',
            data: {
                id
            },
            success: function(res) {
                $('#mmu-id').focus().val('')
                $('#show-result').html(res)
                loadData()
            }
        })
    }

    const deleteRegistration = id => {
        Swal.fire({
            title: 'Yakin, nih?',
            text: 'Data akan dihapus permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin, dong',
            cancelButtonText: 'Nggak jadi'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>checkin/delete',
                    method: 'POST',
                    data: {
                        id
                    },
                    dataType: 'JSON',
                    success: function(res) {
                        if (res.status != 200) {
                            errorAlert(res.message)
                        }

                        toastr.success(res.message)
                        $('#show-result').html('')
                        loadData()
                    }
                })
            }
        })
    }
</script>
</body>

</html>