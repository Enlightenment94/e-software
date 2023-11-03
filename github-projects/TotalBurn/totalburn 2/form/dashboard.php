<style>

body{
    background: black;
    height: 100%;
    color: rgba(255,255,255, 0.7);
    font-family: Consolas, Courier, monospace; 
}

button{
    background-color: #FF4500;
    border-color: #FF4500;
    color: rgba(255,255,255, 0.7);
    cursor: pointer
}

fieldset{
    height: 200px;
    font-size: 10px;
}

input{
    background: none;
    color: rgba(255,255,255, 0.7);
}



button:hover{
    background-color: rgba(255,255,255, 0.9);
}

#mainHeader{
    color: #FF4500;
    text-align: center;
    font-weight: bold;
    font-size: 22px;
}

#mainAction{
    text-align: right;
    font-size: 12px;
}

#mainAction a{
    color: #FF4500;
}

#mainAction a:hover{
    color: gray;
    text-shadow: 1px 1px red;
}

#c{
    position: fixed;
    z-index: -1;
}

#chatBody{
    width: 400px;
    margin: 0 auto;
}



#key{
    width: 100%;
    overflow: hidden;
}

#pk{
    color: #FF4500;
    text-align: center;
    font-weight: bold;    
}

#pharseInput{
    width: 100%;
}

#chatKeys{
    font-size: 11px;
}

#myPublicKey{
    height: auto;
    width: 100%;
    word-wrap: break-word;
}

#reciverPublicKey{
    height: auto; 
    width: 100%;
    word-wrap: break-word;
}

#console{
    width: 100%;
    overflow: auto;
}

#chat{

}

.color{
    color: #FF4500;
}

#window{
    width: 100%;
    height: 200px;
    overflow-y: scroll;
}

#timeDestructor{
    width: 50%;
    font-size: 11px;
    float: left;
}

#totalBurn{
    width: 50%;
    font-size: 11px;
    float: left;
}

#msg{
    width: 75%;
}

#sendMsgButton{
    width: 25%;
}





#buttons{

}

#findInput{
    width: 75%;
}

#findButton{
    width: 25%;
}

#chatsButton{
    width: 100%;
}

.col25{
    width: 25%;
    float: left;
}

.col50{
    width: 50%;
    float: left;
}

.col75{
    width: 75%;
    float: left;
}

#destructButton{
    width: 100%;
}

#burnButton{
    width: 100%;
}

.burnButtonChat{
    cursor: pointer
}
</style>

<?php session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['use'])){
    
    }else{
        echo ("<script>location.href='index.php';</script>");
        header('Location: index.php');
        die();
}?>

<head>
    <title>Login form</title>
    <script src='../lib/jsencrypt-master/bin/jsencrypt.min.js'></script>
    <script src="../lib/cryptoico/jsbn.js"></script>
    <script src="../lib/cryptoico/random.js"></script>
    <script src="../lib/cryptoico/hash.js"></script>
    <script src="../lib/cryptoico/rsa.js"></script>
    <script src="../lib/cryptoico/aes.js"></script>
    <script src="../lib/cryptoico/api.js"></script>
    <script src="msg.js"></script>
    <script>
    window.onload = function (){
        getPublicKey();
    }
    </script>
    <script src='rsaCli.js'></script>
</head>
<body>
<div id='chatBody'>
    <div id='mainHeader'>TotalBurn</div>

    <center><p style='font-size: 11px;'>"All chats must burn before in wrong hands."</p></center>

    <div style='width:300px; margin: 0 auto;'>
    <canvas id="c"></canvas>
    </div>
    <script src="burn.js"></script>

    <div id='mainAction'>
        <a href='logout.php'>logout</a>
        <a href='../rsa/rsaRequest.php?d=t'>delete account</a>
    </div>

    <div id='key'>
        <div class='col25' id='pk'>Pharse_key: </div>
        <div class='col75'>
            <input id='pharseInput' name='' type='password' value='abcd'/>
        </div>
        <div id='chatKeys'></div>
    </div>

    <div id='console'>
        <div class='col50' id='chat'></div>
        <div class='col50'>
            <div id='timeDestructor'>
                <fieldset>
                    <legend>Time destructor:</legend>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="1m" name="destruct" value="1"/>
                    <label for="1m">1m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="3m" name="destruct" value="3"/>
                    <label for="3m">3m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="5m" name="destruct" value="5" checked/>
                    <label for="5m">5m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="15m" name="destruct" value="15"/>
                    <label for="15m">15m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="30m" name="destruct" value="30"/>
                    <label for="30m">30m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class='descructInput' type="radio" id="60m" name="destruct" value="60"/>
                    <label for="60m">60m</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class="descructInput" type="radio" id="6h" name="destruct" value="360"/>
                    <label for="6h">6h</label>
                    </div>

                    <div class='divDestructInput'>
                    <input class="descructInput" type="radio" id="1d" name="destruct" value="1440"/>
                    <label for="1d">1d</label>
                    </div>
                                        
                    <div style='font-size: 11px;'>Burn after reading</div>
                </fieldset>
            </div>

            <div id='totalBurn'>
                <fieldset>
                    <legend>Total burn:</legend>

                    <div class='divTotalBurnInput'>
                    <input class='totalBurnInput' type="radio" id="60mtb" name="totalBurn" value="60"/>
                    <label for="60m">60m</label>
                    </div>

                    <div class='divTotalBurnInput'>
                    <input class="totalBurnInput" type="radio" id="6htb" name="totalBurn" value="360"/>
                    <label for="6htb">6h</label>
                    </div>

                    <div class='divTotalBurnInput'>
                    <input class="totalBurnInput" type="radio" id="12htb" name="totalBurn" value="720"/>
                    <label for="6htb">12h</label>
                    </div>

                    <div class='divTotalBurnInput'>
                    <input class="totalBurnInput" type="radio" id="1dtb" name="totalBurn" value="1440" checked/>
                    <label for="1dtb">1d</label>
                    </div>

                    <div class='divTotalBurnInput'>
                    <input class="totalBurnInput" type="radio" id="3dtb" name="totalBurn" value="4320"/>
                    <label for="1dtb">3d</label>
                    </div>

                    <div class='divTotalBurnInput'>
                    <input class="totalBurnInput" type="radio" id="7dtb" name="totalBurn" value="10080"/>
                    <label for="1dtb">7d</label>
                    </div>
                                        
                    <div style='font-size: 11px;'>All data is burned after selected time</div>
                </fieldset>
            </div>
        </div>
    </div>

    </br>

    <div id='buttons'>
        <div class='col50'>
            <input id='findInput' value='user1'><button id='findButton' onclick='findUser()'>F</button>
        </div>
        <div class='col50'>
            <button id='chatsButton' onclick='getChats()'>chats</button>
        </div>
    </div>

    <div id='content'>
    </div>

    <div id='temp' style='visibility: hidden;'>
    </div>
</div>
</body>