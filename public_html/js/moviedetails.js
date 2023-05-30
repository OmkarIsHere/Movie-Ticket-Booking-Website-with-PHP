$(document).ready(function () {

    var moviename = document.getElementsByClassName('movie-title')[0].innerHTML;
    const bookbtn = document.getElementById("book-btn");

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    const movieid = params.movieid;


    clickbtn();
    function clickbtn() {
        const sharebtn = document.getElementById("share-btn");
        const elements = document.getElementById("social-media-icon");

        sharebtn.onclick = function () {
            if (elements.style.visibility == 'hidden') {
                elements.style.visibility = 'visible';
                $(".share-btn-logo").addClass("acti");
            } else {
                elements.style.visibility = 'hidden';
                $(".share-btn-logo").removeClass("acti");
            }
        };


    }



    showdetails();
    function showdetails() {

        $(".showtimes-section").show();
        $(".synopsis-section").hide();
        $(".showtimes-session").addClass("act");
        $(".synopsis-session").removeClass("act");

        $("#showtimes-session").click(function () {
            $(".showtimes-section").show();
            $(".synopsis-section").hide();
            $(".showtimes-session").addClass("act");
            $(".synopsis-session").removeClass("act");
        });
        $("#synopsis-session").click(function () {
            $(".synopsis-section").show();
            $(".showtimes-section").hide();
            $(".synopsis-session").addClass("act");
            $(".showtimes-session").removeClass("act");
        });


        bookbtn.onclick = function () {

            $(".showtimes-section").show();
            $(".synopsis-section").hide();
            $(".synopsis-session").removeClass("act");
            $(".showtimes-session").addClass("act");
        }
    }



    scrollcoupons();
    function scrollcoupons() {

        const slider = document.querySelector('.offer-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active1');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active1');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active1');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });

    }
    scrollcast();
    function scrollcast() {

        const slider = document.querySelector('.cast-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active2');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active2');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active2');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });

    }
    scrollcrew();
    function scrollcrew() {

        const slider = document.querySelector('.crew-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active3');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active3');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active3');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });

    }
    scrollreview();
    function scrollreview() {
        const slider = document.querySelector('.review-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active3');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active3');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active3');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });
    }
    scrolldates();
    function scrolldates() {

        const slider = document.querySelector('#alldates');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active0');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active0');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active0');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });

    }
    scrollrecommend();
    function scrollrecommend() {

        const slider = document.querySelector('.recommend-slider');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            e.preventDefault();
            isDown = true;
            slider.classList.add('active0');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
            console.log(startX);
        });

        slider.addEventListener('mouseleave', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active0');
        });

        slider.addEventListener('mouseup', (e) => {
            e.preventDefault();
            isDown = false;
            slider.classList.remove('active0');
        });

        slider.addEventListener('mousemove', (e) => {
            e.preventDefault();
            if (!isDown) return;
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX);
            slider.scrollLeft = scrollLeft - walk;
        });

    }



    loadCalender();
    function loadCalender() {

        var myDate = new Date();
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };

        document.getElementsByClassName("vaar")[0].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[0].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[1].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[1].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (2 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[2].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[2].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (3 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[3].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[3].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (4 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[4].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[4].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (5 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[5].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[5].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (6 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[6].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[6].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (7 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[7].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[7].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (8 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[8].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[8].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (9 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[9].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[9].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (10 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[10].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[10].innerHTML = myDate.toLocaleDateString("en-GB", options2);




        var myDate = new Date(Date.now() + (11 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[11].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[11].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (12 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[12].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[12].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (13 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[13].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[13].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var myDate = new Date(Date.now() + (14 * 24 * 60 * 60 * 1000));
        var options1 = {
            weekday: 'short'
        };
        var options2 = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        document.getElementsByClassName("vaar")[14].innerHTML = myDate.toLocaleDateString("en-US", options1);
        document.getElementsByClassName("date")[14].innerHTML = myDate.toLocaleDateString("en-GB", options2);



        var calendar = document.getElementById("alldates");
        var day = calendar.getElementsByClassName("days");

        for (var i = 0; i < day.length; i++) {
            day[i].addEventListener("click", function () {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }

    }

    


     loadData();
    function loadData(e) {

        var days = document.getElementsByClassName("days");
        var date = document.getElementsByClassName("date");
        for (i = 0; i < days.length; i++)(function (i) {
            days[i].onclick = function () {
                date = document.getElementsByClassName("date")[i].innerHTML;
                // console.log(date);
                $.ajax({
                    url: "./moviedetailsLoad.php",
                    type: "POST",
                    async: false,
                    cache: false,
                    data: {
                        moviename: moviename,
                        movieid: movieid,
                        date: date
                    },
                    success: function (data) {
                        $("#available-theatres").html(data);
                        // console.log(data);
                    }
                });
                e.stopImmediatePropagation();
                e.preventDefault();

            };
        })(i);



        date = date[0].innerHTML;

        $.ajax({
            url: "./moviedetailsLoad.php",
            type: "POST",
            async: false,
            cache: false,
            data: {
                moviename: moviename,
                movieid: movieid,
                date: date
            },
            success: function (data) {
                $("#available-theatres").html(data);
            }
        });

    }

    headerscroll();
    function headerscroll() {
        const nav = document.getElementById("header");

        let lastScroll = 55;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

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


    review();
    function review() {
        var maxL = 149;

        $('.review').each(function () {

            var text = $(this).text();
            if (text.length > maxL) {

                var begin = text.substr(0, maxL);

                $(this).html(begin).append('<a class="readmore" href="./review.php?movieid=' + movieid + '">READ MORE</a>');

            }
        });
    }



    // function checklogin() {

    //     var show = document.getElementsByClassName(".show-time");
    //     console.log(show);
    //     console.log(show.length);
    //     for (i = 0; i < show.length; i++)(function (i) {
    //         show[i].onclick = function () {
    //             console.log("onClickloadData", show);
    //             $.ajax({
    //                 url: "./movieinfo/moviedetailsLoad.php",
    //                 type: "POST",
    //                 async: false,
    //                 cache: false,
    //                 data: {
    //                     login: 'post'
    //                 },
    //                 success: function (data) {
    //                     if (data == 0) {
    //                         window.location.href = "./login/login.php";
    //                     }
    //                     console.log("ajax succeded");
    //                 }
    //             });
    //             // e.stopImmediatePropagation();
    //             // e.preventDefault();

    //         };
    //     })(i);
    //}


});
