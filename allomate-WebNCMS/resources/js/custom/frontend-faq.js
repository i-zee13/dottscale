function all_faqs_list(){
    $('#all-faqs').empty();
    $.ajax({
        type    :   'GET',
        url     :   '/all-faqs',
        success :   function(response){
            response.faqs.forEach((element, key) => {
                $('#all-faqs').append(`
                <div class="col-12">
                    <ul class="nav nav-pills mb-3 list-none" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">All FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Service FAQs</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div id="accordion">
                                <div class="card shadow-none">
                                    @foreach ($faqs as $faq)
                                        <div class="card-header" >
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapse-{{$faq->id}}" aria-expanded="false"
                                                    aria-controls="collapse-{{$faq->id}}">
                                                    {{$faq->question}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{$faq->id}}" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>{{$faq->answer}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div id="accordion">
                                <div class="card shadow-none">
                                    @foreach ($service_faqs as $service_faq)
                                        <div class="card-header" >
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapse-{{$service_faq->id}}" aria-expanded="false"
                                                    aria-controls="collapse-{{$service_faq->id}}">
                                                    {{$service_faq->question}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{$service_faq->id}}" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>{{$service_faq->answer}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                `);
            });
        }
    })
}
all_faqs_list();