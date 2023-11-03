//import { otherScript } from './otherScript.js';
const { otherScript } = require('./otherScript.js');
//const {parse} = require('otherScript.js');

function joinScript(){
    console.log("Join script");
    otherScript();
}

function dynamicLoadScript(){
    var script = document.createElement("script");  
    script.src = "otherScript.js";  
   
    document.head.appendChild(script); 
    otherScript();
}
