$('#inner-testimonials').empty();
$(document).ready(function () {
    if ($("#inner-testimonials").length > 0) {
        $.ajax({
            url: '/all-testimonials-list',
            success: function (response) {
                var testi_records = response.testi_records;
                TestimonialHTML(testi_records);
            }
        });
    }
});
function TestimonialHTML(testi_records) {
    if(testi_records.length > 0){
        $('#inner-testimonials').append(`
            ${inner_records ? inner_records : ''}
        `);
        var inner_records    =   TestimonialInnerSection(testi_records);
        console.log(inner_records);
    }else{
        $("#fetchTestimonials").remove();
    }
}
function TestimonialInnerSection(testi_records){
    testi_records.forEach((testimonial,key) => {
        $(".carousel-inner").append(`
            <div class="carousel-item ${key == 0 ? 'active' : ''}">
                <div class="row"> 
                    <div class="col-lg-6 col-md-6 mt-auto mb-auto">
                        <img class="testimonial-img" src="${'/storage/'+testimonial.image}" alt="">
                    </div>  
                    <div class="col-lg-6 col-md-6 testimonial-d-flex">
                        <blockquote>
                            <q>${testimonial.content}</q>
                        <cite>${testimonial.name}</cite> 
                        <span>${testimonial.designation}</span>
                        </blockquote>  

                        <div class="testimonial-arrow">                    
                            <a href="#carouselExampleFade" class="Block-prev" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                            <a href="#carouselExampleFade" class="Block-next" role="button" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                        </div>

                    </div>  
                </div>
            </div>
        `);
    });
}