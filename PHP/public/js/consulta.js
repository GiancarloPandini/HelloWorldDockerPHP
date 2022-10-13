var QTD_TOTAL_REGISTROS = 0;
var ID_PESSOA_SELECIONADA = 0;


var consulta = {
    executaConsulta: function () {
        axios.get('/app/pessoa', {

        })
        .then(function (response) {
            let linhas = Array.from($('#tabelaConsulta tbody tr'));
            linhas.forEach((elemento) => {
                elemento.remove();
            });
            let corpoConsulta = $('#tabelaConsulta tbody');
            response.data.forEach((novoRegistro) => {
                corpoConsulta.append(consulta.getLinhaConsulta(novoRegistro));
            });
            consulta.atualizaTotalCadastrados();
        })
        .catch(function (error) {
            console.error(error);
        })
    },

    atualizaTotalCadastrados: function () {
        axios.get('/app/pessoa/count')
            .then(function (response) {
                QTD_TOTAL_REGISTROS = response.data.count;
                $('#hintTotalRegistros').html(`${QTD_TOTAL_REGISTROS} Pessoas cadastradas`);
            })
            .catch(function (error) {
                console.error(error);
            });
    },

    addicionaLinhasVazias: function (qtd) {
        let corpoConsulta = $('#tabelaConsulta tbody');
        for (let index = 0; index < qtd; index++) {
            corpoConsulta.append(consulta.getLinhaConsulta());
        }
    },

    executaInclusao: function () {
        let [cmpNome, cmpSobrenome, cmpApelido, cmpDataNascimento, cmpSexo] = $('#FormIncluir .form-control');
        axios.post('/app/pessoa', {
            nome: cmpNome.value,
            sobrenome: cmpSobrenome.value,
            apelido: cmpApelido.value,
            dataNascimento: cmpDataNascimento.value,
            sexo: cmpSexo.value
        })
        .then(function (response) {
            $('#CloseButtonFormIncluir').click();
            consulta.executaConsulta();
            $('#FormIncluir .form-control').val('');
        })
        .catch(function (error) {
            $('#CloseButtonFormIncluir').click();
            consulta.executaConsulta();
            $('#FormIncluir .form-control').val('');
        });
    },

    executaAlteracao: function () {
        let [cmpNome, cmpSobrenome, cmpApelido, cmpDataNascimento, cmpSexo] = $('#FormAlterar .form-control');
        axios.put('/app/pessoa', {
            id: ID_PESSOA_SELECIONADA,
            nome: cmpNome.value,
            sobrenome: cmpSobrenome.value,
            apelido: cmpApelido.value,
            dataNascimento: cmpDataNascimento.value,
            sexo: cmpSexo.value
        })
        .then(function (response) {
            $('#CloseButtonFormAlterar').click();
            consulta.executaConsulta();
            $('#FormAlterar .form-control').val('');
        })
        .catch(function (error) {
            $('#CloseButtonFormAlterar').click();
            consulta.executaConsulta();
            $('#FormAlterar .form-control').val('');
        });
    },

    executaExclusao: function () {
        axios.delete('/app/pessoa', {
            data: {
                id: ID_PESSOA_SELECIONADA
            }
        })
        .then(function (response) {
            $('#CloseButtonFormExcluir').click();
            consulta.executaConsulta();
        })
        .catch(function (error) {
            $('#CloseButtonFormExcluir').click();
            consulta.executaConsulta();
        });
    },

    defineId: function (idPessoa) {
        ID_PESSOA_SELECIONADA = idPessoa;
    },

    getLinhaConsulta: function (registro) {
        if (typeof registro == 'undefined') {
            return `<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>`;
        }
        return `<tr>
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                            <label for="checkbox1"></label>
                        </span>
                    </td>
                    <td>${registro.id}</td>
                    <td>${registro.nome}</td>
                    <td>${registro.sobrenome}</td>
                    <td>${registro.apelido}</td>
                    <td>${registro.data_nascimento}</td>
                    <td>${(registro.sexo == 1) ? 'M' : 'F'}</td>
                    <td>
                        <a onclick="consulta.defineId('${registro.id}')" href="#editEmployeeModal" class="edit" data-toggle="modal">
                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                        </a>
                        <a onclick="consulta.defineId('${registro.id}')" href="#deleteEmployeeModal" class="delete" data-toggle="modal">
                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                        </a>
                    </td>
                </tr>`;

    }
};

