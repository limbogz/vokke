/**
 * oDataList
 * Functionalities for the Data Grid
 * @since 2023.09.08
 */
var oDataList = {
    /**
     * getDataList
     */
    getDataList: function() {
        $.ajax({
            type: "GET",
            url: "/api/kangaroo",
            success: function(oResult) {
                oDataList.setDataGrid(oResult)
            }
        })
    },

    /**
     * setDataGrid
     * @param {object} oData
     */
    setDataGrid: function(oData) {
        $('#gridContainer').dxDataGrid({
            dataSource: oData,
            showBorders: true,
            loadPanel: {
                enabled: true
            },
            keyExpr: 'kangaroo_id',
            filterRow: {
                visible: true,
                applyFilter: 'auto'
            },
            toolbar: {
                items: [
                    {
                        widget: 'dxButton',
                        location: 'before',
                        options: {
                            text: 'Add New Kangaroo',
                            onClick: function() {
                                window.location.href = '/kangaroo/create';
                            }
                        }
                    }
                ]
            },
            columns: [
                {
                    dataField: 'name',
                    caption: 'Name',
                    alignment: 'center'
                },
                {
                    dataField: 'nickname',
                    caption: 'Nickname',
                    alignment: 'center',
                    cellTemplate: function(oContainer, oOptions) {
                        if (!oOptions.data.nickname) {
                            $(oContainer).text('-');
                        } else {
                            $(oContainer).text(oOptions.data.nickname);
                        }
                    }
                },
                {
                    dataField: 'weight',
                    caption: 'Weight',
                    alignment: 'center'

                },
                {
                    dataField: 'height',
                    caption: 'Height',
                    alignment: 'center'
                },
                {
                    dataField: 'gender',
                    caption: 'Gender',
                    alignment: 'center'
                },
                {
                    dataField: 'color',
                    caption: 'Color',
                    alignment: 'center',
                    cellTemplate: function(oContainer, oOptions) {
                        if (!oOptions.data.color) {
                            $(oContainer).text('-');
                        } else {
                            $(oContainer).text(oOptions.data.color);
                        }
                    }
                },
                {
                    dataField: 'friendliness',
                    caption: 'Friendliness',
                    alignment: 'center',
                    cellTemplate: function(oContainer, oOptions) {
                        if (!oOptions.data.friendliness) {
                            $(oContainer).text('-');
                        } else {
                            $(oContainer).text(oOptions.data.friendliness);
                        }
                    }
                },
                {
                    dataField: 'birthday',
                    caption: 'Birthday',
                    alignment: 'center',
                    dataType: 'date',
                    format: 'MM-dd-yyyy'
                },
                {
                    type: 'buttons',
                    buttons: [{
                        template: function(oContainer, oOptions) {
                            $('<a>')
                                .addClass('dx-link')
                                .text('Edit')
                                .on('dxclick', function() {
                                    window.location.href = '/kangaroo/edit/' + oOptions.data.kangaroo_id;
                                })
                                .appendTo(oContainer);
                        }
                    }]
                }
            ],
        })
    }
}

oDataList.getDataList();
