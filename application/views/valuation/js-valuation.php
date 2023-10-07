<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    const errorAlert = message => {
        toastr.error(`Opss.! ${ message }`)
    }

    $(function() {
        loadData()
    })

    let contestElement = $('#changeContest')
    let categoryElement = $('#changeCategory')
    let orderElement = $('#changeOrder')

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        $.ajax({
            url: '<?= base_url() ?>valuation/valuation',
            method: 'POST',
            data: {
                category: categoryElement.val(),
                contest: contestElement.val(),
                order: orderElement.val()
            },
            success: function(res) {
                $('#load-data').html(res)
            },
            complete: function() {
                $('#loader').hide()
            }
        })
    }

    contestElement.on('change', function (){
        $('#contest').val($(this).val())
    })

    categoryElement.on('change', function (){
        $('#category').val($(this).val())
    })

    const submitPrint = () => {
        if (contestElement.val() === '') {
            toastr.error('Pilih dulu jenis lomba')
            return false
        }

        if (categoryElement.val() === '') {
            toastr.error('Pilih dulu kategori')
            return false
        }

        $('#form-print').submit()
    }

</script>
</body>

</html>