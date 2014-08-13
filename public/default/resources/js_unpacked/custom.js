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