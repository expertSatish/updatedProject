var notificationsWrapper = $('.notification-count').html();
var notifications = $('.notification-list');
var pusher = new Pusher(PusherAppKey, {
    cluster: 'ap2',
    encrypted: true
});

/**** New Order ****/
var channel = pusher.subscribe('new-order');
channel.bind('new-order', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);
    var ordernotificationsWrapper = $('.ordercount').html();
    $('.ordercount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.ordercount').html(ordernotificationsWrapper); 
        }else{
            $('.ordercount').hide();
        }      
    } else{
        $('.ordercount').html('9+');
    }
});

/**** Deposit Request ****/
var channel = pusher.subscribe('deposit-request');
channel.bind('deposit-request', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.depositcount').html();
    $('.depositcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.depositcount').html(ordernotificationsWrapper); 
        }else{
            $('.depositcount').hide();
        }      
    } else{
        $('.depositcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.userreqcount').html();
    $('.userreqcount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.userreqcount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.userreqcount').hide();
        }      
    } else{
        $('.userreqcount').html('9+');
    }

});

/**** Bank Approval ****/
var channel = pusher.subscribe('bank-approval');
channel.bind('bank-approval', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.bankcount').html();
    $('.bankcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.bankcount').html(ordernotificationsWrapper); 
        }else{
            $('.bankcount').hide();
        }      
    } else{
        $('.bankcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.userreqcount').html();
    $('.userreqcount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.userreqcount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.userreqcount').hide();
        }      
    } else{
        $('.userreqcount').html('9+');
    }

});

/**** Withdraw Request ****/
var channel = pusher.subscribe('withdraw-request');
channel.bind('withdraw-request', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.withdrawcount').html();
    $('.withdrawcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.withdrawcount').html(ordernotificationsWrapper); 
        }else{
            $('.withdrawcount').hide();
        }      
    } else{
        $('.withdrawcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.userreqcount').html();
    $('.userreqcount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.userreqcount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.userreqcount').hide();
        }      
    } else{
        $('.userreqcount').html('9+');
    }

});

/**** Delivery Request ****/
var channel = pusher.subscribe('delivery-request');
channel.bind('delivery-request', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.deliverycount').html();
    $('.deliverycount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.deliverycount').html(ordernotificationsWrapper); 
        }else{
            $('.deliverycount').hide();
        }      
    } else{
        $('.deliverycount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.userreqcount').html();
    $('.userreqcount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.userreqcount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.userreqcount').hide();
        }      
    } else{
        $('.userreqcount').html('9+');
    }

});

/**** Claim Request ****/
var channel = pusher.subscribe('claim-request');
channel.bind('claim-request', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.claimcount').html();
    $('.claimcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.claimcount').html(ordernotificationsWrapper); 
        }else{
            $('.claimcount').hide();
        }      
    } else{
        $('.claimcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.userreqcount').html();
    $('.userreqcount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.userreqcount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.userreqcount').hide();
        }      
    } else{
        $('.userreqcount').html('9+');
    }

});

/**** Storage Fee ****/
var channel = pusher.subscribe('storage-fee');
channel.bind('storage-fee', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.storagecount').html();
    $('.storagecount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.storagecount').html(ordernotificationsWrapper); 
        }else{
            $('.storagecount').hide();
        }      
    } else{
        $('.storagecount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.storagecount').html();
    $('.storagecount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.storagecount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.storagecount').hide();
        }      
    } else{
        $('.storagecount').html('9+');
    }

});

/**** Job Apply ****/
var channel = pusher.subscribe('job-apply');
channel.bind('job-apply', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.jobcount').html();
    $('.jobcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.jobcount').html(ordernotificationsWrapper); 
        }else{
            $('.jobcount').hide();
        }      
    } else{
        $('.jobcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.enquirycount').html();
    $('.enquirycount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.enquirycount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.enquirycount').hide();
        }      
    } else{
        $('.enquirycount').html('9+');
    }

});

/**** Subscribe Newsletter ****/
var channel = pusher.subscribe('subscribe-newsletter');
channel.bind('subscribe-newsletter', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.newslettercount').html();
    $('.newslettercount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.newslettercount').html(ordernotificationsWrapper); 
        }else{
            $('.newslettercount').hide();
        }      
    } else{
        $('.newslettercount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.enquirycount').html();
    $('.enquirycount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.enquirycount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.enquirycount').hide();
        }      
    } else{
        $('.enquirycount').html('9+');
    }

});

/**** Customized Solution ****/
var channel = pusher.subscribe('customized-solution');
channel.bind('customized-solution', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.customizecount').html();
    $('.customizecount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.customizecount').html(ordernotificationsWrapper); 
        }else{
            $('.customizecount').hide();
        }      
    } else{
        $('.customizecount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.enquirycount').html();
    $('.enquirycount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.enquirycount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.enquirycount').hide();
        }      
    } else{
        $('.enquirycount').html('9+');
    }

});

/**** Price Alert ****/
var channel = pusher.subscribe('price-alert');
channel.bind('price-alert', function (data) {
    console.log(data);
    var existingNotifications = notifications.html();
    var newNotificationHtml = '<a href="' + data.link + '" class="media-list-link read">';
    newNotificationHtml += '<div class="media pd-x-20 pd-y-15">';
    newNotificationHtml += '<img src="' + data.image + '" class="wd-40 rounded-circle ProImgNott" alt="">';
    newNotificationHtml += '<div class="media-body">';
    newNotificationHtml += '<p class="tx-13 mg-b-0 tx-gray-700">' + data.message + '</p>';
    newNotificationHtml += '<span class="tx-12">' + data.time + '</span>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</div>';
    newNotificationHtml += '</a>';
    notifications.html(newNotificationHtml + existingNotifications);
    if (parseInt(notificationsWrapper) < 100) {
        notificationsWrapper = parseInt(notificationsWrapper) + parseInt(1);
        $('.notification-count').html(notificationsWrapper);
    } else {
        $('.notification-count').html('99+');
    }
    if (parseInt(notificationsWrapper) > 0) { $('.notification-count').addClass('blick'); }
    notifyMe(data.message,data.image);

    var ordernotificationsWrapper = $('.pricealertcount').html();
    $('.pricealertcount').show();
    if (parseInt(ordernotificationsWrapper) < 10) {
        ordernotificationsWrapper = parseInt(ordernotificationsWrapper) + parseInt(1);
        if(parseInt(ordernotificationsWrapper) > 0){ 
            $('.pricealertcount').html(ordernotificationsWrapper); 
        }else{
            $('.pricealertcount').hide();
        }      
    } else{
        $('.pricealertcount').html('9+');
    }

    var userreqcountnotificationsWrapper = $('.enquirycount').html();
    $('.enquirycount').show();
    if (parseInt(userreqcountnotificationsWrapper) < 10) {
        userreqcountnotificationsWrapper = parseInt(userreqcountnotificationsWrapper) + parseInt(1);
        if(parseInt(userreqcountnotificationsWrapper) > 0){ 
            $('.enquirycount').html(userreqcountnotificationsWrapper); 
        }else{
            $('.enquirycount').hide();
        }      
    } else{
        $('.enquirycount').html('9+');
    }

});

function notifyMe(message,image) {
    if (!("Notification" in window)) {
      alert("This browser does not support desktop notification");
    }
    else if (Notification.permission === "granted") {
          var options = {
                  body: message,
                  icon: image,
                  dir : "ltr",
                  tag: 1
               };
            var notification = new Notification("Hi",options);
    }
    else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function (permission) {
        if (!('permission' in Notification)) {
          Notification.permission = permission;
        }
     
        if (permission === "granted") {
          var options = {
                body: message,
                icon: image,
                dir : "ltr",
                tag: 1
            };
          var notification = new Notification("Hi",options);
        }
      });
    }
  }
function NotificationRead(id){
    $.ajax({
        data:{_token:XCSRF_Token,id:id},
        url:NotificationReadUrl,
        method:'POST',
        dataType:'Json',
        cache:false,
        success:function(data){
            var notificationsWrapper = $('.notification-count').html();
            notificationsWrapper = parseInt(notificationsWrapper) - parseInt(1);
            $('.notification-count').html(notificationsWrapper);
            if(data.type=='order-purchase'){
                var ordernotificationsWrapper = $('.ordercount').html();
                ordernotificationsWrapper = parseInt(ordernotificationsWrapper) - parseInt(1);
                if(ordernotificationsWrapper<1){
                    $('.ordercount').hide();
                }else{
                    $('.ordercount').html(ordernotificationsWrapper);
                }                
            }            
        },
        error:function(response){
            
        }
    });
}