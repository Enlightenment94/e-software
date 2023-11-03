function isPrime(n){
    // Corner case
    if (n <= 1)
        return false;
  
    // Check from 2 to n-1
    for (let i = 2; i < n; i++)
        if (n % i == 0)
            return false;
  
    return true;
}

//Poprostu losuje liczby i sprawdzwa czy są modulo tak idąc to
//recurisve może mieć większą skuteczność 
function fermatCheckPrime(isPrime, depth){
    var i, isPrime, randNumber;
    var x; // x = a^(p-1), gdzie a jest losowane w każdym obiegu
     
    for (i = 0; i < depth; i++){
        randNumber = Math.floor(Math.random() * isPrime) + 1;

        x = Math.pow(randNumber, isPrime-1); 
        
        //Obliczamy modulo
        if (x % isPrime != 1){
            console.log(isPrime + " not prime");
            break;
        }
    }

    if (i == depth){
        console.log("isPrime " + isPrime + " is prime of currency equal depth " + depth);
    }
}


