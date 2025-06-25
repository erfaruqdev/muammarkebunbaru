<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }
    
    const updateProfile = () => {
        Swal.fire({
            title: "Yakin, nih?",
            text: "Pastikan sudah sesuai pedoman ubah username",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Siap, Lanjut",
            cancelButtonText: "Nggak jadi"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>profile/update',
                    method: 'POST',
                    data: $('#form-update-profile').serialize(),
                    dataType: 'JSON',
                    success: response => {
                        if (response.status != 200) {
                            toastr.error(response.message)
                            return false
                        }

                        Swal.fire({
                            title: 'Profil berhasil diupdate',
                            icon: 'success',
                            html: 'Halaman akan dimuat ulang dalam <strong>2</strong> detik.<br/><br/>',
                            timer: 2000,
                            timerProgressBar: true
                        })
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                    }
                })
            }
        });
    }

    $('#showPassword').on('click', function() {
        $(this).removeClass('d-flex')
        $(this).addClass('d-none')

        $('#hidePassword').removeClass('d-none')
        $('#hidePassword').addClass('d-flex')

        $('.password').attr('type', 'text')
    })

    $('#hidePassword').on('click', function() {
        $(this).removeClass('d-flex')
        $(this).addClass('d-none')

        $('#showPassword').removeClass('d-none')
        $('#showPassword').addClass('d-flex')

        $('.password').attr('type', 'password')
    })

    const updatePassword = () => {
        Swal.fire({
            title: "Yakin, nih?",
            text: "Pastikan sudah sesuai pedoman ubah password",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Siap, Lanjut",
            cancelButtonText: "Nggak jadi"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>profile/updatepassword',
                    method: 'POST',
                    data: $('#form-update-password').serialize(),
                    dataType: 'JSON',
                    success: response => {
                        if (response.status != 200) {
                            toastr.error(response.message)
                            return false
                        }

                        Swal.fire({
                            title: 'Password berhasil diupdate',
                            icon: 'success',
                            html: 'Halaman akan dimuat ulang dalam <strong>2</strong> detik.<br/><br/>',
                            timer: 2000,
                            timerProgressBar: true
                        })
                        setTimeout(function() {
                            location.reload()
                        }, 2000)
                    }
                })
            }
        });
    }

</script>
</body>

</html>