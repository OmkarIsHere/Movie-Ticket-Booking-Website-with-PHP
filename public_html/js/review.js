$(document).ready(function () {

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    const movieid = params.movieid;

    var moviename = document.getElementById("moviename").innerHTML;


    headerscroll();
    function headerscroll() {
        const nav = document.getElementById("header");

        let lastScroll = 55;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            // console.log(lastScroll);

            if (currentScroll > lastScroll && nav.classList.contains("scroll-up")) {
                nav.style.top = "-60px";
                nav.classList.remove("scroll-up");


            }
            if (currentScroll < lastScroll) {
                nav.style.top = "0";
                nav.classList.add("scroll-up");

            }
            if (currentScroll >= 55) {
                lastScroll = currentScroll;

            }


        });
    }

    $(function () {
        $('#review-input').change(function () {
            this.value = $.trim(this.value);
        });
    });

    function insertreview(e) {
        user_review = $("#review-input").val();
        if (rating_data == '0' || user_review == '') {
            $("#error-message").html("Please fill both the fields.").slideDown("fast").delay(3000).fadeOut();
            e.stopImmediatePropagation();
            // e.preventDefault();
            return false;
        }
        else {
            // var uname = document.getElementById("username").innerHTML;
            // alert(uname);
            $.ajax({
                url: "./loadReview.php",
                type: "POST",
                async: false,
                cache: false,
                data: { ratingdata: rating_data, userreview: user_review, movieid: movieid }, //, uname: uname , moviename: moviename,
                success: function (data) {
                    if (data == 1) {
                        $("#success-message").html("Review successfully added!!").slideDown("fast").delay(3000).fadeOut();
                        $("#reviewform").trigger("reset");
                        rating_data = '0';
                        reset_background();
                        modal.style.display = "none";
                        load_submited_review();
                        load_all_data();

                    }
                    else {
                        $("#error-message").html("Server issue occurs while submiting review").slideDown("fast").delay(3000).fadeOut();
                    }

                },
                 error: function (errorThrown) {
                console.log(errorThrown);
            }
            });
            // e.preventDefault();
            e.stopImmediatePropagation();
        }

    }



    load_submited_review();
    function load_submited_review() {

        $.ajax({
            url: "./loadReview.php",
            type: "POST",
            async: false,
            cache: false,
            data: {
                action: 'post',
                movieid: movieid,
            },
            success: function (data) {
                $(".all-reviewdata").html(data);
                // console.log(data);
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    load_all_data();
    function load_all_data() {
        $.ajax({
            url: "./loadReview.php",
            type: "POST",
            async: false,
            cache: false,
            data: {
                alldata: 'post',
                movieid: movieid,
            },
            success: function (data) {
                const jsObject = JSON.parse(data);
                $('#average-stars-num').html(jsObject.average_rating);
                $('#totalreviews').html(jsObject.total_review);


                var count_star = 0;
                $('.mainstar').each(function () {
                    count_star++;
                    if (Math.ceil(jsObject.average_rating) >= count_star) {
                        $(this).addClass('goldstar');
                    }
                });


                $('#total_five_star_review').text(jsObject.five_star_review);
                $('#total_four_star_review').text(jsObject.four_star_review);
                $('#total_three_star_review').text(jsObject.three_star_review);
                $('#total_two_star_review').text(jsObject.two_star_review);
                $('#total_one_star_review').text(jsObject.one_star_review);

                if (jsObject.five_star_review > 0) {
                    var five = document.getElementById('five_star_progress');
                    five.style.display = "flex";
                    $('#five_star_progress').css('width', (jsObject.five_star_review / jsObject.total_review) * 100 + '%');
                }
                if (jsObject.four_star_review > 0) {
                    var four = document.getElementById('four_star_progress');
                    four.style.display = "flex";
                    $('#four_star_progress').css('width', (jsObject.four_star_review / jsObject.total_review) * 100 + '%');
                }
                if (jsObject.three_star_review > 0) {
                    var three = document.getElementById('three_star_progress');
                    three.style.display = "flex";
                    $('#three_star_progress').css('width', (jsObject.three_star_review / jsObject.total_review) * 100 + '%');
                }
                if (jsObject.two_star_review > 0) {
                    var two = document.getElementById('two_star_progress');
                    two.style.display = "flex";
                    $('#two_star_progress').css('width', (jsObject.two_star_review / jsObject.total_review) * 100 + '%');
                }
                if (jsObject.one_star_review > 0) {
                    var one = document.getElementById('one_star_progress');
                    one.style.display = "flex";
                    $('#one_star_progress').css('width', (jsObject.one_star_review / jsObject.total_review) * 100 + '%');
                }
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    }


    var rating_data = '0';
    var user_review = '';
    var modal = document.getElementById("myModal");



    var btn = document.getElementById("add_review");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        $.ajax({
            url: "./loadReview.php",
            type: "POST",
            async: false,
            cache: false,
            data: {
                login: 'post',
                movieid: movieid,
            },
            success: function (data) {
                if (data == 1) {
                    modal.style.display = "block";
                    // console.log("success");
                } else {
                    $("#error-message").html("You have already submited a review").slideDown("fast").delay(3000).fadeOut();
                }
                // alert(data);

            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    span.onclick = function (e) {
        e.preventDefault();
        $("#reviewform").trigger("reset");
        $(".submitstar").removeClass('goldstar');
        $(".submitstar").addClass('greystar');
        reset_background();
        rating_data = '0';
        modal.style.display = "none";
        // alert(rating_data);
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            $("#reviewform").trigger("reset");
            rating_data = '0';
            modal.style.display = "none";
        }
    }


    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submitstar_' + count).addClass('greystar');
            $('#submitstar_' + count).removeClass('goldstar');

        }

    }


    $(document).on('mouseenter', '.submitstar', function () {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {
            $('#submitstar_' + count).removeClass('greystar');
            $('#submitstar_' + count).addClass('goldstar');

        }

    });

    $(document).on('mouseleave', '.submitstar', function () {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submitstar_' + count).removeClass('greystar');

            $('#submitstar_' + count).addClass('goldstar');
        }

    });

    $(document).on('click', '.submitstar', function (e) {
        e.preventDefault();
        rating_data = $(this).data('rating');

    });


    $("#save_review").click(function (e) {
        // e.preventDefault(); .unbind('click')
        // alert(rating_data);
        insertreview(this);
    });


});



