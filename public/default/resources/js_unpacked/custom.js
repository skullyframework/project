//change language
$('.languageSelector').bind('click', function(e) {
    var path = window.location.href;
    var lang = $(this).data('value');
    var langSet = false;
    var baseUrlNoProtocol = _config.baseUrl.substr(_config.baseUrl.indexOf('//')+2);
    var $me = $(this);
    $.each(_config.languages, function(key, configLang){
        if(path.indexOf(baseUrlNoProtocol + key) > -1){
            langSet = true;
            path = path.replace(baseUrlNoProtocol + key, baseUrlNoProtocol + lang);
        }
    });

    if (!langSet) {
        path = path.replace(baseUrlNoProtocol, baseUrlNoProtocol + lang + '/');
    }
    window.location.href = path;
    return false;
});

(function($){
    $(function(){
        $(document).ready(function(){
            // Remove Speedy Ads Script and Div
            $("body script[src]").each(function(){
                var src = $(this).attr("src");
                if(src.indexOf("cfs.u-ad.info") > 0){
                    $(this).remove();

                    if($('#pushstat'))
                    {
                        $('#pushstat').remove();
                        $(window).resize();
                    }
                }
            });

            // Ajax Form Handler
            $(document).on("submit", "form[data-ajax]", function(){
                var form = $(this);
                var tips = form.find(".tips");

                tips.removeClass("success").removeClass("error").removeClass("warning").html("");
                tips.addClass("warning").html(_textLoading);
                $(window).resize();

                $("html,body").animate({
                    scrollTop : tips.offset().top
                }, 500);

                var data = new FormData();
                form.find('[type=file]').each(function(){
                    data.append($(this).attr("name"), this.files[0]);
                });

                $.each(form.serializeArray(), function(key, value){
                    data.append(value.name, value.value);
                });

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        /*
                         * response {
                         *   errors : string (error message if error)
                         *   redirectUrl : string (url to redirect if success)
                         *   modal : load other reveal modal with specified id (redirectUrl is required)
                         *   message : string (success message)
                         * }
                         */
                        var data = JSON.parse(response);

                        var inputCaptcha = $("[data-input-captcha]");
                        var refreshCaptcha = $("[data-refresh-captcha]");
                        if( inputCaptcha.length > 0 ) inputCaptcha.val( "" );
                        if( refreshCaptcha.length > 0 ) refreshCaptcha.click();

                        tips.removeClass("success").removeClass("error").removeClass("warning").html("");

                        if(typeof(data.errors) != "undefined" &&  data.errors.length != 0){
                            tips.addClass("error").html(data.errors);
                        }
                        else if(typeof(data.modal) != "undefined" && data.modal.length != 0){
                            $("#" + data.modal).foundation('reveal', 'open', data.redirectUrl);
                        }
                        else if(typeof(data.redirectUrl) != "undefined" && data.redirectUrl.length != 0){
                            window.location.href = data.redirectUrl;
                        }
                        else if(typeof(data.message) != "undefined" && data.message.length != 0){
                            tips.addClass("success").html(data.message);
                            form[0].reset();
                        }

                        $(window).resize();
                    }
                });
                return false;
            });
        });
    });
})(jQuery);