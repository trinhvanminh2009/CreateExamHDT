/**
 * Created by Minh on 3/31/2017.
 */


function findMax(a, second) {

    var first=a.value;
    //var kq= document.getElementById("addQuestion").elements.namedItem('showQuestion');
    var p=document.getElementById("showQuestion")
    // var kq1 = document.getElementById("addQuestion").elements.namedItem('txtPercent');
    var percent=document.getElementById("txtPercent");
    var percentComplete=document.getElementById("percentComplete");
    var list=second.split(",");
    var max=0;
    var index=0;
    for(var i=0;i<list.length;i++){
        var temp=similar_text(first,list[i],100);
        if(max<temp){
            max=temp;

            index=i;
        }
    }
    p.innerHTML=list[index];
    percentComplete.innerHTML=String(parseInt(max))+"%";
    percent.style.width=String(max)+"%";
    checkProgressPercent();


}


function similar_text ( a,second,percent) {
    var first=a;


    if (first === null ||
        second === null ||
        typeof first === 'undefined' ||
        typeof second === 'undefined') {
        return 0
    }
    first += '';
    second += '';
    var pos1 = 0;
    var pos2 = 0;
    var max = 0;
    var firstLength = first.length;
    var secondLength = second.length;
    var p;
    var q;
    var l;
    var sum;
    for (p = 0; p < firstLength; p++) {
        for (q = 0; q < secondLength; q++) {
            for (l = 0; (p + l < firstLength) && (q + l < secondLength) && (first.charAt(p + l) === second.charAt(q + l)); l++) { // eslint-disable-line max-len
                // @todo: ^-- break up this crazy for loop and put the logic in its body
            }
            if (l > max) {
                max = l;
                pos1 = p;
                pos2 = q;
            }
        }
    }
    sum = max;
    if (sum) {
        if (pos1 && pos2) {
            sum += similar_text(first.substr(0, pos1), second.substr(0, pos2))
        }
        if ((pos1 + max < firstLength) && (pos2 + max < secondLength)) {
            sum += similar_text(
                first.substr(pos1 + max, firstLength - pos1 - max),
                second.substr(pos2 + max,
                    secondLength - pos2 - max))
        }
    }
    if (!percent) {
        return sum;
    }
    return (sum * 200) / (firstLength + secondLength);
}

function checkProgressPercent() {
    var percentComplete=document.getElementById("percentComplete").innerHTML;
    var numberPercent = percentComplete.match(/\d/g);
    numberPercent = numberPercent.join("");
    var percent=document.getElementById("txtPercent");
    ;


    if(parseInt(numberPercent)  >=1 && parseInt(numberPercent)  <=20)
    {
        percent.style.backgroundColor  = "#008000";
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled= false;
    }

    if(parseInt(numberPercent) >=21 && parseInt(numberPercent) <=40)
    {
        percent.style.backgroundColor  = "#0000ff";
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled= false;

    }

    if(parseInt(numberPercent) >=41 && parseInt(numberPercent) <=60)
    {
        percent.style.backgroundColor  = "#e69500";
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled = false;

    }

    if(parseInt(numberPercent) >=61 && parseInt(numberPercent) <=80)
    {
        percent.style.backgroundColor  = "#ff3300";
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled = false;

    }

    if(parseInt(numberPercent) >=81 && parseInt(numberPercent) <=100)
    {
        percent.style.backgroundColor  = "#ff0000";
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled= true;

    }
}

function checkAddQuestion() {
    var chooseRightAnswer = document.getElementById("addQuestion").elements.namedItem("selectRightAnswer");
    var chooseHardLevel = document.getElementById("addQuestion").elements.namedItem("selectHardLevel");
    if(chooseRightAnswer.selectedIndex == 0 ||chooseHardLevel.selectedIndex == 0)
    {
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled= true;
    }

    if (chooseRightAnswer.selectedIndex != 0 && chooseHardLevel.selectedIndex != 0)
    {
        document.getElementById("addQuestion").elements.namedItem('btnAddQuestion').disabled= false;
    }
}/**
 * Created by azaudio on 4/15/2017.
 */
