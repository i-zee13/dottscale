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
if ($(".all-open-jobs-section").length > 0) {
    $('.all-open-jobs-list').empty();
    $.ajax({
        type: 'GET',
        url: '/all-jobs',
        success: function (response) {
            if (response.status == 'success')
                if (response.allJobs && response.allJobs.length > 0) {
                    response.allJobs.forEach(element => {
                        console.log(response.allJobs);
                        $('.all-open-jobs-list').append(`
                    <div class="col-12">
                    <div class="positions-list-card open-position-list">
                        <div class="row">
                            <div class="col-md-6 mt-auto mb-auto">
                                <h3>${element.title ?? ''}</h3>
                            </div>
                            <div class="col  mt-auto mb-auto">
                                <svg class="icon-pin" xmlns="http://www.w3.org/2000/svg" width="18" height="21.728"
                                    viewBox="0 0 18 21.728">
                                    <path id="Path_55" data-name="Path 55"
                                        d="M12,20.9l4.95-4.95a7,7,0,1,0-9.9,0Zm0,2.828L5.636,17.364a9,9,0,1,1,12.728,0ZM12,13a2,2,0,1,0-2-2A2,2,0,0,0,12,13Zm0,2a4,4,0,1,1,4-4A4,4,0,0,1,12,15Z"
                                        transform="translate(-3 -2)" fill="#ed6b4d" />
                                </svg>
                                ${element.location ?? ''}
                            </div>
                            <div class="col-auto  mt-auto mb-auto">
                                <a href="career/${element.slug}" class="btn btn-primary">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
                    `)

                    });
                }

        }
    });


} 
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
