const firebaseConfig = {
    apiKey: "AIzaSyClQpFR2KthO4HZ1xtma701O8sef0TSPPU",
    authDomain: "app-project-notification.firebaseapp.com",
    databaseURL: "https://app-project-notification.firebaseio.com",
    projectId: "app-project-notification",
    storageBucket: "app-project-notification.appspot.com",
    messagingSenderId: "748046306262",
    appId: "1:748046306262:web:e94c153f5751d62c717277",
    measurementId: "G-883ZLR55RS"
};

firebase.initializeApp(firebaseConfig);

//--------------------------------------------------------------------

const messaging = firebase.messaging();
      messaging
            .requestPermission()
            .then(function(){

                console.log("Permiso de notificación otorgado.");
                return messaging.getToken()

            }).then(function(token){    
                // $('#device_token').val(token);
                console.log(token)
            }).

            catch(function(err){
                console.log("No se puede obtener permiso para notificar.", err);
            });

//---------------------------------------------------------------------

messaging.onMessage((payLoad) => {
    console.log(payLoad);
})