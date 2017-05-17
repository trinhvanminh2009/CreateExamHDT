/**
 * Created by azaudio on 3/28/2017.
 */
function popup2(mylink, windowname)
{
    if (! window.focus)return true;
    var href;
    var x = screen.width/2 - 700/2;
    var y = screen.height/2 - 450/2;
    if (typeof(mylink) == 'string')
        href=mylink; else href=mylink.href;
    windowname =window.open(href, windowname, '' +
        'width='+screen.width/2+',height='+screen.height/2+',left='+x+',top='+y+'',"resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes");

}
