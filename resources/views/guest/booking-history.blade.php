@extends('layouts.main')
@section('title', 'Owltel')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .booking-hist-page-container {
        margin: 20px 10px 10px 20px;
        height: 100vh;
    }

    .booking-hist-div {
        margin-top: 30px;
        margin-bottom: 5px;
    }

    .booking-hist-div>h2 {
        color: #430000;
    }

    .booking-hist-container {
        height: fit-content;
        padding: 25px;
        border-bottom: 1px solid #a87b7b;
    }

    .booking-hist-image {
        width: 270px;
        border-radius: 10px;
    }

    .booking-hist-hotel-container {
        flex-direction: column;
        margin-left: 25px;
    }

    .booking-hist-hotel-name {
        color: #430000;
        font-size: 23px;
        font-weight: 500;
    }

    .booking-hist-calendar-icon {
        padding-right: 5px;
        color: #430000;
    }

    .booking-hist-status {
        background-color: #430000;
        border-radius: 12px;
        border: none;
    }

    .booking-hist-status:hover {
        background-color: #580000;
    }

    .booking-hist-detail {
        flex-direction: column;
        text-align: right
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 20px;
        box-shadow: none !important;
    }

    .pagination {
        box-shadow: none !important;
    }

    .pagination-container nav {
        box-shadow: none;
    }

    .pagination {
        z-index: 10;
    }

    .pagination .page-link {
        padding: 8px 12px;
        font-size: 14px;
        color: #580000;
        border-radius: 8px;
        margin: 0 5px;
        text-decoration: none;
        box-shadow: none !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #580000;
        color: #fff;
        border: none;
    }

    .pagination .page-link.disabled {
        color: #ccc;
        background-color: #f8f9fa;
    }

    .pagination .page-item .page-link {
        padding: 5px 10px;
    }

    .star-rating {
        font-size: 24px;
        /* Adjust star size */
        color: #ccc;
        cursor: pointer;
        user-select: none;
    }

    .star-rating .fas {
        color: #f7d106;
    }

    .rating-btn {
        border: none;
        background-color: #ded7c7;
        padding: 5px;
        text-align: left;
        font-size: 12px;
        color: #580000;
        border-radius: 8px;
        margin-top: 10px;
        transition: ease-in-out 0.2s;
    }

    .rating-btn:hover {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }
</style>

<div class="booking-hist-page-container w-100">
    <div class="booking-hist-div d-flex w-screen h-screen justify-content-center w-100">
        <h2 class="text-center">Booking History</h2>
    </div>

    @foreach ($bookings as $booking)
        <div class="booking-hist-container d-flex justify-content-between w-100">
            <div class="d-flex">
                <div class="justify-content-left">
                    <img class="booking-hist-image justify-content-left" src="{{json_decode($booking['hotel_image'])[0]}}">
                </div>

                <div class="booking-hist-hotel-container d-flex justify-content-between">
                    <div>
                        <div class="booking-hist-hotel-name">{{$booking['hotel_name']}}</div>
                        <div>{{$booking['hotel_address']}}</div>
                        <div class="d-flex align-items-center">
                            <i class="booking-hist-calendar-icon bi bi-calendar-heart"></i>
                            <div>{{$booking['check_in']}} - {{$booking['check_out']}}</div>
                        </div>
                    </div>

                    <div>
                        @if ($booking['review'] == null)
                            <button type="button" class="rating-btn" data-bs-toggle="modal" data-bs-target="#ratingModal"
                                data-booking-id="{{ $booking['id'] }}"
                                data-booking-label="{{ $booking['hotel_name'] }} ({{ $booking['check_in'] }} - {{ $booking['check_out'] }})">
                                Waiting for your story! Share your experience. <i class="fa-solid fa-camera-retro"></i>
                            </button>
                        @elseif ($booking['review'] != null)
                            <div>
                                <p class="rating-btn">You gave this a {{$booking['review']}}-star rating. Thank you! <i class="fa-solid fa-heart"></i></p>
                            </div>
                        @endif
                    </div>

                    <div>
                        <div class="booking-hist-status btn btn-primary">• {{$booking['status']}}</div>
                    </div>
                </div>
            </div>

            <div class="booking-hist-detail d-flex justify-content-between">
                <div>
                    <div>{{$booking['book_date']}}</div>
                    <div>Booked for {{$booking['booked_for']}}</div>
                </div>
                <div>
                    <h4>{{money((float) $booking['total_price'], 'IDR', true)}}</h4>
                </div>
            </div>
        </div>
    @endforeach
    @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="pagination-container">
            {{ $bookings->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>

<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalHeader"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('rateBooking')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="star-rating" data-selected="0">
                        <i class="far fa-star" data-value="1"></i>
                        <i class="far fa-star" data-value="2"></i>
                        <i class="far fa-star" data-value="3"></i>
                        <i class="far fa-star" data-value="4"></i>
                        <i class="far fa-star" data-value="5"></i>
                    </div>

                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="rating" id="rating_value" />

                    <textarea class="form-control mt-3" name="review" placeholder="Write a review" rows="5"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="booking-hist-status btn btn-success">
                        Submit Rating
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ratingModal = document.getElementById('ratingModal');
        const bookingIdInput = document.getElementById('booking_id');
        const starRatingContainer = document.querySelector('.star-rating');
        const ratingValueInput = document.getElementById('rating_value');
        const ratingModalHeader = document.getElementById('ratingModalHeader');

        ratingModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const bookingId = button.getAttribute('data-booking-id');
            const bookingLabel = button.getAttribute('data-booking-label');

            bookingIdInput.value = bookingId;
            ratingModalHeader.textContent = bookingLabel;

            starRatingContainer.setAttribute('data-selected', 0);
            starRatingContainer.querySelectorAll('i').forEach(star => {
                star.classList.remove('fas');
                star.classList.add('far');
            });
            ratingValueInput.value = '';
        });

        starRatingContainer.addEventListener('mouseover', function (event) {
            if (event.target.matches('i[data-value]')) {
                const hoverValue = parseInt(event.target.getAttribute('data-value'), 10);
                starRatingContainer.querySelectorAll('i').forEach(star => {
                    const starValue = parseInt(star.getAttribute('data-value'), 10);
                    if (starValue <= hoverValue) {
                        star.classList.remove('far');
                        star.classList.add('fas');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }
        });

        starRatingContainer.addEventListener('mouseout', function () {
            const selected = parseInt(starRatingContainer.getAttribute('data-selected'), 10) || 0;
            starRatingContainer.querySelectorAll('i').forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'), 10);
                if (starValue <= selected) {
                    star.classList.remove('far');
                    star.classList.add('fas');
                } else {
                    star.classList.remove('fas');
                    star.classList.add('far');
                }
            });
        });

        starRatingContainer.addEventListener('click', function (event) {
            if (event.target.matches('i[data-value]')) {
                const selectedValue = parseInt(event.target.getAttribute('data-value'), 10);
                starRatingContainer.setAttribute('data-selected', selectedValue);
                ratingValueInput.value = selectedValue;
            }
        });
    });
</script>
@endsection