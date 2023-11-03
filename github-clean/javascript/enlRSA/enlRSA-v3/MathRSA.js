//...
function modInverse(a, m) {
    // find the gcd
    const s = [];
    let b = BigInt(m);
    while(b) {
        [a, b] = [b, a % b];
        s.push({a, b});
    }

    //corner case
    if (a !== 1n) {
        return NaN;
    }

    // find the inverse
    let x = 1n;
    let y = 0n;
    for(let i = BigInt(s.length - 2); i >= 0n; --i) {
        [x, y] = [y,  x - y * (s[i].a / s[i].b)];
    }

    return (y % m + m) % m;
}

/*
modPow Right-to-left binary method
//https://en.wikipedia.org/wiki/Modular_exponentiation
*/
function rightToLeftBinaryModPow(b, e, m){
    if (m == 1n){
        return 0n;
    }else{
        let r = 1n;
        b = b % m;
        while (e > 0n){
            if(e % 2n == 1n){
                r = (r*b) % m;
            }
            b = (b*b) % m;
            e = e >> 1n;     //--use 'e = math.floor(e / 2)' on Lua 5.2 or older
        }
        return r;
    }
}
