{{-- Star display --}}

<div class="rating" title="{{ number_format($note, 2, ',', '') }} sur 5">
    <div class="stars" style="width: {{ 20 * $note }}%"></div>
    <div class="back-stars" style="width: 100%;"></div>
</div>

@once

    @push('head')
        <style id="rating-stars-style">
            .rating {
                display: inline-block;
                position: relative;
                font-size: 0;
            }

            .stars, .back-stars {
                display: inline-block;
                font-size: 32px;
                line-height: 1;
                height: 32px;
            }

            .stars {
                position: absolute;
                top: 0;
                left: 0;
                white-space: nowrap;
                overflow: hidden;
                z-index: 1;
            }

            .back-stars {
                color: #ebebeb;
            }

            .stars::before, .back-stars::before {
                content: "★★★★★";
                letter-spacing: -4px;
            }

            .stars::before {
                position: absolute;
                top: 0;
                left: 0;
                z-index: 2;
                overflow: hidden;
                color: #ffd700;
            }

            .back-stars::before {
                color: #ebebeb;
            }
        </style>
    @endpush

    @push('footer')
        <script id="rating-stars-style" defer>
            window.addEventListener("DOMContentLoaded", () => {
                // displayRating({{ $note }});
            });

            function displayRating(note) {
                const rating = document.querySelector('.rating');
                const stars = rating.querySelector('.stars');
                const backStars = rating.querySelector('.back-stars');

                // note est un nombre de type float entre 0 et 5
                // const note = 4.75;

                // On calcule le pourcentage de remplissage des étoiles
                const percentage = (note / 5) * 100;

                // On définit le style des étoiles pleines et à moitié pleines en fonction du pourcentage de remplissage
                stars.style.width = `${percentage}%`;
                backStars.style.width = `${100 - percentage}%`;
            }
        </script>
    @endpush

@endonce
