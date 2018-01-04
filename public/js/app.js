(function(){
	'use strict';

	var app = angular.module('myApp',[]);
	app.controller('cuboController', cuboController);

	function cuboController($http,$scope){
		var vm = this;

		vm.data = {
        	cubo : {
            	tests : '',
            	numeroMatriz : '',
            	numeroComandos : ''
       		},
        	comandos : [],
        	nuevoComando : '',
        	acciones: 0,
        	pruebas: 0
    	}

    	vm.configurar = configurar;
    	vm.resetearCubo = resetearCubo;
    	vm.enviarComando = enviarComando;

    	function configurar(){
    		if ( !vm.data.cubo.tests || !vm.data.cubo.numeroMatriz || !vm.data.cubo.numeroComandos) {
                return alert("Debe Completar la Configuracion!");
            }

            vm.data.comandos = [];
            vm.data.nuevoComando = "";
            vm.data.acciones = 0;

            var request = {
                numeroComandos: vm.data.cubo.numeroComandos,
                numeroMatriz: vm.data.cubo.numeroMatriz
            }

            $.post("/cube-summation/public/configurar",request)
            	.then(function(data) {
                    console.log('data', data);
                    alert("Configurdo Exitosamente");
            	}, function(error){
                    console.log('error', error);
            		processErrorMessages(error);
            });
    	}

    	function resetearCubo() {
            vm.data.pruebas = 0;
            vm.data.cubo.numeroComandos  = '';
            vm.data.cubo.numeroMatriz = '';
            alert('Reseteado Exitosamente');
    	}

    	function enviarComando(){
    		var comandos = vm.data.nuevoComando.split(" ");

    		switch (comandos[0].toUpperCase()) {
                case "UPDATE":
                    if (comandos.length !== 5) {
                        return alert("Comando UPDATE mal formado");
                    }
                    $.post("actualizar", {
                        x: comandos[1],
                        y: comandos[2],
                        z: comandos[3],
                        value: comandos[4]
					}).then(function () {
                        vm.data.comandos.push({text: vm.data.nuevoComando, date: new Date(), response: "OK"});
                        vm.data.nuevoComando = "";
                        $scope.$apply();
                    },function(error){
                        console.log('error', error);
                    	MostrarError(error);
                    });
                	break;
                case "QUERY":
                    if (comandos.length !== 7) {
                        return alert("Comando QUERY mal formado");
                    }
                    $.post("/consultar", {
                        x1: comandos[1],
                        y1: comandos[2],
                        z1: comandos[3],
                        x2: comandos[4],
                        y2: comandos[5],
                        z2: comandos[6]
                    }).then(function (response) {
                        vm.data.comandos.push({text: vm.data.nuevoComando, date: new Date(), response: response.resultado});
                        vm.data.nuevoComando = "";
                        console.log(response);
                        $scope.$apply();
                    }, function(error){
                        console.log(error);
                    	MostrarError(error);
                    });
                    break;
                default:
                    return alert("El comando " + vm.data.nuevoComando + " no es valido");
                	break;
            }
    	}

    	function MostrarError(response) {
    		if (response.responseJSON.error) {
        		alert(response.responseJSON.error);
    		} else {
        		var keys = Object.keys(response.responseJSON);
        		alert("Hay errores en los campos: " + keys);
    		}
		}

        vm.desabilitarNuevoComando = function(){
    	    if(vm.data.nuevoComando === '' && vm.data.acciones != vm.data.cubo.numeroComandos ){
                return true;
            }else {
    	        return false;
            }
        }
	}
})();