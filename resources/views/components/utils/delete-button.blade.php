<button @click="click_me"
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs
            text-white uppercase tracking-widest
            hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition
            ease-in-out duration-150',
    ]) }}>
    {{ $slot }}
</button>
<script>
    function delete_item__() {
        // console.log(this.url);
        // console.log(this.return_url);
    }

    function click_me() {
        Swal.fire({
            icon: 'question',
            title: 'Are you sure you want to delete this item?',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel',
        }).then(v => {
            if (v.value) {
                axios.post(this.url, {
                        _method: 'delete'
                    })
                    .then((response) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Deleted successfully',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            toast: true,
                        }).then(v => {
                            window.location = this.return_url;
                        });
                    })
            }
        });
    }
</script>
