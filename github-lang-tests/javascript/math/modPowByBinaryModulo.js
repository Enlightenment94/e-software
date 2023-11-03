// https://pl.khanacademy.org/computing/computer-science/cryptography/modarithmetic/a/fast-modular-exponentiation
// Rozbicie na mniejsze potęgi 2
function bigInt2bin(input) {
    return BigInt(input).toString(2);
}

function modPowByBinaryModulo){
    //Zapisz y wpostaci binarnej
    let arr = [];
    let yBinary = bigInt2bin(y);
    document.write(yBinary);
    document.write("<br></br>");

    var i;
    var power = 0n;
    var yBinaryLength = yBinary.length;

    power = 0n;
    let action = "";
    let result = 1n;
    let temp = 0n;
    let howMany = 1n;
    let flag = 0;
    var j = 0;
    for(i = yBinaryLength - 1; i >= 0; i--){
        if(yBinary[i] == "1"){
            if(flag == 0){
                temp = x ** (1n << power); 
                flag = 1;                 
            }else{        
                for(j = 0; j < howMany; j++){
                    temp = temp * temp;
                }
            }
            result *= temp % modulo;
            howMany = 1n;
        }else{
            howMany++;
        }
        power++;
    }

    result = result % modulo;

    document.write("<br></br>");
    document.write(action);
    document.write("<br></br>");
    document.write("result = " + result);

    //Dzielenie przez modulo

    return result;    
}
