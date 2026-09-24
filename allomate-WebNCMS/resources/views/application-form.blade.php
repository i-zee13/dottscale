<form id="application-form">
						@csrf
            <input type="hidden" name="application_for" value="{{$application_for}}" >
          <div class="job-form">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="first_name" id="firstname" class="form-control required only_alphabets" placeholder="First Name *" style="font-size: 14px">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="last_name" id="lastname" class="form-control required only_alphabets" placeholder="Last Name *" style="font-size: 14px">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="email" id="email" class="form-control required" placeholder="Email *" style="font-size: 14px">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="phone" id="Phone" class="form-control required only_numerics" placeholder="Phone *" style="font-size: 14px">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="linked_in" id="LinkedIn" class="form-control required" placeholder="LinkedIn URL *" style="font-size: 14px">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="resume" class="form__input form__input--file"> <span id="placeholder-resume" class="icon icon-plus placeholder">Attach Resume *</span>
                    <input type="file" id="resume" name="resume" class="hidden form__input form__input--file required " accept=".jpeg, .jpg, .png,.doc,.docx,.pdf" onchange="fileSelect(event)">
                  </label>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-8">
                <textarea class="form-control required" name="message" id="message" rows="5" placeholder="Introduce Yourself *" style="font-size: 14px"></textarea>
              </div>
              <div class="col-md-8">
                <button type="button" class="send-btn"  id="btn-application-form">SEND</button>
              </div>
            </div>
          </div>
          </form>
@push('js')

  <script>
    function fileSelect(){
      var file =   $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
      $('#placeholder-resume').empty();
      if(file.length > 0){
        $('#placeholder-resume').text(file);
      }else{
        $('#placeholder-resume').text('Attach Resume *');
      }
    }
  </script>
@endpush