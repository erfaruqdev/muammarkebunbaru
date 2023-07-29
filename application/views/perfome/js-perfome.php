<script>
    $(function() {
        loadData()
    })

    const loadData = () => {
        $('#loader').show()
        $('#load-data').html('')
        
        $.ajax({
            url: '<?= base_url() ?>perfome/loaddata',
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
</script>
</body>

</html>