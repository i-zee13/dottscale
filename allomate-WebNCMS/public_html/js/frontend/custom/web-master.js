const menuBtn = document.querySelector('.navbar-toggler');
const noscroll = document.querySelector('.noscroll');

let showMenu = false;

menuBtn.addEventListener('click', toggleMenu);

function toggleMenu() {
    if (!showMenu) {

        body.classList.add('noscroll');

        showMenu = true;
    } else {
        body.classList.remove('noscroll');

        showMenu = false;
    }
}

const body = document.body;
const triggerMenu = document.querySelector(".top-header");
const scrollUp = "s-up";
const scrollDown = "s-down";
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= 0) {
        body.classList.remove(scrollUp);
        return;
    }
    if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
        // down 
        body.classList.remove(scrollUp);
        body.classList.add(scrollDown);
    } else if (currentScroll < lastScroll && body.classList.contains(scrollDown)) {
        // up
        body.classList.remove(scrollDown);
        body.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
});


$(".scroll-x").mCustomScrollbar({
    axis: "x",
    theme: "dark-thick",
    advanced: { autoExpandHorizontalScroll: true }
});

function showMessage(color, message) {
    $('#notifDiv').fadeIn();
    $('#notifDiv').css('background', color);
    $('#notifDiv').text(message);
    setTimeout(() => {
        $('#notifDiv').fadeOut();
    }, 3000);

}

function emailValidate(email) {
    var filter = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if (filter.test(email)) {
        return true;
    }
    else {
        return false;
    }
}
