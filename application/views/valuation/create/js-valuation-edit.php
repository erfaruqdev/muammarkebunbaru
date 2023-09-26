<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    const setContest = el => {
        let contest = $(el).val()
        $('#contest').val(contest)
    }

    const setCategory = el => {
        let category = $(el).val()
        $('#category').val(category)
    }

    // Convert NodeList to Array with slice()
    const inputs = Array.prototype.slice.call(
        document.querySelectorAll('.num')
    );

    const points = Array.prototype.slice.call(
        document.querySelectorAll('.point')
    );

    inputs.forEach((input) => {
        input.addEventListener('keydown', (event) => {
            const num = event.keyCode;
            if (num === 13) { // Only allow numbers
                event.preventDefault();
                focusNext();
            }
        });
    });

    function focusNext() {
        const currInput = document.activeElement;
        const currInputIndex = inputs.indexOf(currInput);
        const nextinputIndex =
            (currInputIndex + 1) % inputs.length;
        const input = inputs[nextinputIndex];
        input.select();
        input.focus();
    }

    points.forEach((input) => {
        input.addEventListener('keydown', (event) => {
            const num = event.keyCode;
            if (num === 13) { // Only allow numbers
                event.preventDefault();
                focusNextP();
            }
        });
    });

    function focusNextP() {
        const currInput = document.activeElement;
        const currInputIndex = points.indexOf(currInput);
        const nextinputIndex =
            (currInputIndex + 1) % points.length;
        const input = points[nextinputIndex];
        input.select();
        input.focus();
    }

    const add = () => {
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Pastikan nilai sudah valid',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form-add').submit()
            }
        })
    }

</script>