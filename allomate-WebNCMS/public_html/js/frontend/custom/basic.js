
console.log('loading swiper');
const swiper = new Swiper(".swiperreviews", {
    direction: "horizontal",
    loop: true,
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: false,
    },
    slidesPerView: "auto",
    centeredSlides: false,
    centerInsufficientSlides: true,
    centeredSlidesBounds: true,
    pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
        horizontalClass: "positionBottom",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    keyboard: {
        enabled: true,
        onlyInViewport: false,
    },
    mousewheel: {
        invert: false,
        //releaseOnEdges: true,
        forceToAxis: true,
    },


    breakpoints: {
        375: {
            slidesPerView: 1.1,
            spaceBetween: 8,
        },
        375: {
            slidesPerView: 1.3,
            spaceBetween: 8,
        },
        480: {
            slidesPerView: 1.5,
            spaceBetween: 8,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 8,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 8,
        },
        800: {
            slidesPerView: 2.2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1280: {
            slidesPerView: 3.3,
            spaceBetween: 15,
        },
    },
});
setTimeout(() => {
    
}, 2000);


//menu icon and logo color on dark section//