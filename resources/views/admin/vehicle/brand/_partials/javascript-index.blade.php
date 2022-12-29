{{-- Brand Javascript --}}

<script defer>
    window.addEventListener('DOMContentLoaded', event => {
        const removeBrands = document.querySelectorAll('.brand-remove-form');
        if(removeBrands) {
            console.debug("Remove Brands form handler!");
            removeBrands.forEach(form => {
                form.addEventListener('submit', e => {
                    if(!confirm("Voulez-vous supprimer cette marque ?")) {
                        e.preventDefault();

                        return false;
                    }
                });
            });
        } else {
            console.warn("No form found!");
        }
    });
</script>
