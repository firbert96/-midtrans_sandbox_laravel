<?php 
    if(env('APP_ENV') == 'prod')
    {
        $srcSnapJS = env('SRC_SNAP_JS_PROD');
        $clientKey = env('CLIENT_KEY_MIDTRANS_PROD');
    }
    else if(env('APP_ENV') == 'dev')
    {
        $srcSnapJS = env('SRC_SNAP_JS_DEV');
        $clientKey = env('CLIENT_KEY_MIDTRANS_DEV');
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    </head>
    <body>
        <div style="margin:5%">
            <button id="pay-button" type="button" class="btn btn-primary">Pay</button>
            <script src="{{$srcSnapJS}}" data-client-key="{{$clientKey}}"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function(){
                    // SnapToken acquired from previous step           
                    snap.pay('{{$token}}', {
                        // Optional
                        onSuccess: function(result){
                            document.getElementById('result-json-success').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onPending: function(result){
                            document.getElementById('result-json-pending').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onError: function(result){
                        document.getElementById('result-json-error').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                };
            </script>
            <div class="row">
                <div class="col-4">
                    <pre><div id="result-json-pending">JSON result will appear here after payment is pending:<br></div></pre>
                </div>
                <div class="col-4">
                    <pre><div id="result-json-success">JSON result will appear here after payment is success:<br></div></pre>
                </div>
                <div class="col-4">
                    <pre><div id="result-json-error">JSON result will appear here after payment is error:<br></div></pre>
                </div>
            </div>  
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>