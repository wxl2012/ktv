function replaceParamVal(oUrl, paramName,replaceWith) {
    var nUrl = oUrl;
    if(oUrl.indexOf(paramName) == -1){
        nUrl += oUrl.indexOf('?') > -1 ? '&' : '?';
        nUrl += paramName + '=' + replaceWith;
    }else{
        var re=eval('/('+ paramName+'=)([^&]*)/gi');
        nUrl = oUrl.replace(re,paramName+'='+replaceWith);
    }

    return nUrl;
}