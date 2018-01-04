@extends('layouts.main')

@section('content')

<div ng-controller="cuboController as vm">
    <div class="row">
        <div class="col-md-8">
            <form novalidate>
                <label for="instruccion">Insertar Instruccion</label>
                <div class="input-group">
                    <input type="text" ng-model="vm.data.nuevoComando" class="form-control" ng-disable="vm.data.acciones >= vm.data.cubo.numeroComandos" placeholder="Insertar Instruccion">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" ng-disabled="vm.desabilitarNuevoComando()" ng-if="vm.data.acciones < vm.data.cubo.numeroComandos" ng-click="vm.enviarComando()"> Enviar Nuevo Comando! </button>
                        <button class="btn btn-primary" ng-if="vm.data.acciones >= vm.data.cubo.numeroComandos" ng-click="vm.resetearCubo()"> Reiniciar</button>
                    </span>
                </div>    
            </form>

            <br> <br> 

            <form novalidate>
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Configuracion del cubo </h3>            
                        </div>
                        <div class="panel-body">
                            <form novalidate="">
                                <div class="form-group">
                                    <label>
                                        Tests
                                    </label>
                                    <input type="number" class="form-control" ng-model="vm.data.cubo.tests">
                                </div>
                                <div class="form-group">
                                    <label> Numero de la Matriz </label>
                                    <input type="number" class="form-control" ng-model="vm.data.cubo.numeroMatriz">
                                </div>
                                <div class="form-group">
                                    <label> Numero de Comandos </label>
                                    <input type="number" class="form-control" ng-model="vm.data.cubo.numeroComandos">
                                </div>    
                                <button class="btn btn-primary" ng-click="vm.configurar()"> Configurar! </button>
                            </form>
                        </div>
                    </div>
                </div>    
            </form>
        </div>

        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="comando in vm.data.comandos">
                    <span> Comando : @{{ comando.text }}</span><br>
                    <span> Respuesta : @{{ comando.response }}</span><br>
                    <small> Fecha : @{{ comando.date}}</small>
                </li>
            </ul>
        </div>

    </div>
</div>

@endsection