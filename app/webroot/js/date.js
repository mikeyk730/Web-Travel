var g_months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function getMonthString(month)
{
    return g_months[month-1];
}

function getDateHtml(date)
{
    if (!date) return "";
    var d = date.split('-');
    return '<div class="date"><span class="header month">' + getMonthString(d[1]) + '</span>' 
	+ '<span class="day">' + d[2] + '</span>'
	+ '<span class="header year">' + d[0] + '</span></div>';
}

function getDateString(date)
{
    if (!date) return "";
    var d = date.split('-');
    return getMonthString(d[1]) + ' ' + d[2] + ', ' + d[0];
}
