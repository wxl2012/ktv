/**
 功能：
 倒计时
 参数：
 unixtime      截止时间戳
 elementDay    显示剩余天数的元素
 elementHour   显示剩余小时数的元素
 elementMinute 显示剩余分钟数的元素
 elementSecond 显示剩余秒数的元素
 返回：
 日期时间串
 示例：


 */
function countDown(unixtime, elementDay, elementHour, elementMinute, elementSecond){
    var now = new Date();
    var endDate = new Date(unixtime*1000);
    var leftTime = endDate.getTime()-now.getTime();
    var leftsecond = parseInt(leftTime/1000);
    var day = Math.floor(leftsecond/(60*60*24));
    var hour = Math.floor((leftsecond-day*24*60*60)/3600);
    var minute = Math.floor((leftsecond-day*24*60*60-hour*3600)/60);
    var second = Math.floor(leftsecond-day*24*60*60-hour*3600-minute*60);

    if(elementDay != undefined){
        $('#' + elementDay).html(day < 10 && day > 0 ? "0" + day : day);
    }

    $('#' + elementHour).html((hour < 10 ? '0' : '') + hour);
    $('#' + elementMinute).html((minute < 10 ? '0' : '') + minute);
    $('#' + elementSecond).html((second < 10 ? '0' : '') + second);
}