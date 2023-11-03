// Javascript program Miller-Rabin primality test
// based on JavaScript code found at https://www.geeksforgeeks.org/primality-test-set-3-miller-rabin/

// Utility function to do
// modular exponentiation.
// It returns (x^y) % p
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
