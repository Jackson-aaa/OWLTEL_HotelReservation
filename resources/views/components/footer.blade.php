<link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

<?php 
    $content_row = "col d-flex flex flex-column";
    $content_title = "fw-bolder m-0";
    $content_body = "fw-light text-decoration-none text-dark"
?>

<footer class="flex w-100 px-4 py-4" style="background-color: #F7F7F7;">
    <div>
        <p style="letter-spacing: 8px; color: #430000;">OWLTEL</p>
    </div>
    <div class="row px-5 mb-3">
        <div class="{{$content_row}}">
            <p class="{{$content_title}}">Support</p>
            <a href="#" class="{{$content_body}}">Help Center</a>
            <a href="#" class="{{$content_body}}">Cancellation Options</a>
            <a href="#" class="{{$content_body}}">Terms and Conditions</a>
            <a href="#" class="{{$content_body}}">Transaction Policy</a>
        </div>
        <div class="{{$content_row}}">
            <p class="{{$content_title}}">Follow Us</p>
        </div>
        <div class="{{$content_row}}">
            <p class="{{$content_title}}">Contact Us</p>
            <a href="#" class="{{$content_body}}">Phone: +62 21 5555-5555</a>
            <a href="#" class="{{$content_body}}">Email: info@owltel.com</a>
        </div>
        <div class="{{$content_row}}">
            <p class="{{$content_title}}">Subscribe to Our Newsletter</p>
            <a href="#" class="{{$content_body}}">inforeward@owltel.com</a>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <p class="fw-light m-0" style="letter-spacing: 3px;">© 2024 Owltel. All rights reserved.</p>
    </div>
</footer>