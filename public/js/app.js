/**
 * App: Paypal Donativos
 * 
 * @author Leandro Henrique Reis http://henriquereis.com
 */
angular.module('app', ['flashMessage']).constant('APP', {
    name: 'The Paypal Donative',
    debug: false,
    path: '/'
}).controller('DonativoController', ['$rootScope', '$scope', '$http', 'APP', 'flash', DonativoController]);

function DonativoController($rootScope, $scope, $http, APP, flash) {

    var doacao={
        'name': 'doaçao',
        'value': 10
    };

    $scope.donativo={
        doacoes: []
    };

    $scope.$watch('donativo', function(donativo){
        var total=0;
        for (var i = $scope.donativo.doacoes.length - 1; i >= 0; i--) {
            total+=$scope.donativo.doacoes[i].value;
        };
        $scope.total=total;
    },true);

    $scope.contacts={};
    $scope.sendContacts=false;
    $scope.aguarde=false;
    $scope.total=0;

    /**
     * @param  {string} path
     * @param  {object} dados
     * @param  {function} success
     * @param  {function} error
     * @param  {object} config
     *
     * @return success|error
     */
    $rootScope.post = function(path, dados, success, error, config) {
        config = config ? config : $rootScope.getHeaders();
        if (APP.debug) {
            console.log(config);
        }
        $http.post(path, dados, config).then(function(response) {
            if (APP.debug) {
                console.log(response);
            }

            if (typeof success=="function") {
                success(response);
            }
        }, function(response) {
            if (APP.debug) {
                console.log(response);
            }

            if (typeof error=="function") {
                error(response);
            }
        });
    }

    $rootScope.getHeaders=function()
    {
        return {
            headers: {
                'Content-Type': 'application/json'
            }
        };
    }

    /**
     * @param  {string} path
     * @param  {function} success
     * @param  {function} error
     * @param  {object} config
     *
     * @return success|error
     */
    $rootScope.get = function(path, success, error, config) {
        config = config ? config : $rootScope.getHeaders();
        $http.get(path, config).then(function(response) {
            if (typeof success=="function") {
                success(response);
            }
        }, function(response) {

            if (typeof error=="function") {
                error(response);
            }
        });
    }

    $scope.save=function(){
       	var doacao=angular.copy($scope.donativo);
    	var save=$http.post;
    	var path='/doar'

        $scope.aguarde=true;
        flash.confirm(function(){
            save(path, doacao).then(function(response){
                location.href=response.data;
            }, function(response){
                $scope.aguarde=false;
                var errors=[];
                    angular.forEach(response.data.message,function(error, key){
                        errors.push(error);
                    });
                $scope.errors=errors;

                flash.error(errors,'ERRO!');
            })

        },'Continuar?','Fazer doação','Sim','Não');
    }

	$scope.closeModal=function()
	{
        jQuery("#modalContacts").modal('hide');
	}

    $scope.sendContact=function(contact){
        if (contact.name==undefined || contact.name=='') {
            flash.warning('Informe seu nome','AVISO!');

            return;
        }

        if (contact.email==undefined || contact.email=='') {
            flash.warning('Informe seu email','AVISO!');

            return;
        }

        if (contact.comments==undefined || contact.comments=='') {
            flash.warning('Diga alguma coisa','AVISO!');

            return;
        }

        $scope.sendContacts=true;
        $rootScope.post('/contacts', contact, function(response){
            $scope.contacts={};
            jQuery("#modalContacts").modal('hide');
            flash.success('Sua mensagem foi enviada com sucesso!','Obrigado!');
            $scope.sendContacts=false;
        },function(response){
            $scope.sendContacts=false;
            jQuery("#modalContacts").modal('hide');
            flash.error('Houve uma falha no envio de sua mensgaem, por favor verifique os dados informados');

            if (APP.debug){
                console.log(response);
            }
        });
    }

    $scope.del=function(doacao)
    {
        var index=$scope.donativo.doacoes.indexOf(doacao);
        $scope.donativo.doacoes.splice(index, 1);
    }
    $scope.addDoacao=function()
    {
        $scope.donativo.doacoes.push(angular.copy(doacao));
    }

    $scope.addDoacao();
}
