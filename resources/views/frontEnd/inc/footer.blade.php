</section>
<div class="footer">

    <div class="container">

        <div class="row">


            <div class="col-lg-4 col-sm-3">
                <h4>Subscribe</h4>
                <p>Get notified about the latest properties in our marketplace.</p>
                <form class="form-inline" role="form" action="{{ route('subscribe') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Enter Your email address" class="form-control">
                    <button class="btn btn-success" type="submit">Notify Me!</button>
                </form>
            </div>

            <div class="col-lg-4 col-sm-3">
                <h4>Follow us</h4>
                <a href="#"><img src="{{ asset('frontEnd/images') }}/facebook.png" alt="facebook"></a>
                <a href="#"><img src="{{ asset('frontEnd/images') }}/twitter.png" alt="twitter"></a>
                <a href="#"><img src="{{ asset('frontEnd/images') }}/linkedin.png" alt="linkedin"></a>
                <a href="#"><img src="{{ asset('frontEnd/images') }}/instagram.png" alt="instagram"></a>
            </div>

            <div class="col-lg-4 col-sm-3">
                <h4>Contact us</h4>
                <p><b>House Rent Inc.</b><br>
                    <span class="glyphicon glyphicon-map-marker"></span> Sylhet, Bangladesh <br>
                    <span class="glyphicon glyphicon-envelope"></span> hello@houserent.com<br>
                    <span class="glyphicon glyphicon-earphone"></span> 123 456-7890</p>
            </div>
        </div>
        <p class="copyright center">Copyright 2020. All rights reserved.	</p>


    </div></div>

