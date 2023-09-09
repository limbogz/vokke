$(() => {
    let sMethod = 'POST';
    let iCurrentId = 0;

    initialize();

    /**
     * init
     * Initialize functions
     */
    function initialize() {
        setCsrfToken();
        setEvents();

        let sPathName = window.location.pathname;
        let aRouteValue = sPathName.split('/');
        if (aRouteValue[2] === 'edit') {
            sMethod = 'PUT'
            iCurrentId = aRouteValue[3];
            getKangarooData(iCurrentId);
        }
    }

    /**
     * setCsrfToken
     * Includes CSRF token to AJAX requests
     */
    function setCsrfToken() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    /**
     * setEvents
     */
    function setEvents() {
        $('#submit').click(function() {
            let oFormData = validateFields();
            if ($.isEmptyObject(oFormData) === false) {
                submitFields(oFormData);
            }
        });

        $('#cancel').click(function() {
            window.location.href = '/';
        });
    }

    /**
     * validateFields
     * @returns {object}
     */
    function validateFields() {
        let oFormData = {};

        //trim and add data to object
        $('input, select', $('#kangaroo_form_data')).each(function() {
            oFormData[$(this).attr('id')] = $.trim($(this).val());
        });

        //Removes inline error messages
        $('.invalid-feedback').text('').hide();
        if (validateEmptyFields(oFormData) === false || checkDuplicateName(oFormData['name']) === false || validateValidFields(oFormData) === false) {
            return {};
        }

        return oFormData
    }

    /**
     * validateEmptyFields
     * @param {object} oFormData
     * @returns {boolean}
     */
    function validateEmptyFields(oFormData) {
        const oEmptyMessages = {
            name     : 'Name is required',
            weight   : 'Weight is required',
            height   : 'Height is required',
            gender   : 'Gender is required',
            birthday : 'Birthday is required'
        }

        let bValidParam = true;
        $.each(oFormData, function(sKey, sValue) {
            //check if in required fields and is not empty
            if ((sKey in oEmptyMessages) && !sValue === true) {
                $('#' + sKey + '-error').text(oEmptyMessages[sKey]).show();
                bValidParam = false;
            }
        });

        return bValidParam;
    }

    /**
     * checkDuplicateName
     * @param {string} sName
     * @returns {boolean}
     */
    function checkDuplicateName(sName) {
        let bValidParam = true;
        let oParams = {name : sName};
        if (sMethod === 'PUT') {
            $.extend(oParams, {kangaroo_id: iCurrentId});
        }

        $.ajax({
            url: '/api/kangaroo/duplicate?' + $.param(oParams),
            type: 'GET',
            async: false,
            success: function(oResult) {
                if ('data' in oResult) {
                    $('#name-error').text(oResult.data.message).show();
                    bValidParam = false;
                }
            }
        })

        return bValidParam;
    }

    /**
     * validateValidFields
     * @param {object} oFormData
     * @returns {boolean}
     */
    function validateValidFields(oFormData) {
        let bValidParam = true;
        let oErrorMessages = {
            name     : 'Name should only consists of letters',
            nickname : 'Name should only consists of letters',
            weight   : 'Weight should be a positive float number with up to 2 decimal places',
            height   : 'Weight should be a positive float number with up to 2 decimal places',
            color    : 'Color should only consists of letters'
        }

        let oValidationRules = {
            name: new RegExp('^[a-zA-Z ]*$'),
            nickname: new RegExp('^[a-zA-Z ]*$'),
            weight: new RegExp('^\\d*\\.?\\d{0,2}$'),
            height: new RegExp('^\\d*\\.?\\d{0,2}$'),
            color: new RegExp('^[a-zA-Z ]*$')
        }

        $.each(oFormData, function(sKey, sValue) {
            if ((sKey in oValidationRules) && oValidationRules[sKey].test(sValue) === false) {
                $('#' + sKey + '-error').text(oErrorMessages[sKey]).show();
                bValidParam = false;
            }
        });
        console.log(bValidParam)
        return bValidParam;
    }

    /**
     * getKangarooData
     * @param {string} iId
     */
    function getKangarooData(iId) {
        $.ajax({
            url: '/api/kangaroo/' + iId,
            type: 'GET',
            success: function(oResult) {
                $.each(oResult, function(sKey, mValue) {
                    $('#' + sKey).val(mValue);
                });
            },
            error: function() {
                alert('Something went wrong!');
                window.location.href = '/';
            }
        })
    }

    /**
     * submitFields
     * @param {object} oFormData
     */
    function submitFields(oFormData) {
        let sAlertMessage = 'Added';
        if (sMethod === 'PUT') {
            oFormData['kangaroo_id'] = iCurrentId;
            sAlertMessage = 'Modified';
        }

        $.ajax({
            url: '/api/kangaroo',
            method: sMethod,
            data: oFormData,
            success: function() {
                alert('Successfully ' + sAlertMessage);
                window.location.href = '/';
            },
            error: function() {
                alert('Something went wrong');
                location.reload();
            }
        })
    }

});
