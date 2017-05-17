$(function () {
    $( "#number" ).change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }
    });
});
function limiter() {
    var input1 = parseInt(document.getElementById("examinfo").elements.namedItem("schrd").value);
    var input2 = parseInt(document.getElementById("examinfo").elements.namedItem("schd").value);
    var input3 = parseInt(document.getElementById("examinfo").elements.namedItem("schtb").value);
    var input4 = parseInt(document.getElementById("examinfo").elements.namedItem("schk").value);
    var input5 = parseInt(document.getElementById("examinfo").elements.namedItem("schrk").value);
    var index= document.getElementById("examinfo").elements["soluong"].selectedIndex;

    var max=parseInt(document.getElementById("examinfo").elements["soluong"].options[index].value);

    var ismax=input1+input2+input3+input4+input5;
    if(ismax>max){
        this.alert("Tổng số lượng trong dữ liệu 5 ô câu hỏi phải bằng số lượng câu hỏi");
        return false;
    }
    if(ismax<max){
        this.alert("Tổng số lượng trong dữ liệu 5 ô câu hỏi phải bằng số lượng câu hỏi");
        return false;
    }
}