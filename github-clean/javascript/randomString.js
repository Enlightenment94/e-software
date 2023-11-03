function makeStr(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let i;
    for(i = 0; i < length; i++){
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function makePharseStrToNumberStr(){
    var str = makeStr(256)
    var asciiStr = "";
    var i;
    for(i = 0 ; i < str.length; i++){
        asciiStr += str.charCodeAt(i);
    }
    //console.log(asciiStr);
    //console.log(asciiStr.slice(0, 256));
    return asciiStr.slice(0, 256)
}
