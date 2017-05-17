function limiter() {
    var input1 = document.getElementById("examinfo").elements.namedItem("schrd").value;
    var input2 = document.getElementById("examinfo").elements.namedItem("schd").value;
    var input3 = document.getElementById("examinfo").elements.namedItem("schtb").value;
    var input4 = document.getElementById("examinfo").elements.namedItem("schk").value;
    var input5 = document.getElementById("examinfo").elements.namedItem("schrk").value;
    var index= document.getElementById("examinfo").elements["soluong"].selectedIndex;

    var max=document.getElementById("examinfo").elements["soluong"].options[index].value;

    var ismax=parseInt(input1+input2+input3+input4+input5);
    if(ismax>max){
        this.alert(ismax);
        return false;
    }
    else if(ismax<max){
        this.alert(ismax);
        return false;
    }
}