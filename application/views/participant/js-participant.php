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
            $('#changeName').focus().val('')
        }
    })

    $('#changeCategory').on('change', function (){
        $('#category-participant').val($(this).val())
    })

    $(function() {
        loadData()
    })

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        
        $.ajax({
            url: '<?= base_url() ?>participant/loaddata',
            method: 'POST',
            data: {
                category: $('#changeCategory').val()
            },
            success: function(res) {
                $('#load-data').html(res)
            },
            complete: function() {
                $('#loader').hide()
            }
        })
    }

    $('.form-control').keypress(function(e) {
        if (e.which == 13 && $(this).val() != '') {
            e.preventDefault()
            let $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus().select();
        }
    });

    $('#modal-participant').on('hidden.bs.modal', () => {
        $('#form-participant')[0].reset()
    })

    $('#modal-participant-edit').on('hidden.bs.modal', () => {
        $('#id-edit').val(0)
        clearDataEdit()
    })

    const save = () => {
        let category = $('#category').val()
        let address = $('#address').val()

        if (category == '' || address == '') {
            errorAlert('Pastikan Kategori dan Alamat sudah dipilih/diisi')
            return false
        }

        Swal.fire({
            title: 'Yakin, nih?',
            text: 'Pastikan data diisi dengan benar dan lengkap',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin, dong',
            cancelButtonText: 'Nggak jadi'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>participant/save',
                    method: 'POST',
                    data: $('#form-participant').serialize(),
                    dataType: 'JSON',
                    success: function(res) {

                        let status = res.status
                        if (status != 200) {
                            errorAlert(res.message)
                            return false
                        }
                        loadData()
                        $('#modal-participant').modal('hide')
                        toastr.success(`Yeah! ${res.message} peserta berhasil ditambahkan`)
                    }
                })
            }
        })
    }

    const clearDataEdit = () => {
        $('#category-edit').val('')
        $('#contest-edit').val('')
        $('#name-edit').val('')
        $('#address-edit').val('')
        $('#category-edit').prop('disabled', false)
        $('#contest-edit').prop('disabled', false)
    }

    const deleteParticipant = id => {
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
                    url: '<?= base_url() ?>participant/delete/' + id,
                    dataType: 'JSON',
                    success: function(res) {
                        let status = res.status
                        if (status != 200) {
                            errorAlert(res.message)
                            return false
                        }
                        loadData()
                        toastr.success('Yeah! Satu peserta berhasil dihapus')
                    }
                })
            }
        })
    }

    const saveEdit = () => {
        let name = $('#name-edit').val()
        let address = $('#address-edit').val()
        if (name == '' || address == '') {
            errorAlert('Pastikan Nama dan Alamat sudah diisi')
            return false
        }

        $.ajax({
            url: '<?= base_url() ?>participant/edit',
            method: 'POST',
            data: $('#form-participant-edit').serialize(),
            dataType: 'JSON',
            success: function(res) {
                console.log(res);
                let status = res.status
                if (status != 200) {
                    errorAlert(res.message)
                    return false
                }
                clearDataEdit()
                $('#modal-participant-edit').modal('hide')
                loadData()
                toastr.success('Yeah! Satu peserta berhasil ditambahkan')
            }
        })
    }


    const getData = id => {
        $.ajax({
            url: '<?= base_url() ?>participant/getdata',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id
            },
            success: function(res) {
                $('#id-edit').val(id)
                $('#category-edit').val(res.data.category)
                $('#contest-edit').val(res.data.contest_id)
                $('#name-edit').val(res.data.name)
                $('#address-edit').val(res.data.address)
                $('#category-edit').prop('disabled', true)
                $('#contest-edit').prop('disabled', true)
                $('#modal-participant-edit').modal('show')
            }
        })
    }
</script>
</body>

</html>