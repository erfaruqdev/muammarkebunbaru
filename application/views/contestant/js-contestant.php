<script>
    $('[data-mask]').inputmask();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    const errorAlert = message => {
        toastr.error(`Opss.! ${ message }`)
    }

    $('body').on('keyup', e => {
        if (e.keyCode == 113) {
            $('#changeMMU').focus().val('')
        }
    })

    $(function() {
        loadData()
    })

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        $.ajax({
            url: '<?= base_url() ?>contestant/loaddata',
            method: 'POST',
            data: {
                mmu: $('#changeMMU').val(),
                category: $('#changeCategory').val(),
                contest: $('#changeContest').val()
            },
            success: function(res) {
                $('#load-data').html(res)
            },
            complete: function() {
                $('#loader').hide()
            }
        })
    }

    $('#changeMMU').on('change', function() {
        $('#mmu').val($(this).val())
        loadData()
    })

    $('#changeCategory').on('change', function() {
        $('#category').val($(this).val())
        $('#category-print').val($(this).val())
        loadData()
    })

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

    const save = () => {
        let mmu = $('#mmu').val()
        let category = $('#category').val()
        let address = $('#address').val()

        if (mmu == '' || category == '' || address == '') {
            errorAlert('Pastikan MMU, Kategori dan Alamat sudah dipilih/diisi')
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
                    url: '<?= base_url() ?>contestant/save',
                    method: 'POST',
                    data: $('#form-contestant').serialize(),
                    dataType: 'JSON',
                    success: function(res) {

                        let status = res.status
                        if (status != 200) {
                            errorAlert(res.message)
                            return false
                        }

                        $('#modal-contestant').modal('hide')
                        loadData()
                        toastr.success(`Yeah! ${res.message} peserta berhasil ditambahkan`)
                    }
                })
            }
        })
    }

    $('#modal-contestant').on('hidden.bs.modal', () => {
        $('#form-contestant')[0].reset()
    })

    $('#modal-contestant').on('shown.bs.modal', () => {
        $('#address').focus()
    })

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
                    url: '<?= base_url() ?>contestant/delete/' + id,
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

    const getData = id => {
        $.ajax({
            url: '<?= base_url() ?>contestant/getdata',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id
            },
            success: function(res) {
                console.log(res);
                $('#id-edit').val(id)
                $('#mmu-edit').val(res.data.school_id)
                $('#category-edit').val(res.data.category)
                $('#contest-edit').val(res.data.contest_id)
                $('#name-edit').val(res.data.name)
                $('#address-edit').val(res.data.address)
                $('#category-edit').prop('disabled', true)
                $('#contest-edit').prop('disabled', true)
                $('#modal-edit-contestant').modal('show')
            }
        })
    }

    const saveEdit = () => {
        let category = $('#category-edit').val()
        let contest = $('#contest-edit').val()
        let name = $('#name-edit').val()
        let address = $('#address-edit').val()
        if (category == '' || contest == '' || name == '' || address == '') {
            errorAlert('Pastikan semua bidang inputan sudah diisi')
            return false
        }

        $.ajax({
            url: '<?= base_url() ?>contestant/saveedit',
            method: 'POST',
            data: $('#form-edit-contestant').serialize(),
            dataType: 'JSON',
            success: function(res) {
                let status = res.status
                if (status != 200) {
                    errorAlert(res.message)
                    return false
                }
                clearData()
                $('#modal-edit-contestant').modal('hide')
                loadData()
                toastr.success('Yeah! Satu peserta berhasil diubah')
            }
        })
    }

    const clearData = () => {
        $('#id-edit').val('')
        $('#mmu-edit').val('')
        $('#category-edit').val('')
        $('#contest-edit').val('')
        $('#name-edit').val('')
        $('#address-edit').val('')
        $('#category-edit').prop('disabled', false)
        $('#contest-edit').prop('disabled', false)
    }
</script>
</body>

</html>