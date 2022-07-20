@extends('layouts.app')
@section('headcontent')
<!-- firebase integration started -->

<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase.js"></script>
<!-- Firebase App is always required and must be first -->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>

<!-- Add additional services that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-functions.js"></script>

<!-- firebase integration end -->

<!-- Comment out (or don't include) services that you don't want to use -->
 <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-storage.js"></script> 

<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-analytics.js"></script>
  <link rel="stylesheet" href="{{ URL::asset('assests/plugins/toastr/toastr.min.css') }}">

@endsection
@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <center>

                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>

            </center>

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif
  
                    <form id="sendnotification" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Title</label>

                            <input type="text" id="title" class="form-control" name="title">

                        </div>

                        <div class="form-group">

                            <label>Body</label>

                            <textarea id="body" class="form-control" name="body"></textarea>

                          </div>

                        <button type="submit" class="btn btn-primary">Send Notification</button>

                    </form>

  

                </div>

            </div>

        </div>

    </div>

</div>

  
<!-- jQuery -->
<script src="{{ URL::asset('assests/plugins/jquery/jquery.min.js') }}"></script>
<!--<script src="{{ URL::asset('firebase-messaging-sw.js') }}"></script>-->
<script src="{{ URL::asset('assests/plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">

 $('#sendnotification').on('submit', function(e) {
    e.preventDefault();
    var title = $('#title').val();
    var body = $('#body').val();
    
      $.ajax({
          type: "POST",
          url: '{{route("send.notification")}}',
          data: {title:title, body:body},
          headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(response)
          {
            console.log(response);
            //   if(response.status == '200')
            //   {
            //     // toastr.success(response.data);
            //     $("#title").val('');
            //     $("#body").val('');
            //   }
            //   else
            //   {
            //     if(response.data !='')
            //     {
            //     //   toastr.error(response.data);
            //     }
            //     else
            //     {
            //     //   toastr.error('Message Not Sent. Please try again later!');
            //      console.log('Message Not Sent. Please try again later!');
            //     }
                
            //   }
           }
      });
  });
  
    
//     try {
//         if (!firebase.apps.length) {
//             const firebaseConfig = { 
//                 apiKey: "AIzaSyC3QIOQVBUFX_8QqE3loiIvDK8P5fj6BT4",
        
//                 authDomain: "imes-notification.firebaseapp.com",
                
//                 databaseURL: "https://imes-notification.firebaseio.com",
                
//                 projectId: "imes-notification",
                
//                 storageBucket: "imes-notification.appspot.com",
                
//                 messagingSenderId: "327845263046",
                
//                 appId: "1:327845263046:web:db1fc5f5b26833dabcc9c7",
                
//                 measurementId: "G-4NGY7YC7VH"
//             };
            
//             firebase.initializeApp(firebaseConfig);
//         }
    
//         const messaging = firebase.messaging();

//          function initFirebaseMessagingRegistration() 
//          {
//           Notification.requestPermission().then((permission) => {
//               if (permission === 'granted') {
//                 navigator.serviceWorker.register('./public/firebase-messaging-sw.js')
//                 .then(function (registration) {
//                     // Registration was successful
//                     console.log('firebase-message-sw :ServiceWorker registration successful with scope: ', registration.scope);
//                     messaging.useServiceWorker(registration);
                    
//                     messaging.getToken().then((currentToken) => {
//                         if (currentToken) 
//                         {
//                             console.log(currentToken);
                            
//                             $.ajaxSetup({
//                                 headers: {
//                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                                 }
//                             });
                            
//                             $.ajax({
//                                 url: '{{ route("save-token") }}',
//                                 type: 'POST',
//                                 data: {
//                                     token: currentToken
//                                 },
//                                 dataType: 'JSON',
//                                 success: function (response) {
//                                     alert('Token saved successfully.');
//                                 },
//                                 error: function (err) {
//                                     console.log('User Chat Token Error'+ err);
//                                 },
//                             });
//                       } 
//                       else 
//                       {
//                         // Show permission request.
//                         console.log('No Instance ID token available. Request permission to generate one.');

//                       }
//                     }).catch((err) => {
//                       console.log('An error occurred while retrieving token. ', err);
//                       //toastr.error('User Chat Token Error'+ err, null, {timeOut: 3000, positionClass: "toast-bottom-right"});
//                     });
                    
//                   }, function (err) {
//                     // registration failed :(
//                     console.log('firebase-message-sw: ServiceWorker registration failed: ', err);
//                   });
                
//                 console.log('Notification permission granted.');
                   
//               } 
//               else 
//               {
//                 console.log('Unable to get permission to notify.');
//               }
//             });
//          }
         
//          /** What we need to do when the existing token refreshes for a user */
//          messaging.onTokenRefresh(function() {
//             messaging.getToken()
//             .then(function(renewedToken) {
//                 console.log(renewedToken);
//                 /** UPDATE TOKEN::From here you need to store the TOKEN by AJAX request to your server */
                
//                 $.ajaxSetup({
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     }
//                 });
                
//                 $.ajax({
//                     url: '{{ route("save-token") }}',
//                     type: 'POST',
//                     data: {
//                         token: renewedToken
//                     },
//                     dataType: 'JSON',
//                     success: function (response) {
//                         alert('Token saved successfully.');
//                     },
//                     error: function (err) {
//                         console.log('User Chat Token Error'+ err);
//                     },
//                 });
        
//             })
//             .catch(function(error) {
//                 /** If some error happens while fetching the token then handle here */
//                 console.log('Error in fetching refreshed token ' + error);
//             });
//         });

// // Handle incoming messages
// messaging.onMessage(function(payload) {
//     const notificationTitle = 'Data Message Title';
//     const notificationOptions = {
//         body: 'Data Message body',
//         icon: 'http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png',
//         image: 'http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png'
//     };
    
//       if(Notification.permission==="granted"){
//             var notification=new Notification(notificationTitle,notificationOptions);
//             toastr.success(notificationOptions.body, notificationTitle);
           
//             notification.onclick=function (ev) {
//                 ev.preventDefault();
//                 window.open(payload.notification.click_action,'_blank');
//                 notification.close();
//             }
//         }

//     // return self.registration.showNotification(notificationTitle, notificationOptions);
    
//     // navigator.serviceWorker.getRegistration("./public/firebase-messaging-sw.js").then(registration => {
//     //     console.log("got the registration");
//     //     registration.showNotification('Hello world!');
//     // }).catch(error => {
//     //     console.log("No service worker registered", error);
//     // });
// });

// //  messaging.onMessage(function (payload) {
// //       console.log('Message received. ', payload);
// //         //   const noteTitle = payload.notification.title;
// //         //   const noteOptions = {
// //         //   body: "Background Message body.",
// //         //   icon: "http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png",
// //         // };
// //         // new Notification(noteTitle, noteOptions);
// //     // return navigator.serviceWorker.ready.then(function(registration) {
        
// //     //   registration.showNotification('Vibration Sample', {
// //     //       body: 'Buzz! Buzz!',
// //     //       icon: 'http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png',
// //     //       vibrate: [200, 100, 200, 100, 200, 100, 200],
// //     //       tag: 'vibration-sample'
// //     //     });
// //     //   });
// //     const notificationTitle = "Background Message Title";
// //     const notificationOptions = {
// //         body: "Background Message body.",
// //         icon: "http://iems.avisdemo.in/public/websetting/ch-logo_1656925650.png",
// //     };
    
// //     // return self.registration.showNotification(
// //     //     notificationTitle,
// //     //     notificationOptions,
// //     // );
    
// //      //return self.registration.hideNotification();
// //     }); 
         
//     } 
//     catch (e) 
//     {
//         console.log("firebase startup error ", e);
//     }
</script>

<script>

  


      

//     firebase.initializeApp(firebaseConfig);
//     const messaging = firebase.messaging.isSupported() ? firebase.messaging() : null
//     //const messaging = firebase.messaging();

 
//   console.log(messaging);

//     function initFirebaseMessagingRegistration() {

//             messaging

//             .requestPermission()

//             .then(function () {

//                 return messaging.getToken()

//             })

//             .then(function(token) {

//                 console.log(token);

   

//                 $.ajaxSetup({

//                     headers: {

//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

//                     }

//                 });

  

//                 $.ajax({

//                     url: '{{ route("save-token") }}',

//                     type: 'POST',

//                     data: {

//                         token: token

//                     },

//                     dataType: 'JSON',

//                     success: function (response) {

//                         alert('Token saved successfully.');

//                     },

//                     error: function (err) {

//                         console.log('User Chat Token Error'+ err);

//                     },

//                 });

  

//             }).catch(function (err) {

//                 console.log('User Chat Token Error'+ err);

//             });

//      }  

      

    // messaging.onMessage(function(payload) {

    //     const noteTitle = payload.notification.title;

    //     const noteOptions = {

    //         body: payload.notification.body,

    //         icon: payload.notification.icon,

    //     };

    //     new Notification(noteTitle, noteOptions);

    // });

   

</script>

@endsection