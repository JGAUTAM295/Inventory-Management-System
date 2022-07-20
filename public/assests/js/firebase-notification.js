 try 
 {
    if (!firebase.apps.length) {
        const firebaseConfig = { 
            apiKey: "AIzaSyC3QIOQVBUFX_8QqE3loiIvDK8P5fj6BT4",
    
            authDomain: "imes-notification.firebaseapp.com",
            
            databaseURL: "https://imes-notification.firebaseio.com",
            
            projectId: "imes-notification",
            
            storageBucket: "imes-notification.appspot.com",
            
            messagingSenderId: "327845263046",
            
            appId: "1:327845263046:web:db1fc5f5b26833dabcc9c7",
            
            measurementId: "G-4NGY7YC7VH"
        };
        
        firebase.initializeApp(firebaseConfig);
    }
    
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() 
    {
        Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            navigator.serviceWorker.register('./public/firebase-messaging-sw.js')
            .then(function (registration) {
                // Registration was successful
                console.log('firebase-message-sw :ServiceWorker registration successful with scope: ', registration.scope);
                messaging.useServiceWorker(registration);
                
                messaging.getToken().then((currentToken) => {
                    if (currentToken) 
                    {
                        console.log(currentToken);
                        $('#fcmtoken').val(currentToken);
                        
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });
                        
                        // $.ajax({
                        //     url: '/save-token',
                        //     type: 'POST',
                        //     data: {
                        //         token: currentToken
                        //     },
                        //     dataType: 'JSON',
                        //     success: function (response) {
                        //         console.log('Token saved successfully.');
                        //     },
                        //     error: function (err) {
                        //         console.log(err);
                        //     },
                        // });
                  } 
                  else 
                  {
                    // Show permission request.
                    console.log('No Instance ID token available. Request permission to generate one.');

                  }
                }).catch((err) => {
                  console.log('An error occurred while retrieving token. ', err);
                  //toastr.error('User Chat Token Error'+ err, null, {timeOut: 3000, positionClass: "toast-bottom-right"});
                });
                
              }, function (err) {
                // registration failed :(
                console.log('firebase-message-sw: ServiceWorker registration failed: ', err);
              });
            
            console.log('Notification permission granted.');
               
          } 
          else 
          {
            console.log('Unable to get permission to notify.');
          }
        });
    }
    
    /** What we need to do when the existing token refreshes for a user */
    messaging.onTokenRefresh(function() {
        messaging.getToken()
        .then(function(renewedToken) {
            console.log(renewedToken);
            $('#fcmtoken').val(currentToken);
            /** UPDATE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
            
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            
            // $.ajax({
            //     url: '/save-token',
            //     type: 'POST',
            //     data: {
            //         token: renewedToken
            //     },
            //     dataType: 'JSON',
            //     success: function (response) {
            //         console.log('Token saved successfully.');
            //     },
            //     error: function (err) {
            //         console.log('User Chat Token Error'+ err);
            //     },
            // });
    
        })
        .catch(function(error) {
            /** If some error happens while fetching the token then handle here */
            console.log('Error in fetching refreshed token ' + error);
        });
    });

    // Handle incoming messages
    messaging.onMessage(function(payload) {
        const notificationTitle = payload.notification.title;
        const notificationOptions = {
            body: payload.notification.body,
            icon: 'http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png',
            image: 'http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png'
        };
        
          if(Notification.permission==="granted")
          {
                //var notification=new Notification(notificationTitle,notificationOptions);
                toastr.success(notificationOptions.body, notificationTitle);
                return self.registration.showNotification(notificationTitle, notificationOptions);
               
                notification.onclick=function (ev) {
                    ev.preventDefault();
                    window.open(payload.notification.click_action,'_blank');
                    notification.close();
                }
            }
    });
     
    } 
    catch (e) 
    {
        console.log("firebase startup error ", e);
    }
    
(function($) {
    $(document).ready(function() {

        initFirebaseMessagingRegistration(); // start the loop
    });
})(jQuery);