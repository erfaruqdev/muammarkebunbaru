<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    $('.move-next').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault()
            let $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    });

    const save = () => {
        Swal.fire({
            title: 'Yakin, nih?',
            text: 'Pastikan data valid',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>drawing/save',
                    method: 'post',
                    data: $('#form-save').serialize(),
                    dataType: 'JSON',
                    success: response => {
                        let status = response.status
                        if (status != 200) {
                            toastr.error(`Opppss..! ${response.message}`)
                            return false
                        }

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        })
                        setTimeout(function (){
                            location.reload()
                        }, 2000)
                    }
                })
            }
        })
    }
</script>
</body>

</html>