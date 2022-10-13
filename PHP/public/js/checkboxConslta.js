var checkBoxConsulta = {
    inciaComporamentos: function() {
        this.activateTooltip();
        this.iniciaComportamentoSelectAll();
        this.iniciaComportamentoCheckbox();

    },

    activateTooltip: function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();
    },

    iniciaComportamentoSelectAll: function() {
        $("#selectAll").click(function () {
            let allCheckBox = $('table tbody input[type="checkbox"]');
            let SelectAllIsMarcado = this.checked;
            allCheckBox.each(function () {
                this.checked = SelectAllIsMarcado;
            });
        });
    },

    iniciaComportamentoCheckbox: function() {
        let allCheckBox = $('table tbody input[type="checkbox"]');
        allCheckBox.click(function () {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    }
};