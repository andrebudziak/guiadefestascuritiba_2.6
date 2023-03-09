// JScript File
var msgTimer = "";
var membersTimer = "";
var listaTimer = "";

startTimers();

function startTimers() 
{
   msgTimer = window.setInterval("updateUser()", 3000);
   membersTimer = window.setInterval("updateMembers()", 10000);
   listaTimer = window.setInterval("AtualizaLista()", 20000);
}

function stopTimers() 
{
    window.clearInterval(msgTimer);
    window.clearInterval(membersTimer);
    window.clearInterval(listaTimer);
    msgTimer = "";
    membersTimer = "";
    listaTimer = "";
}

function updateUser() 
{
    PageMethods.UpdateUser($get("hdnRoomID").value, UpdateMessages);
}

function updateMembers() 
{
    PageMethods.UpdateRoomMembers($get("hdnRoomID").value, UpdateMembersList);
}

function Leave() 
{
    stopTimers();
    PageMethods.LeaveRoom($get("hdnRoomID").value);
}

function button_clicked() 
{
    var e = document.getElementById("dlFalar"); // select element
    var strUser = e.options[e.selectedIndex].text;
    PageMethods.SendMessage($get("txtMsg").value, $get("hdnRoomID").value, strUser, UpdateMessages, errorCallback);
    $get("txtMsg").value = "";
    $get("txt").scrollIntoView("true");
}

function clickButton(e, buttonid)
 {
    var bt = document.getElementById(buttonid);
    if (typeof bt == 'object') {
        if (navigator.appName.indexOf("Netscape") > (-1)) {
            if (e.keyCode == 13) {
                bt.click();
                return false;
            }
        }
        if (navigator.appName.indexOf("Microsoft Internet Explorer") > (-1)) {
            if (event.keyCode == 13) {
                bt.click();
                return false;
            }
        }
    }
}

function UpdateMessages(result) 
{
   $get("txt").value = $get("txt").value + result;
   $get("txt").doScroll();
}

function UpdateMembersList(result) 
{
    // alert(result);
    var users = result.split(",");
    // alert(users.length);
    var i = 0;


    $get("lstMembers").options.length = 0;
    var i = 0;
    while (i < users.length) {
        if (users[i] != "");
        {
            var op = new Option(users[i], users[i]);
            $get("lstMembers").options[$get("lstMembers").options.length] = op;
        }
        i += 1;
    }

    //$get("lstMembers").value=$get("txt").value+result;
    //$get("txt").doScroll();
}

function errorCallback(result) 
{
    alert("Erro ao executar comando: "+ result);
}

function AtualizaLista() 
{

    var i;

    document.getElementById("dlFalar").innerHTML = "";

    for (i = 0; i < document.getElementById("lstMembers").options.length; i++) 
    {

        var o = new Option();

        o.text = document.getElementById("lstMembers").options[i].text;

        o.value = document.getElementById("lstMembers").options[i].value;

        document.getElementById("dlFalar").options.add(o);
    }
}			
        