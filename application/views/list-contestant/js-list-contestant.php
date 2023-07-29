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

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        $.ajax({
            url: '<?= base_url() ?>listcontestant/loaddata',
            method: 'POST',
            data: {
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

    $('#changeContest').on('change', function() {
        let contest = $(this).val()
        let contestID = $('#changeContest').find(':selected').data('id')

        if (contest == 1 || contest == 2 || contest == 8) {
            $('#changeJury').prop('disabled', true)
        } else {
            $('#changeJury').prop('disabled', false)
        }
        $('#contest-jury').val(contest)
        $('#contest-id').val(contestID)
        $('#contest-mc').val(contest)
    })

    $('#changeCategory').on('change', function() {
        let category = $(this).val()
        $('#category-jury').val(category)
        $('#category-mc').val(category)
    })

    $('#changeJury').on('change', function() {
        let jury = $(this).val()
        $('#jury').val(jury)
    })

    $('#submit-jury').on('click', function() {
        let contest = $('#changeContest').val()
        let category = $('#changeCategory').val()
        let jury = $('#changeJury').val()
        let contestID = $('#changeContest').find(':selected').data('id')

        if (contest == '' || category == '') {
            errorAlert('Pastikan Jenis Lomba dan Kategori telah dipilih')
            return false
        }

        if (contestID == 2 && jury == '') {
            errorAlert('Juri harus dipilih dulu')
            return false
        }

        $('#form-jury').submit()
    })

    $('#submit-mc').on('click', function() {
        let contest = $('#changeContest').val()
        let category = $('#changeCategory').val()
        if (contest == '' || category == '') {
            errorAlert('Pastikan Jenis Lomba dan Kategori telah dipilih')
            return false
        }

        $('#form-mc').submit()
    })

</script>
</body>

</html>