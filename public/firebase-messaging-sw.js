importScripts('https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.12.0/firebase-messaging.js');


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

var messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payLoad){
    console.log('[firebase-messaging-sw.js] Received background message', payload);

    var notificationTitle  = 'Background message Title';
    var notificationOptions = {
        body: 'Background Message body',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle, 
        notificationOptions);
});