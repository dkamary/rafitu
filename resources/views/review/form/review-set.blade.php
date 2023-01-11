{{-- Review Form --}}

<form action="{{ route('review_submit') }}" method="post">
    <div class="row my-3">
        <label for="note" class="col-12 col-md-4 d-flex align-items-center">Choissisez la note</label>
        <div class="col-12 col-md-8 d-flex align-items-center">
            <input type="hidden" name="note" id="note" value="">
            <div class="star-container">
                <a href="#" class="star star-1" data-value="1"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                <a href="#" class="star star-2" data-value="2"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                <a href="#" class="star star-3" data-value="3"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                <a href="#" class="star star-4" data-value="4"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                <a href="#" class="star star-5" data-value="5"><i class="fa fa-star-o" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <label for="comments" class="col-12 col-md-4">Votre avis</label>
        <div class="col-12 col-md-8">
            <textarea class="form-control" name="comments" id="comments" cols="30" rows="2" maxlength="255" placeholder="Votre avis ..."></textarea>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                Envoyer
            </button>
        </div>
    </div>

    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

    @csrf
</form>

@once
    @push('head')
    <style id="review-form-style">
        .star-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .star-container .star {
            margin-right: .5rem;
            color: #edc604;
            font-weight: bold;
            font-size: 2rem;
        }

        .star-container .star.selected {
            color:#edc604;
        }
    </style>
    @endpush

    @push('footer')
    <script id="review-form-script">
        window.addEventListener("DOMContentLoaded", event => {
            const stars = document.querySelectorAll('.star');
            if(!stars || stars.length == 0) {
                console.warn("No stars found!");
                return;
            }

            stars.forEach(star => {
                star.addEventListener("click", e => {
                    e.preventDefault();
                    manageStars({ star: e.currentTarget });
                    const input = document.querySelector('#note');
                    if(!input) return console.warn("No input found!!!");

                    input.value = star.dataset.value;
                });

            });
        });

        const manageStars = ({star}) => {
            clearStar();

            console.debug("Fill color");
            for (let index = parseInt(star.dataset.value); index > 0; index--) {
                const otherStar = document.querySelector('.star-' + index);
                if(otherStar) {
                    otherStar.classList.add('selected');
                    const icon = otherStar.querySelector('i.fa');
                    icon.classList.remove('fa-star-o');
                    icon.classList.add('fa-star');
                }
            }
        };

        const clearStar = () => {
            const stars = document.querySelectorAll(".star");
            if(!stars) return console.debug("No star found!!!");

            stars.forEach(star => {
                star.classList.remove('selected');

                const icon = star.querySelector('i.fa');
                icon.classList.remove('fa-star');
                icon.classList.add('fa-star-o');
            });

            console.debug("Clear stars!");
        };
    </script>
    @endpush
@endonce
