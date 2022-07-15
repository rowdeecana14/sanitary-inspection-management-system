$(document).ready(function(){
    let module = 'dashboard';
    let genders = document.getElementById('genders').getContext('2d'),
    person_disabilities = document.getElementById('person_disabilities').getContext('2d'),
    resident_registrations = document.getElementById('resident_registrations').getContext('2d'),
    complaint_incidents = document.getElementById('complaint_incidents').getContext('2d'),
    permits_issued = document.getElementById('permits_issued').getContext('2d'),
    certificates_issued = document.getElementById('certificates_issued').getContext('2d');

    loadWidgets();
    loadGendersGraph();
    loadPersonDisabilitiesGraph();
    loadResidentsGraph();
    loadComplaintsGraph();
    loadPermitsGraph();
    loadCertificatesGraph();

    loadWelcomeMessage();

    function loadWelcomeMessage() {
        if($('meta[name="login-count"]').attr('content') == 1) {

            $('.auth-name').text(auth_user.name);
            $('.auth-position').text(auth_user.position);
            $('.auth-image').attr('src', auth_user.image);

            saveMessage(`Hello ${auth_user.fname}, welcome sanitary inspection management system.`);
        }
        else {
            loadUserDetails();
        }
    }

    async function loadWidgets() {
        let payload = {
            module: module,
            action: 'widgets',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            Object.keys(response.data).forEach(key => {
                $(`.${key}`).text(response.data[key]);
            });
        }
        else {
            serverError();
        }
    }

    async function loadGendersGraph() {
        let payload = {
            module: module,
            action: 'genders',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            var genders_chart = new Chart(genders, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: response.data.values,
                        backgroundColor: response.data.colors,
                        borderWidth: 0
                    }],
                    labels: response.data.labels
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position : 'bottom',
                        labels : {
                            fontColor: 'rgb(154, 154, 154)',
                            fontSize: 11,
                            usePointStyle : true,
                            padding: 20
                        }
                    },
                    pieceLabel: {
                        render: 'percentage',
                        fontColor: 'white',
                        fontSize: 14,
                    },
                    tooltips: false,
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 20
                        }
                    }
                }
            });
        }
        else {
            serverError();
        }
    }

    async function loadPersonDisabilitiesGraph() {
        let payload = {
            module: module,
            action: 'person_disabilities',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            var person_disabilities_chart = new Chart(person_disabilities, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: response.data.values,
                        backgroundColor: response.data.colors,
                        borderWidth: 0
                    }],
                    labels: response.data.labels
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position : 'bottom',
                        labels : {
                            fontColor: 'rgb(154, 154, 154)',
                            fontSize: 11,
                            usePointStyle : true,
                            padding: 20
                        }
                    },
                    pieceLabel: {
                        render: 'percentage',
                        fontColor: 'white',
                        fontSize: 14,
                    },
                    tooltips: false,
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 20
                        }
                    }
                }
            });
        }
        else {
            serverError();
        }
    }

    async function loadComplaintsGraph() {
        let payload = {
            module: module,
            action: 'complaints',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            var complaint_incidents_chart = new Chart(complaint_incidents, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Complaint Incidents",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data
                    }]
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels : {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    layout:{
                        padding:{left:15,right:15,top:15,bottom:15}
                    }
                }
            });
        }
        else {
            serverError();
        }
    }

    async function loadPermitsGraph() {
        let payload = {
            module: module,
            action: 'permits',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            var permits_issued_chart = new Chart(permits_issued, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Business Permits",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.business_permits
                    },{
                        label: "Sanitary Permits",
                        borderColor: "#59d05d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#59d05d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.sanitary_permits
                    }]
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels : {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    layout:{
                        padding:{left:15,right:15,top:15,bottom:15}
                    }
                }
            });
        }
        else {
            serverError();
        }
    }

    async function loadCertificatesGraph() {
        let payload = {
            module: module,
            action: 'certificates',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            var certificates_issued_chart = new Chart(certificates_issued, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Health Certificates",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.health_certificates
                    },{
                        label: "Medical Certificates",
                        borderColor: "#59d05d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#59d05d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.medical_certificates
                    },
                    {
                        label: "Exhumation Certificates",
                        borderColor: "#6f42c1 ",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#f3545d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.exhumation_certificates
                    },
                    {
                        label: "Tranfer Cadavers",
                        borderColor: "#ffad46 ",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#ffad46",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data.transfer_cadavers
                    }
                ]
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels : {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    layout:{
                        padding:{left:15,right:15,top:15,bottom:15}
                    }
                }
            });
        }
        else {
            serverError();
        }
    }


    async function loadResidentsGraph() {
        let payload = {
            module: module,
            action: 'residents',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(response.success) {
            let resident_registrations_chart = new Chart(resident_registrations, {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Residnets",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: response.data
                    },
                ],
                    
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: 'top',
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    layout:{
                        padding:{left:15,right:15,top:15,bottom:15}
                    }
                }
            });
        }
        else {
            serverError();
        }
    }
});