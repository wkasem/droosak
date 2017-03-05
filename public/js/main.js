$(function(){


  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "8000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

  $('.nav .nav-toggle').click(function(){

    $(this).next().slideToggle();
  });

  $(window).on('resize' , function(){

    $('.nav-mobile').slideUp();
  });

  Modal.activate();
});


Echo.private("notifications." + user.id)
    .notification(function(notification){
        switch (notification.type) {
          case "droosak\\Notifications\\LiveEvent":
          swal({
            title: `${notification.user.username} `+Locale.get('liveNow'),
            imageUrl: `/pic/${notification.user.id}`,
            showCancelButton:true,
            closeOnConfirm:true,
            confirmButtonText:Locale.get('liveBtn'),
            cancelButtonText:Locale.get('liveCancel')
          },function(c){
            if(c){
              window.open(`/video/${notification.id}` , '_blank');
            }
          });
            break;
          case "droosak\\Notifications\\SchedulePublish":
            toastr["info"](Locale.get('schedule_updated' , notification.title));
            break;
          case "droosak\\Notifications\\ExamPublished":
            $.ajax({
              method : 'POST',
              url    : `/exams/title`,
              data   : 'title=' + notification.exam.title,
              success : function(data){
                toastr["info"](Locale.get('exam_updated' , data));
              }
            })
            break;

        }
    });
