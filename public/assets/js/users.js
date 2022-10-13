/*

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal. Contact us if you want to remove it.

*/
"use strict";
const f = document;
f.addEventListener("DOMContentLoaded", function (event) {

    const inputsHidden = ['inputCelular', 'inputCumpleanios', 'inputDireccion', 'inputBarrio', 'inputLocalidad', 'inputCiudad', 'inputIdentificacion', 'inputPlaca'];

    const clientsInputs = [ "inputCelular", "inputCumpleanios", "inputDireccion", "inputBarrio", "inputLocalidad", "inputCiudad", "inputIdentificacion" ];
    const domiciliaryInpus = [ "inputCelular", "inputPlaca" ];
    
    inputsHidden.forEach((element) => {
        document.getElementById(element).parentElement.style.display = 'none'
    })

    var myModal = new bootstrap.Modal(document.getElementById('createUser'));

    myModal._element.addEventListener('shown.bs.modal', function (e) {
        let type = f.getElementById('roleTipo').value;
        if (type == 'client') {
            // Hidden inputs to clients
            hiddenInputs(domiciliaryInpus);

            // Show inputs to domiciliary
            showInputs(clientsInputs);

        } else if (type == 'domiciliary') {
            // Hidden inputs to domiciliary
            hiddenInputs(clientsInputs);

            // Show inputs to clients
            showInputs(domiciliaryInpus);
        } else {
           
            // Hidden inputs to domiciliary
            // Hidden inputs to clients
            hiddenInputs(clientsInputs);
            hiddenInputs(domiciliaryInpus);
        }

        
        //Para cuando se cambia el valor del selector
        f.getElementById('roleTipo').addEventListener('change', () => {
            let typex = f.getElementById('roleTipo').value;
            
            if(typex == 'client') {
                // Hidden inputs to clients
                hiddenInputs(domiciliaryInpus);

                // Show inputs to domiciliary
                showInputs(clientsInputs);

            }else if(typex == 'domiciliary'){
                // Hidden inputs to domiciliary
                hiddenInputs(clientsInputs);
                // Show inputs to clients
                showInputs(domiciliaryInpus);
            }else {
                // Hidden inputs to domiciliary
                // Hidden inputs to clients
                hiddenInputs(clientsInputs);
                hiddenInputs(domiciliaryInpus);
            }
        })

        
        
    });
    myModal._element.addEventListener('hidden.bs.modal', function (e) {
    });    

})

function showInputs(arrayInputs) {
    arrayInputs.forEach((element) => {
            document.getElementById(element).parentElement.style.display = 'block'
    })
}

function hiddenInputs(arrayInputs) {
    arrayInputs.forEach((element) => {  
        document.getElementById(element).parentElement.style.display = 'none'
    })
}