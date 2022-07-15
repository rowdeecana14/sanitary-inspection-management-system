$(document).ready(function(){
    let app_name = 'SIMS';
    let app_csrf_token = $('meta[name="csrf-token"]').attr('content');
    let app_api_url = $('meta[name="api-url"]').attr('content');
    let base_url = $('meta[name="base-url"]').attr('content');

    preload();

    function runLoader(el) {
        let fontSize = '';
        let num = 1;
        let effect = 'roundBounce';
        let text = 'Processing ...';
    
        switch (num) {
            case 1:
                maxSize = '';
                textPos = 'vertical';
                break;
            case 2:
                text = '';
                maxSize = 30;
                textPos = 'vertical';
                break;
            case 3:
                maxSize = 30;
                textPos = 'horizontal';
                fontSize = '18px';
                break;
        }
    
        el.waitMe({
            effect: effect,
            text: text,
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: maxSize,
            waitTime: -1,
            source: 'img.svg',
            textPos: textPos,
            fontSize: fontSize,
            onClose: function(el) {}
        });
    }

    function serverError() {
        swal({
            title: 'System error',
            text: "Contact to your administrator",
            type: 'warning',
            icon: 'warning',
            timer: 10000,
            buttons:{
                confirm: {
                    text : 'Okay',
                    className : 'btn btn-secondary'
                }
            }
        });
    }

    async function preload() {

        runLoader($('body'));
        let exhumation_id = $('meta[name="exhumation_id"]').attr('content');
        
        let payload = {
            module: 'exhumation_certificate',
            action: 'prints',
            csrf_token: app_csrf_token,
            id: exhumation_id,
        };
        const response = await fetch(app_api_url, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify(payload)
        });
        const data = await response.json();

        if(data.success) {
            loadPrintDetails(data.data);
        }
        else {
            serverError();
        }

        $('body').waitMe("hide");
    }

    function loadPrintDetails(data) {
        Object.keys(data).forEach(key => {

            if(!['', null].includes(data[key])) {
                if($('body').find(`.${key}`).is('img')) {
                    $('body').find(`.${key}`).attr("src", data[key]);
                }
                else {
                    $('body').find(`.${key}`).text(data[key]);
                }
            }
        });
    }
});