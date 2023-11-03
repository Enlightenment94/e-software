<script>
/*
1. Krok pierwszy dwie ogromne liczby p i q.

2. Obliczamy n. 
Długość n jest długością klucza RSA.
n = p*q

3. Obliczamy Ø
//Ø = ( p - 1 ) × ( q - 1 )

4. Szukamy 
//NWD ( e,  Ø) = 1 

5. Obliczamy d
d × e  mod Ø = 1

6. Wyznaczamy klucze 
(e, n) publiczny
(d, n) prywatny
*/

//Generate prime numbers by ...
//Test Millera-Rabina
function generatePAndQ(){
    
}

//Ø =  ( p - 1 ) × ( q - 1 )
function countEuler(){

}

// n = p*q
function countN(){

}

//NWD ( e,  Ø) = 1 
function generateE(){

}

//d × e  mod Ø = 1
function countD(){

}
</script>
