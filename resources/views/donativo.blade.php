<!DOCTYPE html>
<html lang="pt-BR" ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paypal - test donativos</title>
    <link rel="stylesheet" href="/assets/css/app.css">

    <script src="/assets/js/dist.js"></script>
</head>
<body>

    <div class="container" ng-controller="DonativoController">
        <h1>Teste de funcionamento da API Paypal - faça uma doação para testar</h1>

        <div class="row">
            <div class="col-md-2 col-sm-12">
                <div class="well">
                    <button
                        class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalContacts">
                        Contato
                    </button>
                </div>
            </div>
            <div class="col-md-10 col-sm-12">
                @if (isset($danger))
                <div class="well">
                    <div class="alert alert-danger">
                        Você cancelou ou a doação ainda não está completa, status: {{ $danger }} (não traduzido)
                    </div>
                </div>
                @endif
                @if (isset($success))
                <div class="well">
                    <div class="alert alert-success">
                        Obrigado por sua doação no valor de: R$ {{ $success }}
                    </div>
                </div>
                @endif
                <div class="well" ng-show="aguarde">
                    <div class="alert alert-info">Você está sendo redirecionado para fazer o pagamento, por favor aguarde</div>
                </div>
                <div class="well">
                    Esta página é para testes, somente faça uma doação caso queira ver que funciona, vocẽ pode comprar a integração, entrando em contato.
                </div>
                <div ng-repeat="doacao in donativo.doacoes">
                    Doação @{{$index+1}} - Valor: R$ <input type="text" ng-model="doacao.value" readonly="true"> <button type="button" class="btn btn-xs btn-danger" ng-click="del(doacao)" ng-if="donativo.doacoes.length>1">Cancelar</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=1.00">R$ 1,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=2.00">R$ 2,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=5.00">R$ 5,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=10.00">R$ 10,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=20.00">R$ 20,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=30.00">R$ 30,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=50.00">R$ 50,00</button>
                    <button type="button" class="btn btn-xs btn-info" ng-click="doacao.value=100.00">R$ 100,00</button>
                </div>
                <div class="well">
                    Total: R$ @{{total}}
                </div>
                <button class="btn btn-xs btn-success" type="button" ng-click="addDoacao()">Adiconar outra doação</button>

                <button class="btn btn-xs btn-primary" type="button" ng-click="save()">Efetuar doação</button>

                <div class="well">
                    <div>Problemas ou sugestões? <a href data-toggle="modal" data-target="#modalContacts">Entre em contato</a></div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modalContacts">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Contato</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" ng-show="sendContacts">
                            <div class="alert alert-info">Estamos enviando sua mensagem por favor aguarde...</div>
                        </div>
                        <div class="row" ng-hide="sendContacts">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Contato</div>
                                    <div class="panel-body">

                                        <form class="form-horizontal" ng-submit="sendContact(contacts)">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Nome</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" ng-model="contacts.name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Email</label>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" ng-model="contacts.email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Telefone</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" ng-model="contacts.phone">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Mensagem</label>
                                                <div class="col-md-6">
                                                    <textarea ng-model="contacts.comments" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                                        Enviar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" ng-click="closeModal()">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>

    <div>
        <script src="/assets/js/app.js"></script>
    </div>
</body>
</html>
