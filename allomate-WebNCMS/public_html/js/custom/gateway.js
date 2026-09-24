function Gateway(){
    
    this.mandril = {
        mode:null,
        status:null,
        demo:{
            mail_mailer:null,
            mail_host:null,
            mail_port:null,
            mail_username:null,
            mail_password:null,
            mail_encryption:null,
            mail_sender_name:null,
            sender_email:null, 
        },
        live:{
            mail_mailer:null,
            mail_host:null,
            mail_port:null,
            mail_username:null,
            mail_password:null,
            mail_encryption:null,
            mail_sender_name:null,
            sender_email:null, 
        }
    };
    this.googleTag = {
        mode:null,
        status:null,
        live:{
            google_tag_header:null,
            google_tag_body:null
        }
    }
    
}

Gateway.prototype.http = function(type, url, formData){
    var self = this;
    return new Promise(function (resolve, reject) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: url,
            type: type,
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(e){
                resolve(e);
            },
            error: function(err) {
                if (err.status == 422 || err.status == 500) {
                    self.notification('error', 'Some Error Occured, please try again.');
                }
                $("#MainContent").show();
                $("#tblLoader").hide();
            }
        });
    });
}

Gateway.prototype.notification = function(type, message){
    var bgColor = (type=='error')? 'red' : 'green' ;
    var el = $('#notifDiv');
    el.fadeIn();
    el.css('background', bgColor);
    el.text (message);
    setTimeout(() => {
        el.fadeOut();
    }, 3000);
}

Gateway.prototype.loader = function(action){
    if(action=='show'){
        $('#tblLoader').show();
        $('#MainContent').hide();
    }else if(action=='hide'){
        $('#tblLoader').hide();
        $('#MainContent').show();
    }
}

Gateway.prototype.set_result = function(){
 
    this.set_mailchimp_mandril_result();
    this.set_google_tag_result();
     
}

Gateway.prototype.set_paypal_result = function(){

    // Live Fields
    $('input[name=paypal_live_client_id]').val(this.paypal.live.client_id);
    $('input[name=paypal_live_client_secret]').val(this.paypal.live.client_secret);

    // Sandbox Fields
    $('input[name=paypal_sandbox_client_id]').val(this.paypal.sandbox.client_id);
    $('input[name=paypal_sandbox_client_secret]').val(this.paypal.sandbox.client_secret);

    // Generic Fields
    $('select[name=paypal_status]').val(this.paypal.status).trigger('change');
    $(`input[name=paypal_mode][value='${this.paypal.mode}']`).prop("checked",true);
}

Gateway.prototype.set_vivawallet_result = function(){

    // Live Fields
    $('input[name=vivawallet_live_merchant_id]').val(this.vivawallet.live.merchant_id);
    $('input[name=vivawallet_live_api_key]').val(this.vivawallet.live.api_key);
    $('input[name=vivawallet_live_public_key]').val(this.vivawallet.live.public_key);
    $('input[name=vivawallet_live_source_code]').val(this.vivawallet.live.source_code);

    // Demo Fields
    $('input[name=vivawallet_demo_merchant_id]').val(this.vivawallet.demo.merchant_id);
    $('input[name=vivawallet_demo_api_key]').val(this.vivawallet.demo.api_key);
    $('input[name=vivawallet_demo_public_key]').val(this.vivawallet.demo.public_key);
    $('input[name=vivawallet_demo_source_code]').val(this.vivawallet.demo.source_code);

    // Generic Fields
    $('select[name=vivawallet_status]').val(this.vivawallet.status).trigger('change');
    $(`input[name=vivawallet_mode][value='${this.vivawallet.mode}']`).prop("checked",true);
}


Gateway.prototype.set_mailchimp_mandril_result = function(){
    // Live Fields
    console.log(gateway.mandril.live.mail_mailer);
    $('input[name=mail_live_mailer]').val(gateway.mandril.live.mail_mailer);
    $('input[name=mail_live_host]').val(gateway.mandril.live.mail_host);
    $('input[name=mail_live_port]').val(gateway.mandril.live.mail_port);
    $('input[name=mandril_mail_live_username]').val(gateway.mandril.live.mail_username);
    $('input[name=mandril_mail_live_password]').val(gateway.mandril.live.mail_password );
    $('input[name=mandril_mail_live_encryption]').val(gateway.mandril.live.mail_encryption); 
    $('input[name=mandril_live_sender_name]').val(gateway.mandril.live.mail_sender_name);
    $('input[name=mandril_live_sender_email]').val(gateway.mandril.live.sender_email); 
  
    // Sandbox Fields
    $('input[name=mail_demo_mailer]').val(gateway.mandril.demo.mail_mailer);
    $('input[name=mandril_mail_demo_host]').val(gateway.mandril.demo.mail_host );
    $('input[name=mandril_mail_demo_port]').val(gateway.mandril.demo.mail_port);
    $('input[name=mandril_mail_demo_username]').val(gateway.mandril.demo.mail_username);
    $('input[name=mandril_mail_demo_password]').val( gateway.mandril.demo.mail_password );
    $('input[name=mandril_mail_demo_encryption]').val(gateway.mandril.demo.mail_encryption); 
    $('input[name=mandril_demo_sender_name]').val(gateway.mandril.demo.mail_sender_name);
    $('input[name=mandril_demo_sender_email]').val(gateway.mandril.demo.sender_email); 
 
    // Generic Fields
    $('select[name=mandril_status]').val(this.mandril.status).trigger('change');
    $(`input[name=mandril_mode][value='${this.mandril.mode}']`).prop("checked",true);
}
Gateway.prototype.set_aramex_result = function(){
    // Live Fields
    $('input[name=aramex_live_username]').val(this.aramex.live.username);
    $('input[name=aramex_live_password]').val(this.aramex.live.password);
    $('input[name=aramex_live_account_number]').val(this.aramex.live.account_number);
    $('input[name=aramex_live_account_pin]').val(this.aramex.live.account_pin);
    $('input[name=aramex_live_country_code]').val(this.aramex.live.country_code);
    $('input[name=aramex_live_source]').val(this.aramex.live.source);
    $('input[name=aramex_live_entity]').val(this.aramex.live.entity);
    $('input[name=aramex_live_api_version]').val(this.aramex.live.api_version);
    
    // DEMO
    $('input[name=aramex_demo_username]').val(this.aramex.demo.username);
    $('input[name=aramex_demo_password]').val(this.aramex.demo.password);
    $('input[name=aramex_demo_account_number]').val(this.aramex.demo.account_number);
    $('input[name=aramex_demo_account_pin]').val(this.aramex.demo.account_pin);
    $('input[name=aramex_demo_country_code]').val(this.aramex.demo.country_code);
    $('input[name=aramex_demo_source]').val(this.aramex.demo.source);
    $('input[name=aramex_demo_entity]').val(this.aramex.demo.entity);
    $('input[name=aramex_demo_api_version]').val(this.aramex.demo.api_version);

    // Generic Fields
    $('select[name=aramex_status]').val(this.aramex.status).trigger('change');
    $(`input[name=aramex_mode][value='${this.aramex.mode}']`).prop("checked",true);
}

Gateway.prototype.set_pusher_result = function(){
    // Live Fields
    $('input[name=pusher_live_app_id]').val(this.pusher.live.app_id);
    $('input[name=pusher_live_app_key]').val(this.pusher.live.app_key);
    $('input[name=pusher_live_secret_key]').val(this.pusher.live.secret_key);
    $('input[name=pusher_live_cluster]').val(this.pusher.live.cluster);
    
    // DEMO
    $('input[name=pusher_demo_app_id]').val(this.pusher.demo.app_id);
    $('input[name=pusher_demo_app_key]').val(this.pusher.demo.app_key);
    $('input[name=pusher_demo_secret_key]').val(this.pusher.demo.secret_key);
    $('input[name=pusher_demo_cluster]').val(this.pusher.demo.cluster);

    // Generic Fields
    $('select[name=pusher_status]').val(this.pusher.status).trigger('change');
    $(`input[name=pusher_mode][value='${this.pusher.mode}']`).prop("checked",true);
}

Gateway.prototype.set_sms_result = function(){
    // Live Fields
    $('input[name=sms_live_host]').val(this.sms.live.host);
    $('input[name=sms_live_username]').val(this.sms.live.username);
    $('input[name=sms_live_password]').val(this.sms.live.password);
    $('input[name=sms_live_sender_id]').val(this.sms.live.sender_id);
    
    // DEMO
    $('input[name=sms_demo_host]').val(this.sms.demo.host);
    $('input[name=sms_demo_username]').val(this.sms.demo.username);
    $('input[name=sms_demo_password]').val(this.sms.demo.password);
    $('input[name=sms_demo_sender_id]').val(this.sms.demo.sender_id);

    // Generic Fields
    $('select[name=sms_status]').val(this.sms.status).trigger('change');
    $(`input[name=sms_mode][value='${this.sms.mode}']`).prop("checked",true);
}
Gateway.prototype.set_stripe_result = function(){
    // Live Fields
    $('input[name=stripe_live_app_key]').val(this.stripe.live.app_key);
    $('input[name=stripe_live_secret_key]').val(this.stripe.live.secret_key);
    $('input[name=stripe_live_sender_name]').val(this.stripe.live.sender_name);
    $('input[name=stripe_live_sender_email]').val(this.stripe.live.sender_email);
    // $('input[name=stripe_live_image]').val(this.stripe.live.image);
    $('input[name=stripe_live_title]').val(this.stripe.live.title);
    if(this.stripe.live.image){
        $('#stripe_live_image').attr('data-default-file', this.stripe.live.image);
        $('#stripe_live_image').attr('value', this.stripe.live.image);
        var dropifyPreviewWrapper = $('#stripe_live_image').closest('.dropify-wrapper');
        var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
        dropifyPreview.css('display', 'block');
        dropifyPreview.find('.dropify-render').html(`<img src="${this.stripe.live.image}" alt="Front Image">`);
     }
    
    // DEMO
    $('input[name=stripe_demo_app_key]').val(this.stripe.demo.app_key);
    $('input[name=stripe_demo_secret_key]').val(this.stripe.demo.secret_key);
    $('input[name=stripe_demo_sender_name]').val(this.stripe.demo.sender_name);
    $('input[name=stripe_demo_sender_email]').val(this.stripe.demo.sender_email);
     if(this.stripe.demo.image){
        $('#stripe_demo_image').attr('data-default-file', this.stripe.demo.image);
        $('#stripe_demo_image').attr('value', this.stripe.demo.image);
        var dropifyPreviewWrapper = $('#stripe_demo_image').closest('.dropify-wrapper');
        var dropifyPreview = dropifyPreviewWrapper.find('.dropify-preview');
        dropifyPreview.css('display', 'block');
        dropifyPreview.find('.dropify-render').html(`<img src="${this.stripe.demo.image}" alt="Front Image">`);
     }
    // $('input[name=stripe_demo_image]').val(this.stripe.demo.image); 
    $('input[name=stripe_demo_title]').val(this.stripe.demo.title);

    // Generic Fields
    $('select[name=stripe_status]').val(this.stripe.status).trigger('change');
    $(`input[name=stripe_mode][value='${this.stripe.mode}']`).prop("checked",true);
}

Gateway.prototype.set_bank_transfer_result = function(){
    // Live Fields
    $('input[name=bank_transfer_live_bank_name]').val(this.mandril.live.bank_name);
    $('input[name=bank_transfer_live_branch_code]').val(this.mandril.live.branch_code);
    $('input[name=bank_transfer_live_account_no]').val(this.mandril.live.account_no);

    // Sandbox Fields
    $('input[name=bank_transfer_demo_bank_name]').val(this.mandril.demo.bank_name);
    $('input[name=bank_transfer_demo_branch_code]').val(this.mandril.demo.branch_code);
    $('input[name=bank_transfer_demo_account_no]').val(this.mandril.demo.account_no);

    // Generic Fields
    $('select[name=bank_transfer_status]').val(this.mandril.status).trigger('change');
    $(`input[name=bank_transfer_mode][value='${this.mandril.mode}']`).prop("checked",true);
}

Gateway.prototype.set_cod_result = function(){
    // Live Fields
    $('input[name=cod_min_limit]').val(this.cod.live.min_limit);

    // Generic Fields
    $('select[name=cod_status]').val(this.cod.status).trigger('change');
    $(`input[name=cod_mode][value='${this.cod.mode}']`).prop("checked",true);
}

Gateway.prototype.set_royalmail_result = function(){
    // Live Fields
    $('input[name=royalmail_live_authorization]').val(this.royalmail.live.authorization_key);
    $('input[name=royalmail_live_client_id]').val(this.royalmail.live.client_id);
    $('input[name=royalmail_live_client_secret]').val(this.royalmail.live.client_secret);

    // Sandbox Fields
    $('input[name=royalmail_demo_authorization]').val(this.royalmail.demo.authorization_key);
    $('input[name=royalmail_demo_client_id]').val(this.royalmail.demo.client_id);
    $('input[name=royalmail_demo_client_secret]').val(this.royalmail.demo.client_secret);

    // Generic Fields
    $('select[name=royalmail_status]').val(this.royalmail.status).trigger('change');
    $(`input[name=royalmail_mode][value='${this.royalmail.mode}']`).prop("checked",true);
}

Gateway.prototype.set_dpd_result = function(){
    // Live Fields
    $('input[name=dpd_live_user_id]').val(this.dpd.live.user_id);
    $('input[name=dpd_live_password]').val(this.dpd.live.password);

    // Sandbox Fields
    $('input[name=dpd_demo_user_id]').val(this.dpd.demo.user_id);
    $('input[name=dpd_demo_password]').val(this.dpd.demo.password);

    // Generic Fields
    $('select[name=dpd_status]').val(this.dpd.status).trigger('change');
    $(`input[name=dpd_mode][value='${this.dpd.mode}']`).prop("checked",true);
}

Gateway.prototype.set_google_tag_result = function(){
    // Live Fields
    $('textarea[name=google_tag_header]').val(this.googleTag.live.google_tag_header);
    $('textarea[name=google_tag_body]').val(this.googleTag.live.google_tag_body);

    // Generic Fields
    $('select[name=google_tag_status]').val(this.googleTag.status).trigger('change');
    // $(`input[name=dpd_mode][value='${this.dpd.mode}']`).prop("checked",true);
}


Gateway.prototype.save = function() {
    gateway.loader('show');
    var formData = new FormData();
    formData.append('type', this.type);
    formData.append('status', this.status);
    formData.append('section', this.section_type);
    formData.append('setting', JSON.stringify(this[this.type]));

   
    if (this.type === 'stripe') {
        formData.append('stripe_live_image', document.querySelector('input[name=stripe_live_image]').files[0]);
        formData.append('stripe_demo_image', document.querySelector('input[name=stripe_demo_image]').files[0]);
    }

    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/save-gateway-details', true);
    
    var csrfToken = document.querySelector('meta[name="csrf_token"]').getAttribute('content');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    
    xhr.onload = () => {
        if (xhr.status == 200) {
            gateway.loader('hide');
            gateway.get_detail();
            gateway.notification('success', 'Setting Saved Successfully!');
        } else {
            console.error('Error saving settings:', xhr.statusText);
            location.reload();
        }
    };
    
    xhr.onerror = function () {
        console.error('Network error occurred while saving settings.');
        location.reload();
    };
    
    xhr.send(formData);
    
    
};


Gateway.prototype.get_detail = function(){
    gateway.loader('show');
    this.http('GET', '/admin/get-gateway-detail').then((e)=>{
        var result = JSON.parse(e);
        result.forEach(element => {
            if(element.type=='paypal') gateway.paypal = element.setting;
            if(element.type=='vivawallet') gateway.vivawallet = element.setting;
            if(element.type=='mandril') gateway.mandril = element.setting;
            if(element.type=='cod') gateway.cod = element.setting;
            if(element.type=='banktransfer') gateway.banktransfer = element.setting;
            if(element.type=='royalmail') gateway.royalmail = element.setting;
            if(element.type=='dpd') gateway.dpd = element.setting;
            if(element.type=='googleTag') gateway.googleTag = element.setting;
            if(element.type=='aramex') gateway.aramex = element.setting;
            if(element.type=='pusher') gateway.pusher = element.setting;
            if(element.type=='sms') gateway.sms = element.setting;
            if(element.type=='stripe') gateway.stripe = element.setting;
        });

        gateway.set_result();
        gateway.loader('hide');
    });
}

var gateway = new Gateway();
gateway.get_detail();

function SavePaypal() {
    gateway.type = 'paypal';

    // Live Fields
    gateway.paypal.live.client_id            =      $('input[name=paypal_live_client_id]').val();
    gateway.paypal.live.client_secret        =      $('input[name=paypal_live_client_secret]').val();

    // Sandbox Fields
    gateway.paypal.sandbox.client_id         =      $('input[name=paypal_sandbox_client_id]').val();
    gateway.paypal.sandbox.client_secret     =      $('input[name=paypal_sandbox_client_secret]').val();

    // Generic Fields
    gateway.paypal.status                    =      $('select[name=paypal_status]').val();
    gateway.paypal.mode                      =      $('input[name=paypal_mode]:checked').val();
    gateway.status                           =      $('select[name=paypal_status]').val();
    gateway.section_type                     =      $('#section_type').val();

    gateway.save();
}

function SaveVivaWallet(){
    gateway.type = 'vivawallet';

    // Live Fields
    gateway.vivawallet.live.merchant_id = $('input[name=vivawallet_live_merchant_id]').val();
    gateway.vivawallet.live.api_key = $('input[name=vivawallet_live_api_key]').val();
    gateway.vivawallet.live.public_key = $('input[name=vivawallet_live_public_key]').val();
    gateway.vivawallet.live.source_code = $('input[name=vivawallet_live_source_code]').val();

    // Demo Fields
    gateway.vivawallet.demo.merchant_id = $('input[name=vivawallet_demo_merchant_id]').val();
    gateway.vivawallet.demo.api_key = $('input[name=vivawallet_demo_api_key]').val();
    gateway.vivawallet.demo.public_key = $('input[name=vivawallet_demo_public_key]').val();
    gateway.vivawallet.demo.source_code = $('input[name=vivawallet_demo_source_code]').val();

    //Generic Fields
    gateway.vivawallet.status = $('select[name=vivawallet_status]').val();
    gateway.vivawallet.mode = $('input[name=vivawallet_mode]:checked').val();
    gateway.status = $('select[name=vivawallet_status]').val();

    gateway.save();
}

function SaveMandril() {
    gateway.type = 'mandril';

    // Live Fields
  // Live Fields
gateway.mandril.live.mail_mailer = $('input[name=mail_live_mailer]').val()?.trim() || null;
gateway.mandril.live.mail_host = $('input[name=mail_live_host]').val()?.trim() || null;
gateway.mandril.live.mail_port = $('input[name=mail_live_port]').val()?.trim() || null;
gateway.mandril.live.mail_username = $('input[name=mandril_mail_live_username]').val()?.trim() || null;
gateway.mandril.live.mail_password = $('input[name=mandril_mail_live_password]').val()?.trim() || null;
gateway.mandril.live.mail_encryption = $('input[name=mandril_mail_live_encryption]').val()?.trim() || null;
gateway.mandril.live.mail_sender_name = $('input[name=mandril_live_sender_name]').val()?.trim() || null;
gateway.mandril.live.sender_email = $('input[name=mandril_live_sender_email]').val()?.trim() || null;

// Demo Fields 
gateway.mandril.demo.mail_mailer = $('input[name=mail_demo_mailer]').val()?.trim() || null;
gateway.mandril.demo.mail_host = $('input[name=mandril_mail_demo_host]').val()?.trim() || null;
gateway.mandril.demo.mail_port = $('input[name=mandril_mail_demo_port]').val()?.trim() || null;
gateway.mandril.demo.mail_username = $('input[name=mandril_mail_demo_username]').val()?.trim() || null;
gateway.mandril.demo.mail_password = $('input[name=mandril_mail_demo_password]').val()?.trim() || null;
gateway.mandril.demo.mail_encryption = $('input[name=mandril_mail_demo_encryption]').val()?.trim() || null;
gateway.mandril.demo.mail_sender_name = $('input[name=mandril_demo_sender_name]').val()?.trim() || null;
gateway.mandril.demo.sender_email = $('input[name=mandril_demo_sender_email]').val()?.trim() || null;

    // Generic Fields
    gateway.mandril.status              = $('select[name=mandril_status]').val();
    gateway.mandril.mode                = $('input[name=mandril_mode]:checked').val();
    gateway.status                      = $('select[name=mandril_status]').val();
    gateway.section_type                = $('#section_type').val();

    gateway.save();
    console.log(gateway);
}

function SaveBankTransfer() {
    gateway.type = 'banktransfer';

    // Live Fields
    gateway.banktransfer.live.bank_name = $('input[name=bank_transfer_live_bank_name]').val();
    gateway.banktransfer.live.branch_code = $('input[name=bank_transfer_live_branch_code]').val();
    gateway.banktransfer.live.account_no = $('input[name=bank_transfer_live_account_no]').val();

    // Demo Fields
    gateway.banktransfer.demo.bank_name = $('input[name=bank_transfer_demo_bank_name]').val();
    gateway.banktransfer.demo.branch_code = $('input[name=bank_transfer_demo_branch_code]').val();
    gateway.banktransfer.demo.account_no = $('input[name=bank_transfer_demo_account_no]').val();

    // Generic Fields
    gateway.banktransfer.status = $('select[name=bank_transfer_status]').val();
    gateway.banktransfer.mode = $('input[name=bank_transfer_mode]:checked').val();
    gateway.status = $('select[name=bank_transfer_status]').val();

    gateway.save();
}

function SaveCOD() {
    gateway.type = 'cod';

    // Live Fields
    gateway.cod.live.min_limit = $('input[name=cod_min_limit]').val();

    // Demo Fields
    gateway.cod.demo.min_limit = $('input[name=cod_min_limit]').val();

    // Generic Fields
    gateway.cod.status = $('select[name=cod_status]').val();
    gateway.cod.mode = 'live';// $('input[name=mandril_mode]:checked').val();
    gateway.status = $('select[name=cod_status]').val();

    gateway.save();
}

function SaveRoyalmail() {
    gateway.type = 'royalmail';

    // Live Fields
    gateway.royalmail.live.authorization_key    =   $('input[name=royalmail_live_authorization]').val();
    gateway.royalmail.live.client_id            =   $('input[name=royalmail_live_client_id]').val();
    gateway.royalmail.live.client_secret        =   $('input[name=royalmail_live_client_secret]').val();

    // Demo Fields
    gateway.royalmail.demo.authorization_key    =   $('input[name=royalmail_demo_authorization]').val();
    gateway.royalmail.demo.client_id            =   $('input[name=royalmail_demo_client_id]').val();
    gateway.royalmail.demo.client_secret        =   $('input[name=royalmail_demo_client_secret]').val();

    // Generic Fields
    gateway.royalmail.status                    =   $('select[name=royalmail_status]').val();
    gateway.royalmail.mode                      =   $('input[name=royalmail_mode]:checked').val();
    gateway.status                              =   $('select[name=royalmail_status]').val();
    gateway.section_type                        =   $('#section_type').val();

    gateway.save();
}

function SaveDPD() {
    gateway.type = 'dpd';

    // Live Fields
    gateway.dpd.live.user_id = $('input[name=dpd_live_user_id]').val();
    gateway.dpd.live.password = $('input[name=dpd_live_password]').val();

    // Demo Fields
    gateway.dpd.demo.user_id = $('input[name=dpd_demo_user_id]').val();
    gateway.dpd.demo.password = $('input[name=dpd_demo_password]').val();

    // Generic Fields
    gateway.dpd.status = $('select[name=dpd_status]').val();
    gateway.dpd.mode = $('input[name=dpd_mode]:checked').val();
    gateway.status = $('select[name=dpd_status]').val();

    gateway.save();
}


function SaveGoogleTag() {
    gateway.type = 'googleTag';

    // Live Fields
    gateway.googleTag.live.google_tag_header     =   $('textarea[name=google_tag_header]').val();
    gateway.googleTag.live.google_tag_body       =   $('textarea[name=google_tag_body]').val();

    // Generic Fields
    gateway.googleTag.status                     =   $('select[name=google_tag_status]').val();
    gateway.status                               =   $('select[name=google_tag_status]').val();
    gateway.section_type                         =   $('#section_type').val();
    gateway.googleTag.mode = 'live';

    gateway.save();
}

function SaveAramex() {
    gateway.type                        =   'aramex';

    // Live Fields
    gateway.aramex.live.username        =   $('input[name=aramex_live_username]').val();
    gateway.aramex.live.password        =   $('input[name=aramex_live_password]').val();
    gateway.aramex.live.account_number  =   $('input[name=aramex_live_account_number]').val();
    gateway.aramex.live.account_pin     =   $('input[name=aramex_live_account_pin]').val();
    gateway.aramex.live.country_code    =   $('input[name=aramex_live_country_code]').val();
    gateway.aramex.live.source          =   $('input[name=aramex_live_source]').val();
    gateway.aramex.live.entity          =   $('input[name=aramex_live_entity]').val();
    gateway.aramex.live.api_version     =   $('input[name=aramex_live_api_version]').val();

    // Demo Fields
    gateway.aramex.demo.username        =   $('input[name=aramex_demo_username]').val();
    gateway.aramex.demo.password        =   $('input[name=aramex_demo_password]').val();
    gateway.aramex.demo.account_number  =   $('input[name=aramex_demo_account_number]').val();
    gateway.aramex.demo.account_pin     =   $('input[name=aramex_demo_account_pin]').val();
    gateway.aramex.demo.country_code    =   $('input[name=aramex_demo_country_code]').val();
    gateway.aramex.demo.source          =   $('input[name=aramex_demo_source]').val();
    gateway.aramex.demo.entity          =   $('input[name=aramex_demo_entity]').val();
    gateway.aramex.demo.api_version     =   $('input[name=aramex_demo_api_version]').val();

    // Generic Fields
    gateway.aramex.status               =   $('select[name=aramex_status]').val();
    gateway.aramex.mode                 =   $('input[name=aramex_mode]:checked').val();
    gateway.status                      =   $('select[name=aramex_status]').val();
    gateway.section_type                =   $('#section_type').val();
    

    gateway.save();
}

// Save Pusher
function SavePusher() {
    gateway.type                        =   'pusher';

    // Live Fields
    gateway.pusher.live.app_id          =   $('input[name=pusher_live_app_id]').val();
    gateway.pusher.live.app_key         =   $('input[name=pusher_live_app_key]').val();
    gateway.pusher.live.secret_key      =   $('input[name=pusher_live_secret_key]').val();
    gateway.pusher.live.cluster         =   $('input[name=pusher_live_cluster]').val();

    // Demo Fields
    gateway.pusher.demo.app_id          =   $('input[name=pusher_demo_app_id]').val();
    gateway.pusher.demo.app_key         =   $('input[name=pusher_demo_app_key]').val();
    gateway.pusher.demo.secret_key      =   $('input[name=pusher_demo_secret_key]').val();
    gateway.pusher.demo.cluster         =   $('input[name=pusher_demo_cluster]').val();

    // Generic Fields
    gateway.pusher.status               =   $('select[name=pusher_status]').val();
    gateway.pusher.mode                 =   $('input[name=pusher_mode]:checked').val();
    gateway.status                      =   $('select[name=pusher_status]').val();
    gateway.section_type                =   $('#section_type').val();

    gateway.save();
}
// Save SMS
function SaveSMS() {
    gateway.type                        =   'sms';
    // Live Fields
    gateway.sms.live.host            =   $('input[name=sms_live_host]').val();
    gateway.sms.live.username        =   $('input[name=sms_live_username]').val();
    gateway.sms.live.password        =   $('input[name=sms_live_password]').val();
    gateway.sms.live.sender_id       =   $('input[name=sms_live_sender_id]').val();

    // Demo Fields
    gateway.sms.demo.host            =   $('input[name=sms_demo_host]').val();
    gateway.sms.demo.username        =   $('input[name=sms_demo_username]').val();
    gateway.sms.demo.password        =   $('input[name=sms_demo_password]').val();
    gateway.sms.demo.sender_id       =   $('input[name=sms_demo_sender_id]').val();

    // Generic Fields
    gateway.sms.status               =   $('select[name=sms_status]').val();
    gateway.sms.mode                 =   $('input[name=sms_mode]:checked').val();
    gateway.status                   =   $('select[name=sms_status]').val();
    gateway.section_type             =   $('#section_type').val();

    gateway.save();
}

// Save Stripe
function SaveStripe() {
    gateway.type                     =   'stripe';
    // Live Fields
    gateway.stripe.live.app_key      =   $('input[name=stripe_live_app_key]').val();
    gateway.stripe.live.secret_key   =   $('input[name=stripe_live_secret_key]').val();
    gateway.stripe.live.sender_name  =   $('input[name=stripe_live_sender_name]').val();
    gateway.stripe.live.sender_email =   $('input[name=stripe_live_sender_email]').val();
    gateway.stripe.live.title        =   $('input[name=stripe_live_title]').val();
    gateway.stripe.live.image        =   $('input[name=stripe_live_image]').val();
    var imageFile                    =   $('input[name=stripe_live_image]').prop('files')[0];
    gateway.stripe.live.image        =   imageFile;

    // Demo Fields
    gateway.stripe.demo.app_key      =   $('input[name=stripe_demo_app_key]').val();
    gateway.stripe.demo.secret_key   =   $('input[name=stripe_demo_secret_key]').val();
    gateway.stripe.demo.sender_name  =   $('input[name=stripe_demo_sender_name]').val();
    gateway.stripe.demo.sender_email =   $('input[name=stripe_demo_sender_email]').val();
    gateway.stripe.demo.title        =   $('input[name=stripe_demo_title]').val();
    var imageFile                    =   $('input[name=stripe_demo_image]').prop('files')[0];
    console.log(imageFile);
    gateway.stripe.demo.image        =   imageFile;

    // Generic Fields
    gateway.stripe.status            =   $('select[name=stripe_status]').val();
    gateway.stripe.mode              =   $('input[name=stripe_mode]:checked').val();
    gateway.status                   =   $('select[name=stripe_status]').val();
    gateway.section_type             =   $('#section_type').val();

    gateway.save();
}