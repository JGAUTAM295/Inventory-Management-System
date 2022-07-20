/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
// importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyC3QIOQVBUFX_8QqE3loiIvDK8P5fj6BT4",
    authDomain: "imes-notification.firebaseapp.com",
    databaseURL: "https://imes-notification.firebaseio.com",
    projectId: "imes-notification",
    storageBucket: "imes-notification.appspot.com",
    messagingSenderId: "327845263046",
    appId: "1:327845263046:web:db1fc5f5b26833dabcc9c7",
    measurementId: "G-4NGY7YC7VH"
});


/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();

/** THIS IS THE MAIN WHICH LISTENS IN BACKGROUND */
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    // Customize notification here
    // const notificationTitle = "Background Message Title";
    // const notificationOptions = {
    //     body: "Background Message body.",
    //     icon: "http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png",
    // };

    // return self.registration.showNotification(
    //     notificationTitle,
    //     notificationOptions,
    // );
});