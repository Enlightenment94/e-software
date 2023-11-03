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

// Utility function to do
// modular exponentiation.
// It returns (x^y) % p
// ...
function power(x, y, p){
	
	// Initialize result 
    // (JML- all literal integers converted to use n suffix denoting BigInt)
	let res = 1n;
	
	// Update x if it is more than or
	// equal to p
	x = x % p;
    //console.log("start x = x % p = " + x);
	while (y > 0n){
		
		// If y is odd, multiply
		// x with result
		if (y & 1n)
			res = (res*x) % p;
            //console.log("res = (res*x) % p = " + x);

		// y must be even now
        //y to jest counter jakby zwykłej inkrementacji
		y = y / 2n; // (JML- original code used a shift operator, but division is clearer)
		x = (x * x) % p; //Coś mi tu nie gra czemu x*x 
        //console.log("y = y / 2n = " + y);
        //console.log("x = (x * x) % p = " + x);
	}

	return res;
}

//https://en.wikipedia.org/wiki/Modular_exponentiation
//(a ⋅ b) mod m = [(a mod m) ⋅ (b mod m)] mod m
/*
function modular_pow(base, exponent, modulus) is
    if modulus = 1 then
        return 0
    c := 1
    for e_prime = 0 to exponent-1 do
        c := (c * base) mod modulus
    return c
*/
//Not speed full
function memoryEfficientModPow(base, exponent, modulo){
    if(modulo == 1n){
        return 0n;
    }else{   
        let c = 1n;
        let i = 0n;
        for(i = 0n; i <= (exponent - 1n); i++){
            c = (c * base) % modulo;
        }
        return c;
    }
}

/*
modPow Right-to-left binary method
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
